@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="containerHome">
        <div class="tile tile-quad">
            <a href="#" class="color-lightBlue">
                <div>
                    <h3>Novos Usuários</h3>
                    <br>
                    <p style="font-size: 24px;"><i class="fa fa-user fa-lg"></i>
                        <label style="margin-left:-0.5em" for="">{{ $totalNewUsers }} usuários</label>
                    </p>
                </div>
            </a>
        </div>

        <div class="tile tile-quad">
            <a href="#" class="color-pink">
                <div>
                    <h3>Total de Cursos</h3>
                    <br>
                    <p style="font-size: 24px;"><i class="fa fa-book fa-lg"></i>
                        <label style="margin-left:-0.5em" for="">{{ $totalCourses }} cursos</label>
                    </p>
                </div>
            </a>
        </div>

        <div class="tile tile-quad">
            <a href="#" class="color-purple">
                <div>
                    <h3>Total Reservas</h3>
                    <br>
                    <p style="font-size: 24px;"><i class="fa fa-calendar fa-lg"></i>
                        <label style="margin-left:-0.5em" for="">{{ $totalReservation }} reservas</label>
                    </p>
                </div>
            </a>
        </div>

        <div id="graficoSala">
            <div class="card m-b20 tile shadow-box" style="width: 100%">
                <div class="card-body">
                    <h3 id="colorText">Salas mais usadas</h3>
                    <hr>
                    <div class="inbox-wid">
                        <div class="inbox-item">
                            <canvas id="myChart">Gráfico</canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Dados do Laravel para Chart.js
            const labels = @json($labels);
            const data = @json($data);
            const Salas = labels.map(label => `Sala ${label}`);

            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    // Essa label é para o nome das salas (ex: Sala 1, Lab 1)
                    labels: Salas,
                    datasets: [{
                        label: 'Total de Horas por Sala',
                        data: {!! json_encode($data) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)', // Red
                            'rgba(54, 162, 235, 0.2)', // Blue
                            'rgba(255, 206, 86, 0.2)', // Yellow
                            'rgba(75, 192, 192, 0.2)', // Green
                            'rgba(153, 102, 255, 0.2)', // Purple
                            'rgba(255, 159, 64, 0.2)', // Orange
                            'rgba(0, 255, 255, 0.2)', // Cyan
                            'rgba(255, 0, 255, 0.2)' // Magenta
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)', // Red
                            'rgba(54, 162, 235, 1)', // Blue
                            'rgba(255, 206, 86, 1)', // Yellow
                            'rgba(75, 192, 192, 1)', // Green
                            'rgba(153, 102, 255, 1)', // Purple
                            'rgba(255, 159, 64, 1)', // Orange
                            'rgba(0, 255, 255, 0.2)', // Cyan
                            'rgba(255, 0, 255, 0.2)' // Magenta
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {}
                }
            });
        </script>

    @endsection
