<div class="col-12 mt-4 d-flex justify-content-center   ">
    <form action="{{ route('dashboard.admin') }}" method="GET">
       @csrf
          <input type="text" class="searchInput  " name="searchTerm" placeholder="Search tickets..."  aria-label="Search" >

      <button class=" searchBtn" type="submit">Search</button>
    </form>
</div>

<div class=" col mt-4 table">
    <table>
        <thead>
            <th>Title</th>
            <th>Description</th>
            <th>Assistant</th>
            <th>Demandeur</th>
            <th>Date</th>
            <th>Status</th>

        </thead>
        <tbody>
            @foreach ($tickets as $ticket )

            <tr   onclick="window.location='{{ route('ticketDetails.admin', $ticket) }}'" style="cursor: pointer;">

                <td>{{ $ticket->titre }}</td>
                <td>{{ \Illuminate\Support\Str::limit($ticket->description, 90) }}</td>
                <td>{{ $ticket->leNomAssistant()}}</td>
                <td>{{ $ticket->leNomdemandeur() }}</td>
                <td>{{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y') }}</td>
                @if ($ticket->etat == 'nouveau')
                <td class=""><span class="status-nouveau me-2 ms-2"></span>{{ $ticket->etat }}</td>
                @elseif ($ticket->etat == 'enCours')
                <td class=""><span class="status-encours me-2 ms-2"></span>{{ $ticket->etat }}</td>
                @elseif ($ticket->etat == 'traiter')
                <td class=""><span class="status-traites me-2 ms-2"></span>{{ $ticket->etat }}</td>
                @else
                <td class=""><span class="status-ferme me-2 ms-2"></span>{{ $ticket->etat }}</td>
                @endif

            </tr>
             @endforeach
        </tbody>




    </table>
</div>
