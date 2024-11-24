@extends('layouts.main_layout')

@section('content')
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/calendarStyle.css') }}" rel="stylesheet">

    <title>Calendário de Reservas</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Full Calendar /Idioma: Português -->
     <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/pt.global.min.js"></script>

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

<!-- Calendário -->
    <div class="container mt-4">

        <h2 class="text-center mb-4">Calendário de Reservas</h2>

        <div id="calendar" style="max-width: 900px; height: 60vh; margin: auto;"></div>

        <div id='calendar'></div>

<div class="dropdown">
    <div class="dropdown-content">
      </div>
  <button class="fa dropbtn" style="font-size:24px; margin-left: 75%; color: black"><span>&#xf128;</span></button>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'pt-br',
                initialView: 'dayGridMonth',
                height: 'auto',
                slotMinTime: '09:00:00',
                slotMaxTime: '20:00:00',
                selectable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events:[],

                select:function(info) {
                    prompt('selected ' + info.startStr + ' to ' + info.endStr);
                    this.addEvent(
                        {
                        'title':"curso",
                        'start': info.startStr,
                        'end': info.endStr
                    });

                    this.render();
                }
            });
            calendar.render();
        });
    </script>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">

</html>
