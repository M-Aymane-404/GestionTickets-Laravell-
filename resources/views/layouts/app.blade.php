<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Gestion de ticket</title>
         <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">


        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <style>

    </style>
    <body class="font-sans antialiased" >
        <div class="min-h-screen" style="     background-color: white;">
            <div class="col  d-flex align-items-center justify-content-end">
<div class="col-2  mt-4 d-flex align-items-center justify-content-start" style="height: 50px;">
  <a href="{{ route('dashboard.admin') }}" class="btn btn-dark ">tableau de bord</a>
</div>
</div>


            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

     </body>
</html>
