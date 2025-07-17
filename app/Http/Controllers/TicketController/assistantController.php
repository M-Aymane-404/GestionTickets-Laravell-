<?php
namespace App\Http\Controllers\TicketController;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Message;
use App\Models\BarreEtat;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreTicketRequest;
use Carbon\Carbon;


class assistantController extends Controller
{



    public function index()
    {

        if (auth()->user() && auth()->user()->type === 'assistant'){
        $tickets = Ticket::where('assignee', auth()->user()->email)->get();


        $assistant = auth()->user()->firstName;





        return view('dashboard.assistant', compact('tickets','assistant')  );}
    elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'admin'){
        return redirect('admin/dashboard');
    }

    }


       public function ticketDetails(Ticket $ticket){
        if (auth()->user() && auth()->user()->type === 'assistant'){
         $messages = Message::where('ticket_id',$ticket->id)->get();
        $assistant = auth()->user()->lastName;
        $barre_etat = BarreEtat::where('ticket_id',$ticket->id)->first();



        return view ('ticketDetails.assistant',compact('ticket','assistant','messages','barre_etat'));}
    elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'admin'){
        return redirect('admin/dashboard');
    }
    }



    public function updateEtats( Ticket $ticket){
        if (auth()->user() && auth()->user()->type === 'assistant'){
        $barre_etat = BarreEtat::Where('ticket_id',$ticket->id)->first();

        if($ticket->etat == 'nouveau'){
         $ticket->update(['etat' => 'enCours']);
         $barre_etat->update(['date_enCours' => now()]);

        }elseif($ticket->etat == 'enCours'){
         $ticket->update(['etat' => 'traiter']) ;
          $barre_etat->update(['date_traiter' => now()]);
        }elseif($ticket->etat == 'traiter'){
            $ticket->update(['etat' => 'fermer']) ;
            $barre_etat->update(['date_fermer' => now()]);
        }

        return  redirect()->route('ticketDetails.assistant',$ticket);}
    elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'admin'){
        return redirect('admin/dashboard');
    }

    }


    public function statistic( Request $request ){
         $dateDebut = $request->input('datedebut');
         $dateFin = $request->input('datefin');



    $nbTicketsParEtat = Ticket::select('etat', DB::raw('count(*) as total'))
        ->where('assignee', auth()->user()->email)
        ->whereBetween('created_at', [$dateDebut, $dateFin])
        ->groupBy('etat')
        ->get();

       return view('statistic.assistant', compact('nbTicketsParEtat' )  );

    }











}
