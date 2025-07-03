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



            <div class="col container content   ">
                <div class="col-9 mt-3 ">

                                <div class="mb-4 title">
                                    <h1>modifier le Ticket</h1>
                                </div>

                                <!-- Display validation errors if any -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('updateTicket.admin', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')


                                    <div class="form-group">
                                        <label for="titre">Title</label>
                                        <input type="text" id="titre" name="titre" class="form-control" value="{{ old('titre', $ticket->titre) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description" class="form-control" required>{{ old('description', $ticket->description) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="assignee">assistant</label>
                                        <input type="text" id="assignee" name="assignee" class="form-control" value="{{ old('assignee', $ticket->assignee) }}" required>

                                    </div>

                                    <div class="form-group">
                                            <label for="piecesJointes">Upload File</label>
                                            <input type="file" name="piecesJointes" id="piecesJointes" class="form-control">
                                    </div>




                                    <div class="form-group">
                                        <label for="etat">Status</label>
                                        <select id="etat" name="etat" class="form-control" required>
                                            <option value="nouveau" {{ old('etat', $ticket->etat) == 'nouveau' ? 'selected' : '' }}>Nouveau</option>
                                            <option value="enCours" {{ old('etat', $ticket->etat) == 'enCours' ? 'selected' : '' }}>En Cours</option>
                                            <option value="traiter" {{ old('etat', $ticket->etat) == 'traiter' ? 'selected' : '' }}>Traité</option>
                                            <option value="fermer" {{ old('etat', $ticket->etat) == 'fermer' ? 'selected' : '' }}>Fermé</option>
                                        </select>
                                    </div>



                                <div class=" col d-flex justify-content-center">

                                    <button type="submit" class="mt-2 btnModifier col-6       ">modifier Ticket</button>
                                </div>
                                </form>
                            </div>
                            </div>











</div>

<script> function toggleSidebar() {
      document.getElementById('sidebare').classList.toggle('collapsed');
    }</script>

</body>
</html>
