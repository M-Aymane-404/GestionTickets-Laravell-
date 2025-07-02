<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/client/ticketDetails.css') }}">
     <title>Gestion de Tickets</title>




</head>
<body style="     background-color: #dce3e7;">
<!-- Conteneur principal -->
<div class="row layout m-0 p-0">

    <!-- Barre latérale -->
    <div id="sidebare" class="sidebare d-flex flex-column col-2">

        <!-- Bouton de toggle -->
        <div class="button">
            <button class="toggle-btn" onclick="toggleSidebar()">⇄</button>
        </div>

        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="" width="70px">
        </div>

        <!-- Menu de navigation -->
        <div class="hide dashbord mt-4">
            <a href="{{ route('dashboard.admin') }}"><i class="fas fa-chart-line me-2"></i> Dashboard</a>
        </div>

        <div class="hide">
            <a href="{{ route('createTicket.client') }}"><i class="fas fa-user-plus me-2"></i> Créer ticket</a>
        </div>
        <div class="hide">
            <a href="{{ route('profile.edit') }}"><i class="fas fa-user-circle me-2"></i> Profile</a>
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
    <!-- Fin de la barre latérale -->

    <!-- Contenu principal -->
    <div class="content col">
        <div class="row twoBorder">

            <!-- Détails du ticket -->
            <div class="col-8 mt-3 details">
            @if ($ticket->etat == 'nouveau')
            <div class="d-flex bare align-content-center justify-content-end">
                <div class="col-6 row bareEtat align-content-center justify-content-center">
                    <div class="col d-flex justify-content-center align-content-center selectedEtat columnEtat">nouveau</div>
                    <div class="col d-flex justify-content-center align-content-center border border-secondary  columnEtat">en Cours</div>
                    <div class="col d-flex justify-content-center align-content-center border border-secondary columnEtat">traité</div>
                    <div class="col d-flex justify-content-center align-content-center border border-secondary columnEtat">fermé</div>
                </div>
            </div>
            @elseif ($ticket->etat == 'enCours')
            <div class="d-flex bare align-content-center justify-content-end">
                <div class="col-6 row bareEtat align-content-center justify-content-center">
                    <div class="col d-flex justify-content-center align-content-center  columnEtat">nouveau</div>
                    <div class="col d-flex justify-content-center align-content-center border border-secondary selectedEtat columnEtat">en Cours</div>
                    <div class="col d-flex justify-content-center align-content-center border border-secondary columnEtat">traité</div>
                    <div class="col d-flex justify-content-center align-content-center border border-secondary columnEtat">fermé</div>
                </div>
            </div>
            @elseif ($ticket->etat == 'traiter')
            <div class="d-flex bare align-content-center justify-content-end">
                <div class="col-6 row bareEtat align-content-center justify-content-center">
                    <div class="col d-flex justify-content-center align-content-center   columnEtat">nouveau</div>
                    <div class="col d-flex justify-content-center align-content-center border border-secondary  columnEtat">en Cours</div>
                    <div class="col d-flex justify-content-center align-content-center border border-secondary selectedEtat columnEtat">traité</div>
                    <div class="col d-flex justify-content-center align-content-center border border-secondary columnEtat">fermé</div>
                </div>
            </div>
            @else
            <div class="d-flex bare align-content-center justify-content-end">
                <div class="col-6 row bareEtat align-content-center justify-content-center">
                    <div class="col d-flex justify-content-center align-content-center   columnEtat">nouveau</div>
                    <div class="col d-flex justify-content-center align-content-center border border-secondary  columnEtat">en Cours</div>
                    <div class="col d-flex justify-content-center align-content-center border border-secondary columnEtat">traité</div>
                    <div class="col d-flex justify-content-center align-content-center border border-secondary selectedEtat columnEtat">fermé</div>
                </div>
            </div>
            @endif
                <!-- Barre d'états -->

                <!-- Carte des détails -->
                <div class="container  mt-5 carte">

                    <!-- Titre -->
                    <div class="col title">
                        {{ $ticket->titre }}
                    </div>

                    <!-- Contenu de la carte -->
                    <div class="col contentCarte">
                        <div class="col" style="line-height: 25px;">
                            <strong>Description :</strong>
                            <span> {{  $ticket->description, 150 }}</span>
                        </div>
                        <div class="col"><strong>Assignee :</strong> <span>{{ $ticket->leNomAssistant() }}</span></div>
                        <div class="col"><strong>Demandeur :</strong> <span>{{ $ticket->leNomdemandeur()}}</span></div>
                        <div class="col"><strong>Date :</strong> <span> {{ \Carbon\Carbon::parse($ticket->date)->format('d M Y') }}</span></div>
                       <!--<div class="col"><strong>Status :</strong> <span>fermer</span></div>-->
                        <div class="col"><strong>le délai de la fermeture :</strong> <span>{{ $ticket->ledelaiDefermeture() }}</span></div>
                         @if ($ticket->piecesJointes)
                        <div class="col piece"><a href="{{ asset('storage/' . $ticket->piecesJointes) }} " target="_blank">la pièce de jointure</a></div>
                        @endif

                    </div>



                </div>
                <!-- Fin carte détails -->


                <div class="col container ticketEtat   ">
                    <div class="col d-flex justify-content-center align-items-center  dateEtat">
                        @if ($ticket->etat == 'nouveau')
                        <div class="row">
                            <strong>etat nouveau</strong>
                            <span>{{ \Carbon\Carbon::parse( $barre_etat->created_at)->format('d M Y') }}</span>
                        </div>
                        @elseif ($ticket->etat == 'enCours')
                        <div  class="row ">
                            <strong>etat nouveau</strong>
                            <span>{{ \Carbon\Carbon::parse( $barre_etat->created_at)->format('d M Y') }}</span>
                        </div>
                        <div class="row">
                            <strong>etat En Cours</strong>
                            <span>{{ \Carbon\Carbon::parse( $barre_etat->date_enCours )->format('d M Y') }}</span>
                        </div>
                        @elseif ($ticket->etat == 'traiter')
                        <div class="row">
                            <strong>etat nouveau</strong>
                            <span>{{ \Carbon\Carbon::parse( $barre_etat->created_at )->format('d M Y') }}</span>
                        </div>
                        <div class="row">
                            <strong>etat En Cours</strong>
                            <span>{{ \Carbon\Carbon::parse( $barre_etat->date_enCours )->format('d M Y') }}</span>
                        </div>
                        <div class="row">
                            <strong>etat traiter</strong>
                            <span>{{ \Carbon\Carbon::parse( $barre_etat->date_traiter )->format('d M Y') }}</span>
                        </div>
                        @else
                        <div  class="row">
                            <strong>etat nouveau</strong>
                            <span>{{ \Carbon\Carbon::parse( $barre_etat->created_at )->format('d M Y') }}</span>
                        </div>
                        <div class="row">
                            <strong>etat En Cours</strong>
                            <span>{{ \Carbon\Carbon::parse( $barre_etat->date_enCours )->format('d M Y') }}</span>
                        </div>
                        <div class="row">
                            <strong>etat traiter</strong>
                            <span>{{ \Carbon\Carbon::parse( $barre_etat->date_traiter)->format('d M Y') }}</span>
                        </div>
                        <div class="row">
                            <strong>etat fermer</strong>
                            <span>{{ \Carbon\Carbon::parse( $barre_etat->date_fermer )->format('d M Y') }}</span>
                        </div>
                        @endif


                    </div>
                </div>

            </div>
            <!-- Fin détails -->

            <!--   messages -->
            <div class="col messagesCarte d-flex flex-column  ">

                    <div><h3>les messages</h3></div>
                     <div class="messages  message-scroll  ">
            @foreach ($messages as $message)
                        <div class="message">
                            <div class="userAndMessage">
                                <div class="user">{{ $message->emetteur }} </div>
                                <hr>
                                <div class="ms-2"> message : <span>{{ $message->messageEnvoyer }}</span></div>
