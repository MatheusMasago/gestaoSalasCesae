@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <!DOCTYPE html>
        <html lang="pt">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!-- CSS -->
            <link href="{{ asset('css/style.css') }}" rel="stylesheet">
            <link href="{{ asset('css/calendarStyle.css') }}" rel="stylesheet">

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
                <h1 id="title">Lista de Reservas</h1>

                <div id="calendar" style="max-width: 900px; height: 50vh; margin-bottom: 10%;"></div>

                <!-- Modal for Adding Event -->
                <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eventModalLabel">Adicionar Evento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="eventForm" action="{{ route('calendar.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="user">Selecione um Usuário</label>
                                        <select name="id_user" class="form-select" aria-label="Default select example">

                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="eventName" class="form-label">Nome do Evento</label>
                                        <input name="evento" type="text" class="form-control" id="eventName" required>
                                    </div> --}}
                                    {{-- <div class="mb-3">
                                    <label for="eventName" class="form-label">Dia do evento</label>
                                    <input name="date"  type="date" class="form-control" id="eventDate" required>
                                </div> --}}
                                    <div class="mb-3">
                                        <label for="start_time" class="form-label">Início</label>
                                        <input name="start_time" type="datetime-local" class="form-control" id="eventStart"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_time" class="form-label">Fim</label>
                                        <input name="end_time" type="datetime-local" class="form-control" id="eventEnd"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="course">Selecione um curso</label>
                                        <select name="id_course " class="form-select" aria-label="Default select example">
                                            @foreach ($courses as $course)
                                                <option required id="id_course" required value="{{ $course->id }}">
                                                    {{ $course->name }}</option>
                                            @endforeach
                                            @error('id_course')
                                                Preencher campo
                                            @enderror
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="room">Selecione a Sala</label>
                                        <select name="id_room " class="form-select" aria-label="Default select example">

                                            @foreach ($rooms as $room)
                                                <option required id="id_room" required value="{{ $room->id }}">
                                                    {{ $room->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <input type="hidden" id="startTime">
                                    <input type="hidden" id="endTime">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" id="saveBtn" class="btn btn-primary">Salvar Evento</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <script>
                var eventData;
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var events = @json($reserves);
                    var courseName = @json($course);
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        locale: 'pt-br',
                        initialView: 'dayGridMonth',
                        height: 'auto',
                        slotMinTime: '09:00:00',
                        slotMaxTime: '19:00:00',
                        selectable: true,
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        //FAZER APARECER AQUI!!!!!
                        events: events.map(events => ({
                            title: courseName.name,
                            start: events.start_time,
                            end: events.end_time
                        })),

                        select: function(info) {
                            document.getElementById('eventStart').value = info.start.toISOString().slice(0,
                                16); // PARA DEIXA NO FORMATO YYYY-MM-DDTHH:MM
                            document.getElementById('eventEnd').value = info.end.toISOString().slice(0,
                                16); // PARA DEIXAR NO FORMATO YYYY-MM-DDTHH:MM
                            //document.getElementById('startTime').value = info.dateStr;
                            // Show the modal
                            var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
                            eventModal.show();
                        },
                        eventClick: function(info) {
                            // var eventId = info.event.id;
                            // console.log(eventId);
                            var reserveModal = new bootstrap.Modal(document.getElementById('reserveView'));
                            reserveModal.show();
                            document.querySelector('#reserveView .modal-title').textContent = info.event.title;
                            document.querySelector('#reserveView .modal-body').innerHTML = `
                            <p>Início: ${info.event.start.toLocaleString()}</p>
                            <p>Fim: ${info.event.end.toLocaleString()}</p>
                        `;
                        }
                    });

                    calendar.render();
                    // Save button click event
                    // document.getElementById('saveEvent').addEventListener('click', function() {
                    //     // Get form data
                    //     var userName = document.getElementById('userName').value;
                    //     var id_room = document.getElementById('id_room').value;
                    //     var eventName = document.getElementById('eventName').value;
                    //     var startTime = document.getElementById('startTime').value;
                    //     var endTime = document.getElementById('endTime').value;
                    //     var endTime = document.getElementById('endTime').value;
                    //     var endTime = document.getElementById('endTime').value;
                    //     // Prepare event data
                    //     eventData = {
                    //         user_name: userName,
                    //         name: eventName,
                    //         start_time: startTime,
                    //         end_time: endTime,
                    //         id_room:id_room,
                    //     };

                    const postData = async () => {
                        try {
                            const response = await axios.post('http://127.0.0.1:8000/calendario', {
                                // Dados que serão enviados no corpo da requisição

                                eventData
                            });
                            // Close the modal
                            var eventModal = bootstrap.Modal.getInstance(document.getElementById('eventModal'));
                            eventModal.hide();
                            //console.log('Resposta do servidor:', response.data);
                        } catch (error) {
                            alert('Erro ao salvar o evento.');
                            console.error('Erro ao fazer a requisição:', error);
                        }
                    };
                    postData;
                    // AJAX call to save the event
                    //console.log(eventData);
                })


                // .then(response => response.json())
                // .then(data => {


                //     // Close the modal
                //     var eventModal = bootstrap.Modal.getInstance(document.getElementById('eventModal'));
                //     eventModal.hide();
                // } else {
                //     alert('Erro ao salvar o evento.');
                // }
                // })
                // .catch(error => {
                // console.error('Erro:', error);
                // });
                // });
                // });
            </script>

            <div class="modal" id="reserveView" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p></p>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('view') }}" class="btn btn-danger" {{ route('view') }}
                                id="deleteEventBtn">Ver Evento</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <script>

    document.getElementById('deleteEventBtn').addEventListener('click', function() {
    const data = @json($idReservations);
    //Supondo que você tenha o ID do evento armazenado em info.event.id
    $.ajax({
        url: '{{route('delete',':id')}}'.replace(':id',data), // A URL da sua rota de exclusão
        method: 'DELETE',
        success: function(response) {
            if (response.success) {
                // Recarregue o calendário ou remova o evento da visualização
                location.reload(); // Recarrega a página
            } else {
                alert('Erro: ' + response.message);
            }
        },
        error: function(xhr) {
            alert('Erro na requisição: Tente novamente');
        }
    });
});
  </script>  --}}

            {{-- MODAL PARA VER E APAGAR RESERVA --}}


            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#eventForm').on('submit', function(e) {
                        e.preventDefault(); //Impedir

                        $.ajax({
                            url: $(this).attr('action'), // URL do formulário
                            method: 'POST',
                            data: $(this).serialize(), // Serializa os dados do formulário
                            success: function(response) {
                                if (response.success) {
                                    // Recarrega a página em caso de sucesso
                                    location.reload();
                                } else {
                                    // Trate o erro caso necessário
                                    alert('Erro: ' + response.message);
                                }
                            },
                            error: function(xhr) {
                                alert('Erro na requisição: Tente novamente');
                            }
                        });
                    });
                });
            </script>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js "></script>
        </body>

        </html>
    </div>
@endsection
