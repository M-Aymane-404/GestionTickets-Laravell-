<x-app-layout>
<x-baselayout>

    <div class="container">
    <h1>bienvenu {{ $client }}</h1>
    <a href="{{ route('createTicket.client') }}">cree un ticket</a>

    </div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Assignee</th>
                <th scope="col">Demandeur</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td> <a href="{{ route('ticketDetails.client',$ticket) }}">{{ $ticket->titre }}</a></td>
                    <td>{{ \Illuminate\Support\Str::limit($ticket->description, 50) }}</td>
                    <td>{{ $ticket->leNomAssistant()}}</td>
                    <td>{{ $Demandeur->firstName }}</td>
                    <td>{{ $ticket->date }}</td>
                    <td>{{ $ticket->etat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-baselayout>
</x-app-layout>
