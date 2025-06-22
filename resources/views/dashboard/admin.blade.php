<x-app-layout>
<x-baselayout>

   <div class="container text-center">
  <div class="row">
    <div class="col">
        <h1>nomber de Ticket: {{ $nomberTicket }}</h1>
    </div>
    <div class="col">
        <h1>nomberde client:{{ $nomberclient }}</h1>
    </div>
    <div class="col">
        <h1>nomber de Assistant :{{ $nomberAssistant }}</h1>
    </div>
  </div>
</div>

<div class="container">
    <div class="">
     <form action="{{ route('dashboard.admin') }}" method="GET">
        @csrf
            <input type="text" name="searchTerm" class="form-control" placeholder="shearch">
            <button type="submit">search</button>
        </form>
         <form action="{{ route('dashboard.admin') }}"  >

             <button type="submit">all ticket</button>
        </form>
    </div>
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
                    <td> <a href=" {{ route('ticketDetails.admin',$ticket) }} ">{{ $ticket->titre }}</a></td>
                    <td>{{ \Illuminate\Support\Str::limit($ticket->description, 50) }}</td>
                    <td>{{ $ticket->leNomAssistant()}}</td>
                    <td>{{  $ticket->leNomdemandeur() }}</td>
                    <td>{{ $ticket->date }}</td>
                    <td>{{ $ticket->etat }}</td>
                </tr>
            @endforeach
         </tbody>
            </table>
            {{ $tickets->links() }} <!-- Pagination links -->
        </div>
</div>

</x-baselayout>
</x-app-layout>
