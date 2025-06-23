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


class ClientController extends Controller
{



    public function index()
    {
        if (auth()->user() && auth()->user()->type === 'client'){
        $tickets = Ticket::where('demandeur', auth()->user()->email)->get();

        $client = auth()->user()->firstName;

        $Demandeur = User::where('email',auth()->user()->email)->first();

        return view('dashboard.client', compact('tickets', 'Demandeur','client'));}
    elseif (auth()->user() && auth()->user()->type === 'admin'){
        return redirect('admin/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }

    }
    public function ticketDetails(Ticket $ticket){
        if (auth()->user() && auth()->user()->type === 'client'){
        $Demandeur = User::where('email',auth()->user()->email)->first();
        $messages = Message::where('ticket_id',$ticket->id)->get();
        $barre_etat = BarreEtat::where('ticket_id',$ticket->id)->first();



        return view ('ticketDetails.client',compact('ticket','barre_etat','Demandeur','messages'));}
    elseif (auth()->user() && auth()->user()->type === 'admin'){
        return redirect('admin/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }
    }


    public function create(){
        if (auth()->user() && auth()->user()->type === 'client'){

    return view ('createTicket.client');
}
    elseif (auth()->user() && auth()->user()->type === 'admin'){
        return redirect('admin/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }
   }

   public function store(StoreTicketRequest $request){
    if (auth()->user() && auth()->user()->type === 'client'){
            $tickets = Ticket::whereNotNull('assignee')->get();
            $assistants = User::where('type','assistant')->get();
       // assistant avec le min nombre de ticket qui lui assigner

                $AssistantAvecMinTickets = null;;
                $nbticket= 0;
                $indiceDepremierAssistant = 0;
                $NbticketDAssistant;

              foreach($assistants as $assistant){
                  $nbticket = 0;
                            if($indiceDepremierAssistant == 0){
                                $AssistantAvecMinTickets = $assistant;
                                    foreach($tickets as $ticket){
                                                if($ticket->assignee == $assistant->email){
                                                    $nbticket++;

                                                }
                                            }
                                $NbticketDAssistant = $nbticket;


                                $indiceDepremierAssistant = 1;

                            }else{

                                foreach($tickets as $ticket){
                                    if($ticket->assignee == $assistant->email){
                                        $nbticket++;

                                    }
                                }


                                if($nbticket< $NbticketDAssistant){
                                    $AssistantAvecMinTickets = $assistant;
                                    $NbticketDAssistant = $nbticket;
                                }

                            }

              }

             $ticketData =  array_merge($request->validated(),[ 'demandeur' => auth()->user()->email,'assignee' =>$AssistantAvecMinTickets->email]);
             $ticket = Ticket::create($ticketData);
            $barre_etat = BarreEtat::create([
             'ticket_id' => $ticket->id,


             ]);

             return redirect()->route('dashboard.client');}
    elseif (auth()->user() && auth()->user()->type === 'admin'){
        return redirect('admin/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }


     }





}
