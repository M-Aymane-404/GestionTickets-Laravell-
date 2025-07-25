<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin/editTicket.css') }}">
     <title>Gestion de Tickets</title>




</head>
<body style="background-color: #f9fafb" class="p-0 m-0">



   <div class="navBar d-flex  justify-content-between align-items-center  p-0 m-0">
    <div class="d-flex gap-1 ">
        <a href="{{ route('dashboard.admin') }}" class="pe-2 ps-2 pt-1 pb-1">tableau de bord</a>
        <a href="{{ route('listerUsers.admin') }}" class="pe-2 ps-2 pt-1 pb-1">Utilisateur</a>
        <a href="{{ route('addUser.admin') }}" class="pe-2 ps-2 pt-1 pb-1">Créer Utilisateur</a>
        <a href="{{ route('addUser.admin') }}" class="pe-2 ps-2 pt-1 pb-1">Statistique</a>
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



     <div class="row p-0 m-0 " style="background-color: #f9fafb">
           <form action="{{ route('updateTicket.admin', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
        <div class="col-12 ticket  ">

            <div class="ticketinfo container col-11 mt-5 p-4 ">
                <h1 class="mt-2"> <input type="text" id="titre" name="titre"  value="{{ old('titre', $ticket->titre) }}" required> </h1>



                <div class="row container mt-4 info " >
                        <p class="col-6"><span class="me-3"> assignee a </span>  <input class="input" type="text" id="assignee" name="assignee"   value="{{ old('assignee', $ticket->assignee) }}" required></p>

                <p class="col-6 status"><span class="me-3">
                    <select id="etat" name="etat" class="form-control status" required>
                                             <option value="nouveau" {{ old('etat', $ticket->etat) == 'nouveau' ? 'selected' : '' }}>Nouveau</option>
                                            <option value="enCours" {{ old('etat', $ticket->etat) == 'enCours' ? 'selected' : '' }}>En Cours</option>
                                            <option value="traiter" {{ old('etat', $ticket->etat) == 'traiter' ? 'selected' : '' }}>Traité</option>
                                            <option value="fermer" {{ old('etat', $ticket->etat) == 'fermer' ? 'selected' : '' }}>Fermé</option>
                                        </select>
                </span>

                </p>
                 <p class="col-6"><span class="me-3"> piece de joiture </span>
                                                                     <input type="file" name="piecesJointes" id="piecesJointes">

                                                     <label for="piecesJointes" class="custom-file-label col">
                                                   📁 choisir un fichier
                                                    </label>
                                                </p>


                 </div>



                <div class="mt-4 col-12 description">
                    <span class="ps-2 pe-2  "> Description </span>
                     <p class=" pt-3 "><textarea id="description" name="description" class="col-12 input" rows="5" required>{{ old('description', $ticket->description) }}</textarea></p>

                </div>
                <div class=" d-flex justify-content-center">                <button type="submit" class="mt-2 btnModifier col-4 d-flex justify-content-center       ">modifier Ticket</button>
</div>
            </div>




        </div>

           </form>

     </div>















<script> function toggleMobileBAr() {
      document.getElementById('navBarMobile').classList.toggle('collapsed');
    }
    function SendMessage() {
      document.getElementById('envoyerMessage').classList.toggle('showEnvoyerMessage');

    event.stopPropagation();
    }

    </script>

</body>
</html>
