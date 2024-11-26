<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(10);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $users = User::all();  // Buscar todos os usuários
        return view('courses.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity_places' => 'required|integer',
            'id_user' => 'required|exists:users,id',  // Valida se o id_user existe
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Curso criado com sucesso!');
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $users = User::all();  // Buscar todos os usuários
        return view('courses.edit', compact('course', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity_places' => 'required|integer',
            'id_user' => 'required|exists:users,id',
        ]);

        $course = Course::findOrFail($id);
        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Curso atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Curso excluído com sucesso!');
    }
}
