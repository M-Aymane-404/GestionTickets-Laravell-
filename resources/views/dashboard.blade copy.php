<x-app-layout>
<x-baselayout>

    <div class="container">

    </div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">assistant</th>
                <th scope="col">nombre de ticket</th>
                <th scope="col">supprimer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assistants as $assistant)
                <tr>

                    <td>{{ $assistant->lastName }}</td>
                    <td>{{ $assistant->leNbTicketAssignee() }}</td>
                    <td>
                        <form action="{{ route('user.delete',$assistant) }}" method="POST">
                         @csrf

                        @method('DELETE')
                        <button type="submit">delete</button>
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<hr>

<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">client</th>
                <th scope="col">nombre de ticket</th>
                <th scope="col">supprimer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>

                    <td>{{ $client->lastName }}</td>
                    <td>{{ $client->leNbTicketdemander() }}</td>
                    <td><form action="{{ route('user.delete',$client) }}" method="POST">
                          @csrf

                        @method('DELETE')
                        <button type="submit">delete</button></form></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-baselayout>
</x-app-layout>
