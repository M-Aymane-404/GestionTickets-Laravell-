<?php
namespace App\Http\Controllers\TicketController;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreTicketRequest;


class ClientController extends Controller
{



    public function index()
    {
        $tickets = Ticket::where('demandeur', auth()->user()->email)->get();

        $client = auth()->user()->firstName;

        $Demandeur = User::where('email',auth()->user()->email)->first();

        return view('dashboard.client', compact('tickets', 'Demandeur','client'));

    }
    public function ticketDetails(Ticket $ticket){
        $Demandeur = User::where('email',auth()->user()->email)->first();
        $messages = Message::where('ticket_id',$ticket->id)->get();



        return view ('ticketDetails.client',compact('ticket','Demandeur','messages'));
    }


    public function create(){

    return view ('createTicket.client');
   }
   
   public function store(StoreTicketRequest $request){
             $ticketData =  array_merge($request->validated(),[ 'demandeur' => auth()->user()->email]);
             $ticket = Ticket::create($ticketData);
             return redirect()->route('dashboard.client');


     }





}
