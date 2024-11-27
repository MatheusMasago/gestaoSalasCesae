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
        $reservations = DB::table('reservations')
            ->join('rooms', 'rooms.id', '=', 'reservations.id_room')
            ->join('locals', 'locals.id', '=', 'rooms.id_local')
            ->select('locals.name as locals_name', 'rooms.name as rooms_name', 'reservations.*')
            ->paginate(10);

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
            'start_time' => 'required|date_format:Y-m-d H:i:s',  // Valida uma data e hora completa
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',  // Garantir que 'end_time' seja depois de 'start_time'
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
        $stats = DB::table('reservations')
            ->join('rooms', 'rooms.id', '=', 'reservations.id_room')  // Junta com a tabela de salas
            ->join('locals', 'locals.id', '=', 'rooms.id_local')   // Junta com a tabela de locais
            ->selectRaw(
                'DATE_FORMAT(reservations.start_time, "%Y-%m-%d") as full_date, ' .  // Formata a data completa para "YYYY-MM-DD"
                    'locals.name as local_name, ' .  // Nome do local
                    'rooms.name as room_name, ' . // Nome da sala
                    'COUNT(reservations.id) as reservations_count, ' .   // Conta o número de reservas
                    'SUM(
                    ABS(TIMESTAMPDIFF(SECOND,
                        GREATEST(reservations.start_time, reservations.end_time),
                        LEAST(reservations.start_time, reservations.end_time)
                    ))
                ) / 3600 as total_hours' // Soma as horas totais, garantindo que a diferença não seja negativa
            )
            ->groupByRaw('DATE_FORMAT(reservations.start_time, "%Y-%m-%d"), locals.name, rooms.name') // Agrupa por data completa, nome do local e nome da sala
            ->orderBy('full_date', 'asc')  // Ordena por data completa (dia-mês-ano)
            ->paginate(10);  // Paginação para 10 registros por página

        return view('stats.index', compact('stats'));
    }
}
