<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="{{ asset('css/assistant/statistic.css') }}">
     <title>Gestion de Tickets</title>




</head>
<body style="background-color: #f9fafb">



   <div class="navBar d-flex  justify-content-between align-items-center  p-0 m-0">
    <div class="d-flex gap-1 ">
        <a href="{{ route('dashboard.assistant') }}" class="pe-2 ps-2 pt-1 pb-1">tableau de bord</a>
         <a href="{{ route('statistic.assistant') }}" class="pe-2 ps-2 pt-1 pb-1">Statistique</a>
    </div>

    <div class="d-flex gap-3">
        <a href="{{ route('profile.edit') }}" class="pe-2 ps-2 pt-1 pb-1">Profile</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="pe-2 ps-2 pt-1 pb-1 text-danger"
               onclick="event.preventDefault(); this.closest('form').submit();">
                ⏻
            </a>
        </form>
    </div>
    </div>
        <div class="button">
                         <button class="toggle-btn"  onclick="toggleMobileBAr()">☰</button>
        </div>
    <div class="navBarMobile    p-2" id="navBarMobile">

         <a href="{{ route('dashboard.assistant') }}" class="pe-2 ps-2">tableau de bord</a><br>
         <a href="{{ route('addUser.admin') }}" class="pe-2 ps-2">Statistique</a><br>

         <a href="{{ route('profile.edit') }}" class="pe-2 ps-2">Profile</a><br>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="pe-2 ps-2"
               onclick="event.preventDefault(); this.closest('form').submit();">
                déconnexion
            </a>
        </form>
     </div>



                       <form action="{{ route('statistic.assistant') }}" method="GET" class="date-form mt-3">
    @csrf
    <input type="date" name="datedebut" id="datedebut">
    <input type="date" name="datefin" id="datefin">
    <button class="searchBtn" type="submit">Afficher</button>
</form>






                    <div class="graph mt-5  " >

                        <canvas id="ticketChart" width=" 1200" height="1000">
                    </div>

                    </canvas>

















<script>
    const ctx = document.getElementById('ticketChart').getContext('2d');

    const data = {
        labels: {!! json_encode($nbTicketsParEtat->pluck('etat')) !!},
        datasets: [{
            label: 'Nombre de Tickets',
            data: {!! json_encode($nbTicketsParEtat->pluck('total')) !!},
            backgroundColor: [
                '#4caf50',
                '#2196f3',
                '#ff9800',
                '#9c27b0'
            ],
            borderWidth: 1
        }]
    };

  const config = {
    type: 'bar',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    font: {
                        size: 14,
                        family: 'Poppins' // change selon tes préférences
                    },
                    color: '#000000', // couleur du texte sur l'axe Y
                    stepSize: 1
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 14,
                        family: 'Poppins'
                    },
                    color: '#000000' // couleur du texte sur l'axe X
                }
            }
        }
    }
};



    const ticketChart = new Chart(ctx, config);












  function toggleMobileBAr() {
      document.getElementById('navBarMobile').classList.toggle('collapsed');
    }</script>

</body>
</html>
