<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/client/dashbord.css') }}">
     <title>Gestion de Tickets</title>




</head>
<body>

       <body style="background-color: #f9fafb">



   <div class="navBar d-flex  justify-content-between align-items-center  p-2">
    <div class="d-flex gap-1 ">
        <a href="{{ route('dashboard.client') }}" class="pe-2 ps-2 pt-1 pb-1">tableau de bord</a>
         <a href="{{ route('createTicket.client') }}" class="pe-2 ps-2 pt-1 pb-1">Créer ticket</a>
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

         <a href="{{ route('dashboard.client') }}" class="pe-2 ps-2">tableau de bord</a><br>
         <a href="{{ route('createTicket.client') }}" class="pe-2 ps-2">Créer ticket</a><br>

         <a href="{{ route('profile.edit') }}" class="pe-2 ps-2">Profile</a><br>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="pe-2 ps-2"
               onclick="event.preventDefault(); this.closest('form').submit();">
                déconnexion
            </a>
        </form>
     </div>




<div class=" col mt-4 table">
    <table>
        <thead>
            <th>Title</th>
            <th>Description</th>
            <th>Assistant</th>
            <th>Demandeur</th>
            <th>Date</th>
            <th>Status</th>

        </thead>
        <tbody>
            @foreach ($tickets as $ticket )

            <tr   onclick="window.location='{{ route('ticketDetails.client', $ticket) }}'" style="cursor: pointer;">

                <td>{{ $ticket->titre }}</td>
                <td>{{ \Illuminate\Support\Str::limit($ticket->description, 90) }}</td>
                <td>{{ $ticket->leNomAssistant()}}</td>
                <td>{{ $ticket->leNomdemandeur() }}</td>
                <td>{{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y') }}</td>
                @if ($ticket->etat == 'nouveau')
                <td class=""><span class="status-nouveau me-2 ms-2"></span>{{ $ticket->etat }}</td>
                @elseif ($ticket->etat == 'enCours')
                <td class=""><span class="status-encours me-2 ms-2"></span>{{ $ticket->etat }}</td>
                @elseif ($ticket->etat == 'traiter')
                <td class=""><span class="status-traites me-2 ms-2"></span>{{ $ticket->etat }}</td>
                @else
                <td class=""><span class="status-ferme me-2 ms-2"></span>{{ $ticket->etat }}</td>
                @endif

            </tr>
             @endforeach
        </tbody>




    </table>
</div>













<script> function toggleMobileBAr() {
      document.getElementById('navBarMobile').classList.toggle('collapsed');
    }</script>

</body>
</html>
