<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/assistant/ticketDetails.css') }}">
     <title>Gestion de Tickets</title>




</head>
<body style="background-color: #f9fafb" class="p-0 m-0">



   <div class="navBar d-flex  justify-content-between align-items-center  p-0 m-0">
    <div class="d-flex gap-1 ">
        <a href="{{ route('dashboard.assistant') }}" class="pe-2 ps-2 pt-1 pb-1">tableau de bord</a>
          <a href="{{ route('statistic.assistant') }}" class="pe-2 ps-2 pt-1 pb-1">Statistique</a>
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

         <a href="{{ route('dashboard.assistant') }}" class="pe-2 ps-2">tableau de bord</a><br>
          <a href="{{ route('statistic.assistant') }}" class="pe-2 ps-2">Statistique</a><br>

         <a href="{{ route('profile.edit') }}" class="pe-2 ps-2">Profile</a><br>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="pe-2 ps-2"
               onclick="event.preventDefault(); this.closest('form').submit();">
                déconnexion
            </a>
        </form>
     </div>



     <div class="row twoDiv p-0 m-0 " style="background-color: #f9fafb">
        <div class="col-8 ticket  ">
            <div class="etatBare row mt-3  ">
                 @if ($ticket->etat == 'nouveau')
                          <form class="etatButton" action="{{ route('updateEtats.assistant',$ticket) }}" method="POST">
                             @csrf
                             @method('PATCH')
                              <div  class="col-1 buttonSeleceted" >Nouveau</div>
                              <button type="submit" class="col-1">en cours</button>
                         </form>




                         @elseif ($ticket->etat == 'enCours')

                         <form class="etatButton " class="col  " action="{{ route('updateEtats.assistant',$ticket) }}" method="POST">
                            @csrf
                            @method('PATCH')
                             <div  class="col-1" >Nouveau</div>
                          <div  class="col-1 buttonSeleceted" >en cours</div>
                            <button type="submit"class="col-1" >Traiter</button>
                        </form>


                         @elseif ($ticket->etat == 'traiter')

                         <form class="etatButton row" action="{{ route('updateEtats.assistant',$ticket) }}" method="POST">
                            @csrf
                            @method('PATCH')
                             <div  class="col-1" >Nouveau</div>
                          <div  class="col-1" >en cours</div>
                          <div  class="col-1 buttonSeleceted" >Traiter</div>
                            <button type="submit  "class="col-1">fermer</button>
                        </form>
                        @else
                          <form class="etatButton row" action="{{ route('updateEtats.assistant',$ticket) }}" method="POST">
                            @csrf
                            @method('PATCH')
                             <div  class="col-1" >Nouveau</div>
                          <div  class="col-1" >en cours</div>
                          <div  class="col-1 " >Traiter</div>
                            <div  class="col-1 buttonSeleceted">fermer</div>
                        </form>
                        @endif
            </div>
            <div class="ticketinfo container col-11 mt-3 p-4 ">
                <h1 class="mt-2"> {{ $ticket->titre }}</h1>
                <div class="row container mt-4 info " >
                        <p class="col-6"><span class="me-3"> assignee a </span>{{ $ticket->leNomAssistant() }}</p>
                        <p class="col-6"><span class="me-3"> demandeur </span>{{ $ticket->leNomdemandeur()}}</p>
                        <p class="col-6"><span class="me-3">  date </span>{{ \Carbon\Carbon::parse($ticket->date)->format('d M Y') }}</p>
                        <p class="col-6"><span class="me-3"> duree de fermeture </span>{{ $ticket->ledelaiDefermeture() }}</p>
                      @if ($ticket->piecesJointes)
                         <a href="{{ asset('storage/' . $ticket->piecesJointes) }} " class="piece ms-4 mt-3" target="_blank">la pièce de jointure</a>
                       @endif
                </div>
                <div class="mt-4 col-12 description">
                    <span class="ps-2 pe-2  "> Description </span>
                     <p class=" pt-3 ">{{  $ticket->description}}</p>

                </div>
            </div>

            <div class="etatTime container col-11 mt-3">
                 @if ($ticket->etat == 'nouveau')
                <ul>
                    <li><span class="me-2">Nouveau ⮕</span>{{ \Carbon\Carbon::parse($barre_etat->created_at)->format('d M Y H:i') }}</li>

                </ul>
                @elseif ($ticket->etat == 'enCours')
                <ul>
                    <li><span class="me-2">Nouveau ⮕</span>{{ \Carbon\Carbon::parse($barre_etat->created_at)->format('d M Y H:i') }}</li>
                    <li class="mt-2"><span class="me-2">En cours ⮕</span>{{ \Carbon\Carbon::parse( $barre_etat->date_enCours)->format('d M Y H:i') }}</li>

                </ul>
                @elseif ($ticket->etat == 'traiter')
                <ul>
                    <li><span class="me-2">Nouveau ⮕</span>{{ \Carbon\Carbon::parse($barre_etat->created_at)->format('d M Y H:i') }}</li>
                    <li class="mt-2"><span class="me-2">En cours ⮕</span>{{ \Carbon\Carbon::parse( $barre_etat->date_enCours)->format('d M Y H:i') }}</li>
                    <li class="mt-2"><span class="me-4">Traiter ⮕</span>{{ \Carbon\Carbon::parse($barre_etat->date_traiter)->format('d M Y H:i') }}</li>

                </ul>
                @else
                <ul>
                    <li><span class="me-2 ">Nouveau ⮕</span>{{ \Carbon\Carbon::parse($barre_etat->created_at)->format('d M Y H:i') }}</li>
                    <li class="mt-2 "><span class="me-2">En cours ⮕</span>{{ \Carbon\Carbon::parse( $barre_etat->date_enCours)->format('d M Y H:i') }}</li>
                    <li class="mt-2 "><span class="me-4">Traiter  ⮕</span>{{ \Carbon\Carbon::parse($barre_etat->date_traiter)->format('d M Y H:i') }}</li>
                    <li class="mt-2 "><span class="me-3">Fermer   ⮕ </span>{{ \Carbon\Carbon::parse($barre_etat->date_fermer)->format('d M Y H:i') }}</li>

                </ul>
                @endif


            </div>


        </div>
        <div class="col-4 comment  mt-3">
            <div class="messageInput"  >
                <button id="envoyerButton" class="envoyerButton" onclick="SendMessage()">Envoyer Message</button>
                  <div class="envoyerMessage   mt-2  " id="envoyerMessage" onclick="event.stopPropagation()">

                            <form action="{{ route('storeMessageAssistant', $ticket->id) }}" method="POST" enctype="multipart/form-data" class="row">
                            @csrf
                            <textarea name="messageEnvoyer"  class="form-control messageenvoyer" id="messageEnvoyer" rows="1" placeholder="saisir votre message " required></textarea>
                            <div class="row p-0 m-0 mt-2    ">

                                <button type="submit" class="col-2 ms-3 envoyer">envoyer</button>
                                                    <input type="file" name="piecesJointes" id="piecesJointes">

                                                     <label for="piecesJointes" class="custom-file-label col">
                                                    <i class="fas fa-paperclip"></i>
                                                    </label>
                                    </div>
                            </form>
                     </div>
            </div>
             <div class="messages  message-scroll  ">
            @foreach ($messages as $message)
                        <div class="message">
                            <hr>
                            <span class=" date d-flex justify-content-center">{{ \Carbon\Carbon::parse($message->date)->format('d M Y H:i') }}</span>
                            <div class="userAndMessage ms-3">
                                <div class="user"> {{ $message->emetteur }}  </div>
                                 <div class="ms-2 mt-2 message"> <p>{{ $message->messageEnvoyer }}</p></div>
                                @if ($message->piecesJointes)
                                    <div class="col pieceMessage ms-4"><a href="{{ asset('storage/' . $message->piecesJointes) }}"  target="_blank">la pièce de jointure</a></div>
                                @endif

                            </div>
                         </div>
             @endforeach


                    </div>

        </div>
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
{{--
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
            <a href="{{ route('profile.edit') }}"><i class="fas fa-user-circle me-2"></i> Profile</a>
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
                         @if ($ticket->etat == 'nouveau')
                         <form class="etatButton" action="{{ route('updateEtats.assistant',$ticket) }}" method="POST">
                             @csrf
                             @method('PATCH')
                             <button type="submit">en cours</button>
                         </form>
                         @elseif ($ticket->etat == 'enCours')
                         <form class="etatButton" action="{{ route('updateEtats.assistant',$ticket) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Traiter</button>
                        </form>
                         @elseif ($ticket->etat == 'traiter')
                         <form class="etatButton" action="{{ route('updateEtats.assistant',$ticket) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">fermer</button>
                        </form>
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
                            <form action="{{ route('storeMessageAssistant', $ticket->id) }}" method="POST" enctype="multipart/form-data" class="row">
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

</body>--}}
</html>
