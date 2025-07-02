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
                    <a href="{{ route('dashboard.client') }}"><i class="fas fa-chart-line me-2"></i> Dashboard</a>
                </div>

                <div class="hide ">
                    <a href="{{ route('createTicket.client') }}"><i class="fas fa-user-plus me-2"></i> Créer ticket</a>
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



            <div class="col container content   ">
                                <div class=" col-10 container mt-5">

                        <div class="card-header ">
                            <h1>Submit Ticket</h1>
                        </div>
                        <div class="card-body mt-4">
                            <form action="{{ route('ticketStore') }}" method="POST"  enctype="multipart/form-data" >
                                @csrf

                                <!-- Title Field (titre) -->
                                <div class="form-group">
                                    <label for="titre" class="form-label">Title</label>
                                    <input type="text" name="titre" id="titre" class="form-control " value="{{ old('titre') }}" required>

                                </div>

                                <!-- Description Field (description) -->
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control  " rows="4" required>{{ old('description') }}</textarea>

                                </div>


                                <div class="form-group">
                            <label for="piecesJointes" class="form-label">Upload File</label>
                            <input type="file" name="piecesJointes" id="piecesJointes" class="form-control">
                        </div>

                               <div class="col d-flex justify-content-center">
                                   <button type="submit" class="btnAdd col-5">Submit</button>
                                </div> <!-- Submit Button -->
                            </form>
                        </div>
                 </div>

            </div>
</div>

<script> function toggleSidebar() {
      document.getElementById('sidebare').classList.toggle('collapsed');
    }</script>

</body>
</html>
