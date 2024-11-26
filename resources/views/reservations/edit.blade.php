@extends('home.index')

@section('content')

    <body>
        <div class="container">
            <h2>Edit Reservation</h2>

            <form action="{{ route('update.reservation', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- HTTP method PUT for updating -->

                <div class="form-group">
                    <label for="id_room">Room</label>
                    <select name="id_room" id="id_room" class="form-control" required>
                        <option value="">Select a Room</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" {{ $room->id == $reservation->id_room ? 'selected' : '' }}>
                                {{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="reservation_date">Reservation Date</label>
                    <input type="date" name="reservation_date" id="reservation_date" class="form-control"
                        value="{{ $reservation->reservation_date }}" required>
                </div>

                <div class="form-group">
                    <label for="start_time">Start Time</label>
                    <input type="time" name="start_time" id="start_time" class="form-control"
                        value="{{ $reservation->start_time }}" required>
                </div>

                <div class="form-group">
                    <label for="end_time">End Time</label>
                    <input type="time" name="end_time" id="end_time" class="form-control"
                        value="{{ $reservation->end_time }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Reservation</button>
            </form>
        </div>
    </body>
@endsection



@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <a href="{{ route('courses.index') }}" id="newUser">
            <i class="fas fa-plus"></i>Voltar para lista cursos</a>
        <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
            <div class="row align-items-center">
                <div class="text-center">
                    <div class="login-page">
                        <div class="form shadow p-4 rounded bg-light mx-auto" style="width: 100%; max-width: 900px;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="text-center flex-grow-1 m-0">Editar Curso</h3>
                            </div>
                            <form class="login-form" method="POST" action="{{ route('courses.update', $course->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <input id="name" type="text" class="form-control" name="name" required
                                        autofocus value="{{ $course->name }}">
                                </div>
                                <div class="mb-3">
                                    <input id="quantity_places" type="text" class="form-control" name="quantity_places"
                                        required autofocus value="{{ $course->quantity_places }}">
                                </div>

                                <div class="mb-3">
                                    <label for="id_user">Responsável</label>
                                    <select name="id_user" id="id_user" class="form-control" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $course->id_user == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Atualizar Curso</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
