<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    // Exibir todas as reservas
    public function bladeIndex()
    {
        $reservations = DB::table('reservations')
            ->join('rooms', 'rooms.id', '=', 'reservations.id_room')
            ->join('locals', 'locals.id', '=', 'rooms.id_local')
            ->select('locals.name as locals_name', 'rooms.name as rooms_name', 'reservations.*')
            ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    public function index()
    {
        $courses = $this->getCourses();
        $rooms = $this->getRooms();
        $reserves = DB::table('reservations')->get();
        $users = $this->getUser();
        $reservations = Reservation::all();
        $idReservations = $reservations->pluck('id');
        $events = array();

        foreach ($reservations as $reservation) {

            $events[] = array(

                /* 'name' => $reservation->id_reservation, */
                // 'day' => $reservation -> date,
                'start' => $reservation->start_time,
                'end' => $reservation->end_time,
                'room' => $reservation->id_room,
                'course' => $reservation->id_course
            );
        }

        return view('calendar.calendar', ['events' => $events], compact('rooms', 'users', 'courses', 'reserves', 'idReservations'));
    }

    // Exibir o formulário para criar uma nova reserva
    public function create()
    {
        return view('reservations.create');
    }

    // Salvar uma nova reserva
    public function store(Request $request)
    {
        try {
            $request->validate([
                'start_time' => 'required',
                'end_time' => 'required',
                'id_room_' => 'required',
                'id_user' => 'required',
                //'date'=>'required',
                'id_course_' => 'required'
            ]);
            $startTime = Carbon::parse($request->start_time)->format('Y-m-d H:i:s');
            $endTime = Carbon::parse($request->end_time)->format('Y-m-d H:i:s');
            DB::table('reservations')->insert([
                // 'start_time' => $request->startTime,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'id_room' => $request->id_room_,
                'id_user' => $request->id_user,
                //'date'=>$request->date,
                'id_course' => $request->id_course_
            ]);

            return response()->json([
                'success' => true,
                // 'id' => $request->id,
                // 'name' => $request->name,
            ]);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Exibir os detalhes de uma reserva
    /*     public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.show', compact('reservation'));
    } */

    // Exibir o formulário de edição de uma reserva
    /*    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    } */

    // Atualizar a reserva
    public function update(Request $request, Reservation $reservation)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([

            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Atualiza a reserva com os dados validados
        $reservation->update($validatedData);

        return response()->json('Event updated successfully');
    }

    public function destroy($id)
    {
        $event = Reservation::find($id);
        if ($event) {
            $event->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Evento não encontrado.']);
    }

    public function getRooms()
    {
        $rooms = DB::table('rooms')->get();
        return $rooms;
    }
    public function getUser()
    {
        $users = DB::table('users')->get();
        return $users;
    }
    public function getCourses()
    {
        $course = DB::table('courses')->get();
        return $course;
    }
    public function deleteReserve($id)
    {
        db::table('reservations')->where('id', $id)->delete();

        return redirect()->route('calendar');
    }

    public function viewReserve()
    {
        $reserves = DB::table('reservations')->get();

        return view('calendar.show_event', compact('reserves'));
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
