<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    // Exibir todas as reservas
    public function index()
    {
        $reservations = Reservation::paginate(10);  // Você pode customizar para buscar apenas reservas do usuário autenticado
        return view('reservations.index', compact('reservations'));
    }

    // Exibir o formulário para criar uma nova reserva
    public function create()
    {
        return view('reservations.create');
    }

    // Salvar uma nova reserva
    public function store(Request $request)
    {
        // Validação dos dados da reserva
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'id_room' => 'required|exists:rooms,id',
            'id_course' => 'required|exists:courses,id', // Validação para o id_course
        ]);

        // Verificar se já existe uma reserva para a mesma sala e horário
        $existingReservation = Reservation::where('id_room', $request->id_room)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                // Verificar se o horário de início ou fim se sobrepõe com outra reserva
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                    });
            })
            ->exists();

        // Se já existir uma reserva para a mesma sala e horário, retornar erro
        if ($existingReservation) {
            return redirect()->route('reservations.create')
                ->withErrors(['time_conflict' => 'Esta sala já está reservada para o mesmo horário.']);
        }

        // Se não houver conflito, criar a nova reserva
        $reservation = new Reservation();
        $reservation->date = $request->date;
        $reservation->start_time = $request->start_time;
        $reservation->end_time = $request->end_time;
        $reservation->id_user = $request->auth()->user()->id;  // Usando o ID do usuário logado
        $reservation->id_course = $request->id_course;  // Usando o ID do curso
        $reservation->status = 'pending';  // Status inicial como pendente
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Reserva criada com sucesso!');
    }

    // Exibir os detalhes de uma reserva
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }

    // Exibir o formulário de edição de uma reserva
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    // Atualizar a reserva
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'id_room' => 'required|exists:rooms,id',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->date = $request->date;
        $reservation->start_time = $request->start_time;
        $reservation->end_time = $request->end_time;
        $reservation->id_room = $request->id_room;
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Reserva atualizada com sucesso!');
    }

    public function cancel($id)
    {
        // Find the reservation by ID
        $reservation = Reservation::find($id);

        // Check if the reservation exists
        if (!$reservation) {
            return redirect()->route('reservations.index')->with('error', 'Reservation not found.');
        }

        // Ensure the reservation is in 'pending' status before allowing cancellation
        if ($reservation->status !== 'pending') {
            return redirect()->route('reservations.index')->with('error', 'Only pending reservations can be canceled.');
        }

        // Update the status to 'canceled'
        $reservation->status = 'canceled';
        $reservation->save();

        // Redirect with a success message
        return redirect()->route('reservations.index')->with('success', 'Reservation canceled successfully.');
    }

    public function confirm($id)
    {
        // Find the reservation by ID
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return redirect()->route('reservations.index')->with('error', 'Reservation not found.');
        }

        // Ensure the logged-in user is an Admin
        if (auth()->user_type !== 'Admin') {
            return redirect()->route('reservations.index')->with('error', 'You are not authorized to confirm reservations.');
        }

        // Update the reservation status to 'confirmed'
        $reservation->status = 'confirmed';
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation confirmed successfully.');
    }

    public function stats()
    {
        // Obter estatísticas de uso das salas para o mês atual
        $stats = Reservation::selectRaw(
            'DATE_FORMAT(reservations.date, "%Y-%m") as month, ' . // Formata a data para "YYYY-MM"
                'rooms.name, ' .
                'COUNT(reservations.id) as reservations_count, ' .
                'SUM(TIMESTAMPDIFF(SECOND, reservations.start_time, reservations.end_time)) / 3600 as total_hours' // Calcula horas totais
        )
            ->join('rooms', 'reservations.id_room', '=', 'rooms.id') // Une com a tabela de salas
            ->groupByRaw('DATE_FORMAT(reservations.date, "%Y-%m"), rooms.name') // Agrupa por mês e sala
            ->orderBy('month', 'asc') // Ordena por mês
            ->get();

        return view('stats.index', compact('stats'));
    }
}
