 <x-app-layout>
<x-baselayout>
 <div class="container mt-4">
        <h2>Ajouter un utilisateur</h2>
        <form action="{{ route('storeUser.admin') }}" method="POST"  >
            @csrf

            <!-- First Name -->
            <div class="mb-3">
                <label for="firstName" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="{{ old('firstName') }}" required>
            </div>

            <!-- Last Name -->
            <div class="mb-3">
                <label for="lastName" class="form-label">Nom</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="{{ old('lastName') }}" required>
            </div>

            <!-- Phone Number -->
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Numéro de téléphone</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}" required>
            </div>

            <!-- Type (client, assistant, admin) -->
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type">
                    <option value="assistant" {{ old('type') == 'assistant' ? 'selected' : '' }}>Assistant</option>
                    <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <!-- Image -->
            <div class="mb-3">
                <label for="image" class="form-label">Image (facultatif)</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary">Ajouter l'utilisateur</button>
        </form>
    </div>
</x-baselayout>
    </x-app-layout>
