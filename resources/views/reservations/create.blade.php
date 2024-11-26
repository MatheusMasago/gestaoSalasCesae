@extends('home.index')

@section('content')

    <body>
        <div class="container">
            <h2>Reserve Room</h2>

            <form action="{{ route('reserve.room.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_room">Room</label>
                    <select name="id_room" id="id_room" class="form-control" required>
                        <option value="">Select a Room</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="reservation_date">Reservation Date</label>
                    <input type="date" name="reservation_date" id="reservation_date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="start_time">Start Time</label>
                    <input type="time" name="start_time" id="start_time" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="end_time">End Time</label>
                    <input type="time" name="end_time" id="end_time" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Reserve</button>
            </form>
        </div>
    </body>
@endsection
