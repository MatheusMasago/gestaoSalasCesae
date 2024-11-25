@extends('layouts.main_layout')

@section('content')
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/calendarStyle.css') }}" rel="stylesheet">

    <title>Calendário de Reservas</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FullCalendar -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/pt.global.min.js"></script>

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<div class="container mt-4">
    <h2 class="text-center mb-4">Calendário de Reservas</h2>

    <div id="calendar" style="max-width: 900px; height: 60vh; margin: auto;"></div>

    <!-- Modal for Adding Event -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Adicionar Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="eventForm">
                        <div class="mb-3">
                            <label for="userName" class="form-label">Nome do Usuário</label>
                            <input type="text" class="form-control" id="userName" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventName" class="form-label">Nome do Evento</label>
                            <input type="text" class="form-control" id="eventName" required>
                        </div>
                        <input type="hidden" id="startTime">
                        <input type="hidden" id="endTime">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="saveEvent" class="btn btn-primary">Salvar Evento</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'pt-br',
            initialView: 'dayGridMonth',
            height: 'auto',
            selectable: true,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: '/calendar',

            select: function (info) {
                // Store selected time range
                document.getElementById('startTime').value = info.startStr;
                document.getElementById('endTime').value = info.endStr;

                // Show the modal
                var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
                eventModal.show();
            }
        });

        calendar.render();

        // Save button click event
        document.getElementById('saveEvent').addEventListener('click', function () {
            // Get form data
            var userName = document.getElementById('userName').value;
            var eventName = document.getElementById('eventName').value;
            var startTime = document.getElementById('startTime').value;
            var endTime = document.getElementById('endTime').value;

            // Prepare event data
            var eventData = {
                user_name: userName,
                name: eventName,
                start_time: startTime,
                end_time: endTime,
            };

            // AJAX call to save the event
            fetch('/calendar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(eventData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Add the event to the calendar
                        calendar.addEvent({
                            title: eventName,
                            start: startTime,
                            end: endTime
                        });

                        // Close the modal
                        var eventModal = bootstrap.Modal.getInstance(document.getElementById('eventModal'));
                        eventModal.hide();
                    } else {
                        alert('Erro ao salvar o evento.');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>
</html>
@endsection
