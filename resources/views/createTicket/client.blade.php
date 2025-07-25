<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/client/addTicket.css') }}">
     <title>Gestion de Tickets</title>




</head>
<body style="background-color: #f9fafb">



   <div class="navBar d-flex  justify-content-between align-items-center  p-0 ">
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




<div class=" col  container  mt-4  ">
                                 <form action="{{ route('ticketStore') }}" method="POST"  enctype="multipart/form-data" >
                                @csrf

                                <!-- Title Field (titre) -->
                                <div class="form-group">
                                    <label for="titre" class="form-label">Titre</label>
                                    <input type="text" name="titre" id="titre" class="form-control " value="{{ old('titre') }}" required>

                                </div>

                                <!-- Description Field (description) -->
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control  " rows="4" required>{{ old('description') }}</textarea>

                                </div>


                                <div class="form-group">


                            <label for="piecesJointes" class="form-label">la piece de jointure :   <i class="fas fa-paperclip"></i></label>
                            <input type="file" name="piecesJointes" id="piecesJointes" class="form-control">
                        </div>

                               <div class="col d-flex mt-3 justify-content-center">
                                   <button type="submit" class="btnAdd col-5">Submit</button>
                                </div> <!-- Submit Button -->
                            </form>
</div>














<script> function toggleMobileBAr() {
      document.getElementById('navBarMobile').classList.toggle('collapsed');
    }</script>

</body>
</html>
