<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class CalendarController extends Controller
{
    public function events(Request $request)
    {
        $reservations = Reservation ::all();
        $events = array();

        foreach ($reservations as $reservation) {
            $backColor ="#"; //por cor
            $boardColor ="#"; //por cor

            $events[] = array(

                'nome' => $reservation -> id_reservation,
                'day' => $reservation -> date,
                'start' => $reservation -> start_time,
                'end' => $reservation -> end_time,
                'boardColor' => $boardColor,
                'backgroundColor' => $backColor,);
        }

        return view('pages.calendar', ['events' =>$events]);
    }

    public function eventsAdd(Request $request)
    {

    }
}
