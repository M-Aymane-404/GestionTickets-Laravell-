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
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{



public function index( Request $request){

 if (auth()->user() && auth()->user()->type === 'admin') {

$nomberAssistant = User::where('type','assistant')->count();
$nomberclient = User::where('type','client')->count();
$nomberTicket= Ticket::all()->count();

     return view ('dashboard.admin',compact('nomberTicket','nomberclient','nomberAssistant'));
    }
    elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }
}






  public function ticketDetails(Ticket $ticket){
    if (auth()->user() && auth()->user()->type === 'admin') {
         $messages = Message::where('ticket_id',$ticket->id)
         ->orderBy('created_at', 'desc')
         ->get();
        $assistant = auth()->user()->lastName;
        $barre_etat = BarreEtat::where('ticket_id',$ticket->id)->first();



        return view ('ticketDetails.admin',compact('ticket','assistant','messages','barre_etat'));
    }
    elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }
    }



    public function updateEtat( Ticket $ticket){
        if (auth()->user() && auth()->user()->type === 'admin') {
        $barre_etat = BarreEtat::Where('ticket_id',$ticket->id)->first();

            if($ticket->etat == 'nouveau'){
                $ticket->update(['etat' => 'enCours']);
                $barre_etat->update(['date_enCours' => now()]);
             } elseif($ticket->etat == 'enCours'){
                $ticket->update(['etat' => 'traiter']);
                $barre_etat->update(['date_traiter' => now()]);
             } elseif($ticket->etat == 'traiter'){
                $ticket->update(['etat' => 'fermer']);
                $barre_etat->update(['date_fermer' => now()]);
             }

        return  redirect()->route('ticketDetails.admin',$ticket);
         }
    elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }

    }


    public function editTicket(Ticket $ticket){


if (auth()->user() && auth()->user()->type === 'admin') {

        return view ('editTicket.admin',compact('ticket' ));
         }
    elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }
    }

    public function updateTicket(Request $request,Ticket $ticket){
        if (auth()->user() && auth()->user()->type === 'admin') {

         $piecesJointes = null;
    if ($request->hasFile('piecesJointes') && $request->file('piecesJointes')->isValid()) {
         $piecesJointes = $request->file('piecesJointes')->store('uploads', 'public');
    }
        $ticket->update([  'titre' => $request->input('titre'),'description' => $request->input('description'),'piecesJointes' => $request->input('piecesJointes'), 'etat' => $request->input('etat'),'assignee' => $request->input('assignee'), 'piecesJointes' => $piecesJointes,]);

        return redirect()->route('ticketDetails.admin',$ticket);
         }
    elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }

    }

    public function destroy(Ticket $ticket){
        if (auth()->user() && auth()->user()->type === 'admin') {
                 $messages = Message::where('ticket_id',$ticket->id);
                $barre_etat = BarreEtat::where('ticket_id',$ticket->id) ;
                $messages->delete();
                $barre_etat->delete() ;
                $ticket->delete();




        return redirect()->route('dashboard.admin' );

        }
    elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }
    }


    public function addUser(){

    if (auth()->user() && auth()->user()->type === 'admin') {

        return view ('adduser.admin ');
        }elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }
    }

    public function storeUser(StoreUserRequest $request){

        if (auth()->user() && auth()->user()->type === 'admin') {
        $user = User::create($request->validated());

        return  redirect()->route('listerUsers.admin');
        }elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }
    }









 public function addFirstAdmin(){
  $NbAdmin = User::where([

                        ['type','admin']
                            ])->count();

        return view ('adduser.FirstAdmin ',compact('NbAdmin'));

    }

    public function storeFirstAdmin(StoreUserRequest $request){
       $NbAdmin = User::where([

                        ['type','admin']
                            ])->count();
if($NbAdmin == 0){

    $user = User::create($request->validated());
}


        return  redirect()->route('welcome');

    }









        public function assistantTicket(){
            if (auth()->user() && auth()->user()->type === 'admin') {
        $assistants = User::where('type','assistant')->get();
                $clients = User::where('type','client')->get();

         return view('listerUsers.admin',compact('assistants','clients'));
         }elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }
        }



public function destroyUser(User $user)
{
    if (auth()->user() && auth()->user()->type === 'admin') {
     Ticket::where('assignee', $user->email)
          ->orWhere('demandeur', $user->email)
          ->delete();

     $user->delete();

    return redirect()->route('listerUsers.admin');
    }elseif (auth()->user() && auth()->user()->type === 'client'){
        return redirect('client/dashboard');
    }elseif (auth()->user() && auth()->user()->type === 'assistant'){
        return redirect('assistant/dashboard');
    }
}


public function statistcs() {
    $assistants = Ticket::whereNotNull('assignee')
        ->where('etat', 'fermer')
        ->pluck('assignee')
        ->unique();

    $stats = [];

    foreach ($assistants as $assignee) {
        $tickets = Ticket::where('assignee', $assignee)
            ->where('etat', 'fermer')
            ->get();

        $totalSeconds = 0;
        $count = 0;

        foreach ($tickets as $ticket) {
            $barre_etat = BarreEtat::where('ticket_id', $ticket->id)->first();

            if ($barre_etat && $barre_etat->date_fermer) {
                $start = Carbon::parse($barre_etat->created_at);
                $end = Carbon::parse($barre_etat->date_fermer);

                $duration = $start->diffInSeconds($end, false);

                // Ignorer les durées négatives ou excessives (> 7 jours)
                if ($duration >= 0 && $duration < 7 * 24 * 3600) {
                    $totalSeconds += $duration;
                    $count++;
                }
            }
        }

        // ✅ Ne divise que si au moins un ticket est comptabilisé
$avgMinutes = $count > 0 ? round($totalSeconds / $count / 60, 2) : 0;

      $stats[] = [
    'assistant' => $assignee,
    'avg_closing_time_minutes' => $avgMinutes
];
    }

    return view('statistic.admin', compact('stats'));
}

}
