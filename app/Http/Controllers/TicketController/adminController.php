<?php
namespace App\Http\Controllers\TicketController;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Message;
use App\Models\BarreEtat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreTicketRequest;


class adminController extends Controller
{



public function index( Request $request){


$nomberAssistant = User::where('type','assistant')->count();
$nomberclient = User::where('type','client')->count();
$nomberTicket= Ticket::all()->count();

$search = $request->input('searchTerm');

$assistants = User::where([
                        ['lastName', 'LIKE', '%' . $search . '%'],
                        ['type','assistant']
                            ])->get();

$demandeurs = User::where([
                        ['lastName', 'LIKE', '%' . $search . '%'],
                        ['type','client']
                            ])->get();


        $tickets = Ticket::where('titre', 'LIKE',  '%' . $search . '%')
                         ->orWhere('demandeur', 'LIKE',  '%' . $search . '%')
                         ->orWhere('assignee', 'LIKE', '%' . $search . '%')
                         ->orWhere('etat', 'LIKE',  '%' . $search . '%');



 foreach ($assistants as $assistant) {
        $tickets->orWhere('assignee', 'LIKE', '%' . $assistant->email . '%');
    }
     foreach ($demandeurs as $demandeur) {
        $tickets->orWhere('demandeur', 'LIKE', '%' . $demandeur->email . '%');
    }
     $tickets = $tickets->paginate(10);
    return view ('dashboard.admin',compact('tickets','nomberTicket','nomberclient','nomberAssistant'));
}






  public function ticketDetails(Ticket $ticket){
         $messages = Message::where('ticket_id',$ticket->id)->get();
        $assistant = auth()->user()->lastName;
        $barre_etat = BarreEtat::where('ticket_id',$ticket->id)->first();



        return view ('ticketDetails.admin',compact('ticket','assistant','messages','barre_etat'));
    }



    public function updateEtat( Ticket $ticket){
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

        return  redirect()->route('ticketDetails.admin',$ticket);

    }


    public function editTicket(Ticket $ticket){



        return view ('editTicket.admin',compact('ticket' ));
    }

    public function updateTicket(StoreTicketRequest $request,Ticket $ticket){
        $ticket->update([[$request->validated()], 'etat' => $request->input('etat'),'assignee' => $request->input('assignee')]);

        return redirect()->route('ticketDetails.admin',$ticket);

    }



}
