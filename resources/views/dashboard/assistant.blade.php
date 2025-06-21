<x-app-layout>
<x-baselayout>

    <div class="container">
    <h1>bienvenu {{ $assistant }}</h1>

    </div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>

                <th scope="col">Demandeur</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td> <a href="{{ route('ticketDetails.assistant',$ticket) }} ">{{ $ticket->titre }}</a></td>
                    <td>{{ \Illuminate\Support\Str::limit($ticket->description, 50) }}</td>
                     <td>{{ $ticket->leNomdemandeur()}}</td>

                    <td>{{ $ticket->date }}</td>
                    <td>{{ $ticket->etat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-baselayout>
</x-app-layout>
