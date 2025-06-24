<x-app-layout>
<x-baselayout>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Submit Ticket</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('ticketStore') }}" method="POST"  enctype="multipart/form-data" >
                @csrf

                <!-- Title Field (titre) -->
                <div class="form-group">
                    <label for="titre">Title</label>
                    <input type="text" name="titre" id="titre" class="form-control " value="{{ old('titre') }}" required>

                </div>

                <!-- Description Field (description) -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control  " rows="4" required>{{ old('description') }}</textarea>

                </div>


                 <div class="form-group">
            <label for="piecesJointes">Upload File</label>
            <input type="file" name="piecesJointes" id="piecesJointes" class="form-control">
        </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>



</x-app-layout>
</x-baselayout>
