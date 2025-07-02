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
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                        </form>
                </div>

            </div>


        <div class="  content col    ">

<div class="row">

            <div class=" users-scroll col container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col">assistant</th>
                <th class="col">nombre de ticket</th>
                <th class="col">supprimer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assistants as $assistant)
                <tr>

                    <td>{{ $assistant->lastName }}</td>
                    <td>{{ $assistant->leNbTicketAssignee() }}</td>
                    <td>
                        <form action="{{ route('user.delete',$assistant) }}" method="POST">
                         @csrf

                        @method('DELETE')
                        <button type="submit">delete</button>
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container users-scroll col">
    <div class="table table-striped">
        <div class="row">

                <div class="col">client</div>
                <div class="col">nombre de ticket</div>
                <div class="col">supprimer</div>

        </div>
        <div class="">
            @foreach ($clients as $client)
                <div class="row">

                    <div class="col">{{ $client->lastName }}</div>
                    <div class="col">{{ $client->leNbTicketdemander() }}</div>
                    <div class="col"><form action="{{ route('user.delete',$client) }}" method="POST">
                          @csrf

                        @method('DELETE')
                        <button type="submit">delete</button></form></div>
                </div>
            @endforeach
        </div>
    </div>
</div>

</div>

        </div>
        </div>
<script> function toggleSidebar() {
      document.getElementById('sidebare').classList.toggle('collapsed');
    }</script>

</body>
</html>
