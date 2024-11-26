<!-- resources/views/rooms/create.blade.php -->

@extends('home.index')

@section('content')

    <body>
        <div class="container">
            <h2>Criar Sala</h2>

            <form action="{{ route('rooms.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nome da Sala</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="capacity">Capacidade</label>
                    <input type="number" name="capacity" id="capacity" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="id_local">Local</label>
                    <select name="id_local" id="id_local" class="form-control" required>
                        @foreach ($locals as $local)
                            <option value="{{ $local->id }}">{{ $local->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Criar Sala</button>
            </form>
        </div>
    </body>
@endsection
