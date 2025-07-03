<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/dashbord.css') }}">
     <title>Gestion de Tickets</title>




</head>
<body>

<div>
     @if (Route::has('login'))
    <div class=" mt-3 d-flex justify-content-end">
        @auth
            <a href="{{ url('client/dashboard') }}">dashbord</a>
        @else
        <a href="{{ route('login') }}">Connexion</a>
            @if (Route::has('register'))
        <a href="{{ route('register') }}">Inscription</a>
            @endif
        @endauth
    </div>
    @endif









    <div class="col-12   textAndImg row mt-4 justify-content-evenly p-0 m-0 " style="background-color: #e3f0d2">

        <div class=" title col-5 ">
             <h1>Gestion des Tickets</h1>
            <p class="text-center">
            Bienvenue sur votre plateforme de gestion d’assistance, conçue pour simplifier le suivi, le traitement et la résolution des demandes en quelques clics.
            </p>



            <div class="d-flex mt-4  justify-content-center">
            <a href="{{ route('register') }}"> commencer un essai</a>
            </div>


        </div>
        <div class=" img col-5 ">
            <img src="{{ asset('img/image.png') }}" class=" d-flex justify-content-center"     alt="" height="70%">
        </div>



    </div>
</div>

</body>
</html>