@if ($message->piecesJointes)
                        <div class="col pieceMessage"><a href="{{ asset('storage/' . $message->piecesJointes) }}"  target="_blank">la pièce de jointure</a></div>
@endif

                            </div>
                                <div class="date">{{ \Carbon\Carbon::parse($message->date)->format('d M Y H:i') }}</div>
                        </div>
            @endforeach

                    </div>

                     <div class="inputmessage     ">
                        <hr>
                            <h4></h4>
                            <form action="{{ route('storeMessages', $ticket->id) }}" method="POST" enctype="multipart/form-data" class="row">
                            @csrf
                            <textarea name="messageEnvoyer"  class="form-control messageenvoyer" id="messageEnvoyer" rows="5" placeholder="saisir votre message " required></textarea>
                            <div class="row p-0 m-0 mt-2    ">
                                        <input type="file" name="piecesJointes" id="piecesJointes" class="form-control  col" >
                                        <button type="submit" class="col ms-3 envoyer">envoyer</button>
                                    </div>
                            </form>
                     </div>

             </div>
            <!-- Fin messages -->

        </div>
    </div>
    <!-- Fin contenu principal -->

</div>
<!-- Fin conteneur principal -->

<script> function toggleSidebar() {
      document.getElementById('sidebare').classList.toggle('collapsed');
    }</script>

</body>
</html>
