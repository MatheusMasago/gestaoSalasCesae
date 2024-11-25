<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation ::all();
        $events = array();

        foreach ($reservations as $reservation) {

            $events[] = array(

                'name' => $reservation -> id_reservation,
                'day' => $reservation -> date,
                'start' => $reservation -> start_time,
                'end' => $reservation -> end_time,);
        }

        return view('pages.calendar', ['events' =>$events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);



                $startTime = Carbon::parse($request->start_time)->format('Y-m-d H:i:s');
                $endTime = Carbon::parse($request->end_time)->format('Y-m-d H:i:s');

                $reservation = Reservation::create([
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                ]);

                return response()->json([
                    'success' => true,
                    'id' => $reservation->id,
                    'name' => $request->name,
                ]);
            } catch (\Exception $e) {
                error_log($e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }
        }


    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Atualiza a reserva com os dados validados
        $reservation->update($validatedData);

        return response()->json('Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        if (! $reservation) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }

        $reservation->delete();

        return response()->json([
            'success' => 'Reservation deleted successfully'
        ]);
    }
}
