<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="{{ asset('css/admin/statistic.css') }}">
     <title>Gestion de Tickets</title>




</head>
<body style="background-color: #f9fafb">



   <div class="navBar d-flex  justify-content-between align-items-center  p-2">
    <div class="d-flex gap-1 ">
        <a href="{{ route('dashboard.admin') }}" class="pe-2 ps-2 pt-1 pb-1">tableau de bord</a>
        <a href="{{ route('listerUsers.admin') }}" class="pe-2 ps-2 pt-1 pb-1">Utilisateur</a>
        <a href="{{ route('addUser.admin') }}" class="pe-2 ps-2 pt-1 pb-1">Créer Utilisateur</a>
        <a href="{{ route('statistic.admin') }}" class="pe-2 ps-2 pt-1 pb-1">Statistique</a>
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

         <a href="{{ route('dashboard.admin') }}" class="pe-2 ps-2">tableau de bord</a><br>
        <a href="{{ route('listerUsers.admin') }}" class="pe-2 ps-2">Utilisateur</a><br>
        <a href="{{ route('addUser.admin') }}" class="pe-2 ps-2">Créer Utilisateur</a><br>
        <a href="{{ route('statistic.admin') }}" class="pe-2 ps-2">Statistique</a><br>

         <a href="{{ route('profile.edit') }}" class="pe-2 ps-2">Profile</a><br>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="pe-2 ps-2"
               onclick="event.preventDefault(); this.closest('form').submit();">
                déconnexion
            </a>
        </form>
     </div>




<h2 class="mt-2 mb-2">Délai moyen de fermeture par assistant  </h2>

<div class="gragh">
    <canvas id="delaiChart"></canvas>
</div>

<script>
    const labels = {!! json_encode(array_column($stats, 'assistant')) !!};
    const data = {!! json_encode(array_column($stats, 'avg_closing_time_minutes')) !!};

    const colors = [
        '#42a5f5', '#ef5350', '#66bb6a', '#ffa726',
        '#ab47bc', '#26c6da', '#8d6e63', '#d4e157',
        '#5c6bc0', '#ec407a', '#26a69a', '#7e57c2'
    ];

    const backgroundColors = labels.map((_, index) => colors[index % colors.length]);

    const ctx = document.getElementById('delaiChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Délai moyen (en minutes)',
                data: data,
                backgroundColor: backgroundColors,
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
       options: {
    indexAxis: 'y',
    responsive: false,
    plugins: {
        legend: {
            position: 'top'
        },
        tooltip: {
            callbacks: {
                label: function(context) {
                    return `${context.label}: ${context.raw} min`;
                }
            }
        }
    },
    scales: {
        y: {
            ticks: {
                font: {
                    size: 14,           // taille du texte
                    family: 'Poppins',  // police
                    weight: 'bold'      // texte en gras
                },
                color: '#000'           // couleur noire
            }
        }
    },
    maintainAspectRatio: false
}

    });
  function toggleMobileBAr() {
      document.getElementById('navBarMobile').classList.toggle('collapsed');
    }</script>

</body>
</html>
