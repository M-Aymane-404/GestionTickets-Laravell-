<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin/addUser.css') }}">
     <title>Gestion de Tickets</title>




</head>
<body style="background-color: #f9fafb">




<div class=" col  container  mt-4  ">


    @if ($NbAdmin == 0)


      <form action="{{ route('storeFirstAdmin') }}" method="POST"  >
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
                <select class="form-control" id="type" name="type">
                     <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>



            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>
            <div class="col  d-flex justify-content-center">
            <!-- Submit -->
            <button type="submit" class="btnAdd col-7 ">Ajouter l'utilisateur</button>
            </div>
        </form>
        @else
        <div class=" d-flex align-items-center justify-content-center col-12">

            <h1 class="mt-5" >impossible de cree un admin vous avez deja un compte</h1>
        </div>
    @endif
</div>














<script> function toggleMobileBAr() {
      document.getElementById('navBarMobile').classList.toggle('collapsed');
    }</script>

</body>
</html>
