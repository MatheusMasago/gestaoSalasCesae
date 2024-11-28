<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Chamar o método totalCourses() para obter o total de cursos
        $totalCourses = $this->totalCourses();

        // Chamar o método totaltotalNewUsersCourses() para obter o total de users do tipop user
        $totalNewUsers = $this->totalNewUsers();

        // Chamar o método totalReservation() para obter o total de reservas
        $totalReservation = $this->totalReservation();

        //Chamar o gráfico
        [$labels, $data] = $this->showDashboard();

        // Retornar a view com a variável compactada
        return view('home.index', compact('totalCourses', 'totalNewUsers', 'totalReservation', 'labels', 'data'));
    }

    public function totalNewUsers()
    {
        $totalNewUsers = DB::table('users')
            ->where('user_type', '=', 'user') // Filtro: user_type igual a 'user'
            ->count(); // Conta o número de registros

        return $totalNewUsers;
    }

    public function totalCourses()
    {
        // Contar o total de cursos
        $totalCourses = DB::table('courses')
            ->count(); // Conta o total de registros na tabela 'courses'

        return $totalCourses;
    }

    public function totalReservation()
    {
        $totalReservation = DB::table('reservations')
            ->count(); // Conta o total de reservas na tabela 'reservations'

        return $totalReservation;
    }

    public function showDashboard()
    {
        $reservations = db::table('reservations')
            ->select('id_room', DB::raw('SUM(TIMESTAMPDIFF(HOUR, start_time, end_time)) as total_hours'))
            ->groupBy('id_room')
            ->get();
        //dd($reservations);

        $labels = $reservations->pluck('id_room');
        $data = $reservations->pluck('total_hours');

        return [$labels, $data];
    }
}
