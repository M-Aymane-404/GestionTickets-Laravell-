<div>
    <div class="col-12 mt-4 d-flex justify-content-center">
        <input type="text"
               class="searchInput "
               placeholder="Search tickets..."
               wire:model="query"
               wire:keyup="set('query', $event.target.value)"
               wire:keydown.escape="resetQuery"
               wire:keydown.tab="resetQuery"
                      wire:focus="setFocus(true)"
       wire:blur="setFocus(false)"
        >


@if ($isFocused && !empty($query))


        <div class="col dropDown ">
            <a href="#" wire:click.prevent="searchByTitre">Recherche<strong class="ms-2 me-2">Titre</strong>pour : <span>{{ $query }}</span></a><br>
            <a href="#" wire:click.prevent="searchByAssistant">Recherche<strong class="ms-2 me-2">Assistant</strong>pour : <span>{{ $query }}</span></a><br>
            <a href="#" wire:click.prevent="searchByDemandeur">Recherche<strong class="ms-2 me-2">Demandeur</strong>pour : <span>{{ $query }}</span></a><br>
            <a href="#" wire:click.prevent="searchByStatus">Recherche<strong class="ms-2 me-2">Status</strong>pour : <span>{{ $query }}</span></a><br>
               </div>

@endif
    </div>


    <div class="col mt-4 table">
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Assistant</th>
                    <th>Demandeur</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr onclick="window.location='{{ route('ticketDetails.admin', $ticket) }}'" style="cursor: pointer;">
                        <td>{{ $ticket->titre }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($ticket->description, 90) }}</td>
                        <td>{{ $ticket->leNomAssistant() }}</td>
                        <td>{{ $ticket->leNomdemandeur() }}</td>
                        <td>{{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y') }}</td>
                        <td>
                            @if ($ticket->etat == 'nouveau')
                                <span class="status-nouveau me-2 ms-2"></span>{{ $ticket->etat }}
                            @elseif ($ticket->etat == 'enCours')
                                <span class="status-encours me-2 ms-2"></span>{{ $ticket->etat }}
                            @elseif ($ticket->etat == 'traiter')
                                <span class="status-traites me-2 ms-2"></span>{{ $ticket->etat }}
                            @else
                                <span class="status-ferme me-2 ms-2"></span>{{ $ticket->etat }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
 @if(!empty($suggestions))
        <ul class="list-group position-absolute w-100 z-3" style="max-height: 200px; overflow-y: auto;">
            @foreach($suggestions as $type => $exists)
                @if($exists)
                    <li class="list-group-item list-group-item-action"
                        wire:click="searchWithType('{{ $type }}')">
                        {{ ucfirst($type) }} : "{{ $query }}"
                    </li>
                @endif
            @endforeach
        </ul>
        @endif    </div>
</div>
