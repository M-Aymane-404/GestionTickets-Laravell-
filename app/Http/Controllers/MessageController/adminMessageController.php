<?php

namespace App\Http\Controllers\MessageController;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;



class adminMessageController extends Controller
{



      public function commenteStore(StoreCommentRequest $request,Ticket $ticket)
    {


          $messageData = array_merge($request->validated(), [
        'emetteur' => auth()->user()->lastName,
        'ticket_id' => $ticket->id,
    ]);

    $message = Message::create($messageData);

       return redirect()->route('ticketDetails.admin',  ['ticket' => $ticket->id]);
       //return redirect()->route('dashboard.client');
    }




}
