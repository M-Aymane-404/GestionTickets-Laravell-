<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin/dashbord.css') }}">
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

     <div class="statistic d-flex gap-3  justify-content-center mt-4  ">
        <div class="  ">
            <h4>{{ $nomberTicket }}</h4>
            <p>tickets</p>
        </div>
        <div class=" ">
            <h4>{{ $nomberclient }}</h4>
            <p>clients</p>
        </div>
        <div class=" ">
            <h4>{{ $nomberAssistant }}</h4>
            <p>assistants</p>
        </div>
     </div>

<div class="col-12 mt-4 d-flex justify-content-center   ">
    <form action="{{ route('dashboard.admin') }}" method="GET">
       @csrf
          <input type="text" class="searchInput  " name="searchTerm" placeholder="Search tickets..."  aria-label="Search" >

      <button class=" searchBtn" type="submit">Search</button>
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

            <tr   onclick="window.location='{{ route('ticketDetails.admin', $ticket) }}'" style="cursor: pointer;">

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


    {{--

         <div class="row layout m-0 p-0   "  >
                <div id="sidebare" class="sidebare d-flex flex-column    col-2  ">
                    <div class="button">
                         <button class="toggle-btn"  onclick="toggleSidebar()">⇄</button>
                    </div>
                <div class="  logo  ">
                   <img src="{{ asset('img/logo.png') }}" alt="" width="70px">
                </div>
                 <div class="hide dashbord mt-4 ">
                    <a href="{{ route('dashboard.admin') }}"><i class="fas fa-chart-line me-2"></i> Dashboard</a>
                </div>
                <div class="hide ">
                    <a href="{{ route('listerUsers.admin') }}"><i class="fas fa-users me-2"></i> Utilisateur</a>
                </div>
                <div class="hide ">
                    <a href="{{ route('addUser.admin') }}"><i class="fas fa-user-plus me-2"></i> Créer Utilisateur</a>
                </div>

                      <div class=" hide">
                    <a href="{{ route('profile.edit') }}"><i class="fas fa-user-circle me-2 "></i> Profile</a>
                </div>
                  <div class="hide">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i> déconnexion
                        </a>
                        </form>
                </div>

            </div>


        <div class="  content col    ">
            <!-- statistic-->
                            <div class="row  statistic mt-4 justify-content-evenly">
                    <div class="col-2 stat-box text-center">
                        <strong class="stat-number">{{ $nomberTicket }}</strong>
                        <div class="stat-label">nombre de ticket</div>
                    </div>
                    <div class="col-2 stat-box text-center">
                        <strong class="stat-number">{{ $nomberclient }}</strong>
                        <div class="stat-label">nombre de client</div>
                    </div>
                    <div class="col-2 stat-box text-center">
                        <strong class="stat-number">{{ $nomberAssistant }}</strong>
                        <div class="stat-label">nombre d'assistant</div>
                    </div>
                    </div>





        <!--lister tickets -->

        <form action="{{ route('dashboard.admin') }}" method="GET">
       @csrf
        <div class="container-fluid mt-5 bg-body-secondary border   col-11 ">
               <div class="row mt-4 mb-4 align-items-center">
  <div class="col-md-2">
    <h2 class="fw-bold m-0">Tickets</h2>
  </div>

  <div class="col-md-2"></div>




  <div class="col-md-8">
    <div class="input-group">
      <!-- Dropdown for status -->
      <input type="text" class="form-control " name="searchTerm" placeholder="Search tickets..."  aria-label="Search">



      <!-- Search input -->
      <button class="btn btn-outline-primary" type="submit">Search</button>
    </div>
</div>
</div>
</form>


             <div class="row thead mt-2 align-items-center   fw-bold     py-2">
    <div class="col">Title</div>
    <div class="col-4 description">Description</div>
    <div class="col assistant">Assistant</div>
    <div class="col">Demandeur</div>
    <div class="col date">Date</div>
    <div class="col">Status</div>
    <div class="col">Action</div>
</div>




            <div  class="tickets-scroll mt-3">
            @foreach ($tickets as $ticket)

                 <div class="row ticket  mt-2 d-flex     justify-content-evenly   ">
                    <div class="col d-flex align-items-center ">{{ $ticket->titre }}</div>
                    <div class="col-4 d-flex align-items-center description">{{ \Illuminate\Support\Str::limit($ticket->description, 50) }}</div>
                    <div class="col d-flex align-items-center assistant">{{ $ticket->leNomAssistant()}}</div>
                    <div class="col d-flex align-items-center">{{ $ticket->leNomdemandeur() }}</div>
                    <div class="col d-flex align-items-center date">{{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y') }}</div>
                    <div class="col d-flex align-items-center">
                    @if ($ticket->etat == 'nouveau')
                     <p class="nv mb-0">{{ $ticket->etat }}</p>
                    @elseif ($ticket->etat == 'enCours')
                     <p class="ec mb-0">{{ $ticket->etat }}</p>
                    @elseif ($ticket->etat == 'traiter')
                     <p class="tr mb-0">{{ $ticket->etat }}</p>
                     @else
                     <p class="fr mb-0">{{ $ticket->etat }}</p>
                     @endif
                    </div>
                    <div class="col d-flex align-items-center view"><a href="{{ route('ticketDetails.admin',$ticket) }}">view</a></div>

                </div>
                <div class="carte  ">
                <div class="col d-flex  align-items-center justify-content-center "><strong>Title   </strong>: {{ $ticket->titre }}</div>
                <div class="col d-flex align-items-center justify-content-center "><strong>Demandeur  </strong>: {{ $ticket->leNomdemandeur() }}</div>
                <div class="col d-flex align-items-center  justify-content-center view"><strong>Action    </strong>: <a style="  margin-left :10px; " href="{{ route('ticketDetails.admin',$ticket) }}">view</a></div>

                </div>
            @endforeach

            </div>

        </div>





        </div>
        </div>
<script> function toggleSidebar() {
      document.getElementById('sidebare').classList.toggle('collapsed');
    }</script>
--}}
</body>
</html>
