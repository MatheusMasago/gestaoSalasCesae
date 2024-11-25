@extends('layouts.main_layout')

@section('content')


<div id="graficoSala" class="position-absolute top-50 start-50 translate-middle">
    <div  class="card m-b20"  style="width: 1000px" >
        <div class="card-body" >
            <h4 class="mt-0 header-title mb-3">Salas mais usadas</h4>
            <hr>
            <div class="inbox-wid">
                <div class="inbox-item">
                    <canvas id="myChart">Gráfico</canvas>
                </div>
            </div>
        </div>
    </div>

</div>


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
          label: 'Horas',
          //Este "data" é para o valor em horas de cada sala
          data: data,
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
        responsive:true,
        scales: {
        }
      }
    });
  </script>


@endsection
