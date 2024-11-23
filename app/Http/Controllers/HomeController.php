<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.main_layout');
    }

    public function showDashboard(){
        $reservations = db::table('reservations')
        ->select('id_room', DB::raw('SUM(TIMESTAMPDIFF(HOUR, start_time, end_time)) as total_hours'))
        ->groupBy('id_room')
        ->get();
        //dd($reservations);

        $labels = $reservations->pluck('id_room');
        $data = $reservations->pluck('total_hours');

        return view('dashboard', compact('labels', 'data'));
    }
    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $credentials = $request->only('email','password');
    //     if (Auth::attempt($credentials)) {
    //         return redirect()->route('home')->with('message', 'Logado com sucesso!');
    //     }
    //     return back();
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
