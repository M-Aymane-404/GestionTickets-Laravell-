<x-app-layout>
<x-baselayout>

<div class="container mt-4">

    <div class="row">

            <div class="col-12">

                <div class="card mb-4">


                    <div class="card-header">
                        <h5 class="card-title">{{ $ticket->titre }}</h5>
                    </div>
<div>
                    @if ($ticket->etat == 'nouveau')
                        <div class="container  text-center">
                                <div class="row  row-cols-auto border border-primary position-absolute top-0 end-0 bg-body-secondary">
                                    <div class="col bg-primary-subtle border border-primary">nouveau</div>
                                    <div class="col border border-secondary">en Cours</div>
                                    <div class="col border border-secondary">traité</div>
                                    <div class="col border border-secondary">fermé</div>
                                </div>
                        </div>



                     @elseif ($ticket->etat == 'enCours')
                        <div class="container  text-center">
                                <div class="row  row-cols-auto border border-primary position-absolute top-0 end-0 bg-body-secondary">
                                    <div class="col border border-secondary">nouveau</div>
                                    <div class="col bg-primary-subtle border border-primary">en Cours</div>
                                    <div class="col border border-secondary">traité</div>
                                    <div class="col border border-secondary">fermé</div>
                                </div>
                        </div>


                     @elseif ($ticket->etat == 'traiter')
                        <div class="container  text-center">
                                <div class="row  row-cols-auto border border-primary position-absolute top-0 end-0 bg-body-secondary">
                                    <div class="col border border-secondary">nouveau</div>
                                    <div class="col border border-secondary">en Cours</div>
                                    <div class="col bg-primary-subtle border border-primary">traité</div>
                                    <div class="col border border-secondary">fermé</div>
                                </div>
                        </div>


                     @else
                        <div class="container  text-center">
                                <div class="row  row-cols-auto border border-primary position-absolute top-0 end-0 bg-body-secondary">
                                    <div class="col border border-secondary">nouveau</div>
                                    <div class="col border border-secondary">en Cours</div>
                                    <div class="col border border-secondary">traité</div>
                                    <div class="col bg-primary-subtle border border-primary ">fermé</div>
                                </div>
                        </div>
                    @endif
</div>
                    <div class="card-body">
                        <p><strong>Description:</strong> {{  $ticket->description, 150 }}</p>
                        <p><strong>Assignee:</strong> {{ $ticket->leNomAssistant() }}</p>
                        <p><strong>Demandeur:</strong> {{ $Demandeur->firstName }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($ticket->date)->format('d M Y') }}</p>
                        <p><strong>Status:</strong> {{ $ticket->etat }}</p>
                    </div>

                </div>
            </div>
    </div>
</div>


<div class="container">
    <h1>etat</h1>
    @if ($ticket->etat == 'nouveau')
    <p>Etat Nouveau: {{ $barre_etat->date_nouveau }}</p>
    @elseif ($ticket->etat == 'enCours')
    <p>Etat Nouveau: {{ $barre_etat->date_nouveau }}</p>
    <p>Etat En cours : {{ $barre_etat->date_enCours }}</p>
    @elseif ($ticket->etat == 'traiter')
     <p>Etat Nouveau: {{ $barre_etat->date_nouveau }}</p>
    <p>Etat En cours : {{ $barre_etat->date_enCours }}</p>
    <p>Etat Traiter: {{ $barre_etat->date_traiter }}</p>
    @else
    <p>Etat Nouveau: {{ $barre_etat->date_nouveau }}</p>
    <p>Etat En cours : {{ $barre_etat->date_enCours }}</p>
    <p>Etat Traiter: {{ $barre_etat->date_traiter }}</p>
    <p>Etat Fermer: {{ $barre_etat->date_fermer }}</p>
    @endif
</div>





<div class="container">
    <div class="card-body">
            <h4>Messages:</h4>

            @foreach ($messages as $message)
                <div class="media mb-4">
                     <div class="media-body">
                        <h5 class="mt-0">{{ $message->emetteur }}</h5>
                        <p>{{ $message->messageEnvoyer }}</p>
                        <small class="text-muted">Date: {{ \Carbon\Carbon::parse($message->date)->format('d M Y H:i') }}</small>

                        @if ($message->piecesJointes)
                            <br>
                            <a href="{{ asset('storage/' . $message->piecesJointes) }}" class="btn btn-sm btn-info" target="_blank">View Attachment</a>
                        @endif
                    </div>
                </div>
            @endforeach
    </div>
</div>
<div class="container">
    <form action="{{ route('storeMessage',$ticket->id) }}" method="POST">

             @csrf

    <input type="text" name="messageEnvoyer">
    <input type="text" name="piecesJointes">
    <button type="submit">envoyer</button>
    </form>
</div>


</x-baselayout>
</x-app-layout>
