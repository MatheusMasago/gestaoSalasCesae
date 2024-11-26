<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Local;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Exibir lista de salas
    public function index()
    {
        $rooms = Room::paginate(10); // Recupera todas as salas
        return view('rooms.index', compact('rooms'));
    }

    // Mostrar o formulário de criação
    public function create()
    {
        $locals = Local::all(); // Obtém todos os locais para associar a uma sala
        return view('rooms.create', compact('locals'));
    }

    // Armazenar uma nova sala
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'id_local' => 'required|exists:locals,id',
        ]);

        // Criar a sala
        Room::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'id_local' => $request->id_local,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Sala criada com sucesso!');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    // Exibir a página de edição de uma sala
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $locals = Local::all();
        return view('rooms.edit', compact('room', 'locals'));
    }

    // Atualizar uma sala
    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'id_local' => 'required|exists:locals,id',
        ]);

        // Atualizar a sala
        $room = Room::findOrFail($id);
        $room->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'id_local' => $request->id_local,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Sala atualizada com sucesso!');
    }

    // Excluir uma sala
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Sala deletada com sucesso!');
    }
}
