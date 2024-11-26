<!-- resources/views/courses/create.blade.php -->

@extends('home.index')

@section('content')

    <body>
        <div class="container">
            <h2>Criar Novo Curso</h2>

            <form action="{{ route('courses.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nome do Curso</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="quantity_places">Quantidade de Vagas</label>
                    <input type="number" name="quantity_places" id="quantity_places" class="form-control"
                        value="{{ old('quantity_places') }}" required>
                </div>

                <div class="form-group">
                    <label for="id_user">Responsável</label>
                    <select name="id_user" id="id_user" class="form-control" required>
                        <option value="">Selecione o responsável</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Salvar</button>
            </form>
        </div>
    </body>
@endsection
