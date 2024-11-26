<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    // Exibir lista de locais
    public function index()
    {
        $locals = Local::paginate(10);
        return view('locals.index', compact('locals'));
    }

    // Mostrar o formulário de criação
    public function create()
    {
        return view('locals.create');
    }

    // Armazenar um novo local
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Criar o local
        Local::create([
            'name' => $request->name,
        ]);

        return redirect()->route('locals.index')->with('success', 'Local criado com sucesso!');
    }

    public function show(Local $local)
    {
        return view('locals.show', compact('local'));
    }

    // Exibir a página de edição de um local
    public function edit($id)
    {
        $local = Local::findOrFail($id);
        return view('locals.edit', compact('local'));
    }

    // Atualizar um local
    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Atualizar o local
        $local = Local::findOrFail($id);
        $local->update([
            'name' => $request->name,
        ]);

        return redirect()->route('locals.index')->with('success', 'Local atualizado com sucesso!');
    }

    // Excluir um local
    public function destroy($id)
    {
        $local = Local::findOrFail($id);
        $local->delete();

        return redirect()->route('locals.index')->with('success', 'Local excluído com sucesso!');
    }
}
