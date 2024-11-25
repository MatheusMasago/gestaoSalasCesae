@extends('layouts.main_layout')

@section('content')


<div id="cards" class="position-absolute top-50 start-0 translate-middle">

<div  class="card text-bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header">Salas Usadas</div>
        <div class="card-body">
        <h5 class="card-title">Veja quantas Salas estão reservadas</h5>
        <p class="card-text">As seguintes salas já estão reservadas: {{$id}}</p>
        </div>
    </div>
</div>

<div id="cards2" class="position-absolute top-50 end-0 translate-middle-y">
 <div  class="card text-bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header">As Salas mais reservadas</div>
        <div class="card-body">
        <h5 class="card-title">Veja quais as nossas salas mais reservadas</h5>
        <p class="card-text">Veja nossas Salas mais usadas <a href="{{route('user.dashboard')}}">aqui</a></p>
        </div>
    </div>
</div>

<div id="graficoSala" class="position-absolute top-50 start-50 translate-middle">


    <div  class="card m-b20"  style="width: 800px" >
        <div class="card-body" >
            <h4 class="mt-0 header-title mb-3">Salas Reservadas</h4>
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

        const id = @json($id);
        const roomName= @json($room_name);

    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Sala','Sala','Sala',],
        datasets: [{
          label: 'Horas',
          // total de salas reservadas
          data: id,
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
          y: {
           id
          }
        }
      }
    });
  </script>

@endsection




























{{--<div id="usageChart" class="position-absolute top-50 start-50 translate-middle">
    <div  class="card m-b20"  style="width: 1000px" >
        <div class="card-body" >
            <h4 class="mt-0 header-title mb-3">Salas reservadas</h4>
            <hr>
            <div class="inbox-wid">
                <div class="inbox-item">
                    <canvas id="usageChart">Gráfico</canvas>
                </div>
            </div>
        </div>
    </div>

</>

<script>

const DATA_COUNT = 7;
const NUMBER_CFG = {count: DATA_COUNT, max: 100};

const labels = Utils.months({count: 7});
const data = {
  labels: labels,
  datasets: [
    {
      label: 'Dataset 1',
      data: Utils.numbers(NUMBER_CFG),
      borderColor: Utils.CHART_COLORS.red,
      backgroundColor: Utils.transparentize(Utils.CHART_COLORS.red, 0.5),
    },
    {
      label: 'Dataset 2',
      data: Utils.numbers(NUMBER_CFG),
      borderColor: Utils.CHART_COLORS.blue,
      backgroundColor: Utils.transparentize(Utils.CHART_COLORS.blue, 0.5),
    }
  ]
}
     const ctx = document.getElementById('usageChart');
     new Chart(ctx,{
  type: 'bar',
  data: data,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Chart.js Bar Chart'
      }
    }
  },
});
</script> --}}
