<?php

namespace App\Http\Controllers\MessageController;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;



class assistantMessageController extends Controller
{



      public function commenteStore(StoreCommentRequest $request,Ticket $ticket)
    {


          $piecesJointes = null;
    if ($request->hasFile('piecesJointes') && $request->file('piecesJointes')->isValid()) {
         $piecesJointes = $request->file('piecesJointes')->store('uploads', 'public');
    }

     $messageData = array_merge($request->validated(), [
        'emetteur' => auth()->user()->lastName,
        'ticket_id' => $ticket->id,
        'piecesJointes' => $piecesJointes,
    ]);

    $message = Message::create($messageData);

       return redirect()->route('ticketDetails.assistant',  ['ticket' => $ticket->id]);
       //return redirect()->route('dashboard.client');
    }




}
