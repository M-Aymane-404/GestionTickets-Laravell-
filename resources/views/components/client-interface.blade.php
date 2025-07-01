<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
     <title>Gestion de Tickets</title>


    <style>

     body {
      margin: 0;
      padding: 0;
      display: flex;
    }
     .ticket-header {
      display: flex;
      justify-content: space-between;
      background: #e9ecef;
      padding: 0.75rem 1.5rem;
      border-radius: 10px;
      font-weight: bold;
      font-size: 0.9rem;
      margin-bottom: 10px;
    }

    .ticket-row {
      background: white;
      border-radius: 10px;
      padding: 1rem 1.5rem;
      margin-bottom: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      transition: 0.2s ease;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .ticket-cell {
      flex: 1;
      min-width: 120px;
      padding: 0.25rem 0.75rem;
      font-size: 0.9rem;
    }

    .ticket-title {
      font-weight: bold;
      color: #0d6efd;
    }

    .ticket-status {
      font-size: 0.75rem;
    }

    .btn-view {
      white-space: nowrap;
    }

    @media (max-width: 768px) {
  .ticket-header,
  .ticket-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 0.5rem;
    padding: 1rem;
  }

  .ticket-cell {
    width: 100% !important;
    padding: 0.5rem;
    word-break: break-word;
    font-size: 0.85rem;
    flex: none;
  }

  .btn-view {
    width: 100%;
    margin-top: 0.5rem;
    text-align: center;
  }

  .ticket-title {
    font-size: 1rem;
  }
}


     .sidebar {
          background-color: #10323a;
      color: white;
      width: 200px;
      min-height: 100vh;
      transition: width 0.3s;
      overflow: hidden;
    }

    .sidebar.collapsed {
      width: 50px;
    }

    .sidebar .nav-link {
      display: flex;
      align-items: center;
      padding: 12px;
      color: white;
      text-decoration: none;
      white-space: nowrap;
    }

    .sidebar .nav-link:hover {
      background-color: #5fa8bb;
    }

    .sidebar i {
      font-size: 1.2rem;
      margin-right: 10px;
    }

    .sidebar.collapsed .nav-label {
      display: none;
    }

    .toggle-btn {
      position: absolute;
      bottom: 10px;
      left: 10px;
      background-color: #0b2f35;
      border: none;
      color: white;
      padding: 6px 10px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 0.9rem;
    }



    .nav-bar{
        height: 50px;

    }
  .statistic {
    width: 100%;
    margin-left: 0px;
    background-color: #e9ecef;
    padding: 2rem 1rem;
    border-radius: 8px;
  }

  .stat-box {
    background-color: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 1rem 0.75rem;
    text-align: center;
    transition: all 0.2s ease;
  }

  .stat-box:hover {
    background-color: #f8f9fa;
    transform: scale(1.03);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
  }

  .stat-title {
    font-size: 1.2rem;
    font-weight: bold;
    color: #0d6efd;
  }

  .stat-label {
    font-size: 0.9rem;
    color: #495057;
  }

  .stat-section-title {
    text-align: center;
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1rem;
    color: #343a40;
  }
    </style>

</head>
<body>

     <div class="sidebar" id="sidebar">
    <a href="#" class="nav-link"><i class="bi bi-journal-text"></i> <span class="nav-label">Tickets</span></a>
    <a href="#" class="nav-link"><i class="bi bi-house-door-fill"></i> <span class="nav-label">Home</span></a>
    <a href="#" class="nav-link"><i class="bi bi-person-fill"></i> <span class="nav-label">Profile</span></a>
    <a href="#" class="nav-link"><i class="bi bi-bar-chart-fill"></i> <span class="nav-label">Stats</span></a>
    <a href="#" class="nav-link"><i class="bi bi-gear-fill"></i> <span class="nav-label">Settings</span></a>
    <button class="toggle-btn" onclick="toggleSidebar()">⇄</button>
  </div>

<div class="content" id="content">
        <div class="nav-bar d-flex justify-content-between align-items-center   ">
           <h6></h6>
             <div class="m-3 ">
                <a href="{{ route('profile.edit') }}">
                <img src="https://i.pravatar.cc/30" class="rounded-circle" alt="user">
                 </a>
        </div>
</div>




<div class="statistic row justify-content-around">

  <!-- Bloc isolé : "nouveau" -->
  <div class="col-md-2 mb-3 d-flex align-items-center justify-content-center">
        <div class="row justify-content-center ">

        <div class="stat-section-title">Status de ticket</div>

    <div class="stat-box w-100">
      <div class="stat-title">22</div>
      <div class="stat-label">Nouveau</div>
    </div>
        </div>
  </div>

  <!-- Bloc Statut -->
  <div class="col-md-8">
    <div class="stat-section-title">Status de ticket</div>
    <div class="row justify-content-center g-3">
      <div class="col-3 col-md-2">
        <div class="stat-box">
          <div class="stat-title">22</div>
          <div class="stat-label">Nouveau</div>
        </div>
      </div>
      <div class="col-3 col-md-2">
        <div class="stat-box">
          <div class="stat-title">22</div>
          <div class="stat-label">En cours</div>
        </div>
      </div>
      <div class="col-3 col-md-2">
        <div class="stat-box">
          <div class="stat-title">22</div>
          <div class="stat-label">Traité</div>
        </div>
      </div>
      <div class="col-3 col-md-2">
        <div class="stat-box">
          <div class="stat-title">22</div>
          <div class="stat-label">Fermé</div>
        </div>
      </div>
    </div>
  </div>


    <div class="container py-4 bg-white">
                                <h4 class="mb-4">🎫 Tickets Dashboard</h4>

  <!-- Header -->
                                <div class="ticket-header">
                                    <div class="ticket-cell">Title</div>
                                    <div class="ticket-cell">Description</div>
                                    <div class="ticket-cell">Assignee</div>
                                    <div class="ticket-cell">Demandeur</div>
                                    <div class="ticket-cell">Date</div>
                                    <div class="ticket-cell">Status</div>
                                      <div class="ticket-cell">View</div>
                                </div>

  <!-- Ticket 1 -->
   @foreach ($tickets as $ticket)
                            <div class="ticket-row">
                                <div class="ticket-cell ticket-title">{{ $ticket->titre }}</div>
                                <div class="ticket-cell">{{ \Illuminate\Support\Str::limit($ticket->description, 50) }}</div>
                                <div class="ticket-cell">{{ $ticket->leNomAssistant()}}</div>
                                <div class="ticket-cell">{{ $Demandeur->firstName }}</div>
                                <div class="ticket-cell">{{ $ticket->date }}</div>
                                <div class="ticket-cell">
                                <span class="badge bg-warning text-dark ticket-status">{{ $ticket->etat }}</span>
                                </div>
                                 <div class="ticket-cell  ">
                                <button class="btn btn-outline-primary btn-sm btn-view">
                                    <i class="bi bi-eye"></i><a href="{{ route('ticketDetails.client',$ticket) }}">View</a>
                                </button>
                                </div>
                            </div>
 @endforeach

                </div>
    </div>






</div>



  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">

</script>
<script> function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('collapsed');
    }</script>

</body>
</html>
