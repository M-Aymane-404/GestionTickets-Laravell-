<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin/listerUser.css') }}">
     <title>Gestion de Tickets</title>




</head>
<body>

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

<div class="row twoTable d-flex justify-content-evenly mt-5">

           <div class=" bg-white   col-6">
         <div class="row col thead ">

                <div class="col-2">client</div>
                <div class="col mail">email</div>

                <div class="col-3">nombre de ticket</div>
                <div class="col-2">supprimer</div>

        </div>
        <div class="users-scroll col">
            @foreach ($clients as $client)
                <div class="row tbody">

                    <div class="col-2">{{ $client->lastName }}</div>
                                        <div class="col mail">{{ $client->email }}</div>

                    <div class="col-3">{{ $client->leNbTicketdemander() }}</div>
                    <div class="col-2"><form action="{{ route('user.delete',$client) }}" method="POST">
                          @csrf

                        @method('DELETE')
                        <button type="submit">🗑</button></form></div>
                </div>
            @endforeach


        </div>
 </div>


           <div class=" bg-white   col-6">
         <div class="row col thead ">

                <div class="col-2">assistant</div>
                <div class="col mail">email</div>

                <div class="col-3">nombre de ticket</div>
                <div class="col-2">supprimer</div>

        </div>
        <div class="users-scroll col">
            @foreach ($assistants as $assistant)
                <div class="row tbody">

                    <div class="col-2">{{ $assistant->lastName }}</div>
                                        <div class="col mail">{{ $assistant->email }}</div>

                    <div class="col-3">{{ $assistant->leNbTicketAssignee() }}</div>
                    <div class="col-2"><form action="{{ route('user.delete',$assistant) }}" method="POST">
                          @csrf

                        @method('DELETE')
                        <button type="submit">🗑</button></form></div>
                </div>
            @endforeach


        </div>

</div>





        </div>
        </div>
<script> function toggleSidebar() {
      document.getElementById('sidebare').classList.toggle('collapsed');
    }</script>

</body>
</html>
