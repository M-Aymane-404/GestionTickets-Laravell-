<?php

namespace App\Models;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval; // Import Carbon class

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
   protected $table = 'ticket';
    protected $fillable = ['titre','description','demandeur','assignee','piecesJointes','etat','date'];


  public function leNomAssistant(){
        $email =  User::where('email', $this->assignee)->first();

        return $email ? $email->lastName : 'attender un assistant pour traiter votre demande';

    }
      public function leNomdemandeur(){
        $email =  User::where('email', $this->demandeur)->first();

        return $email ? $email->lastName : 'inconnue';

    }

     public function ledelaiDefermeture(){
         $ticket =  Ticket::where('id', $this->id)->first();
         $barre_etat = BarreEtat::where('ticket_id',$ticket->id)->first();


   if ($ticket->etat == 'fermer' && $barre_etat->date_fermer) {
    $dateCreation = Carbon::parse($barre_etat->created_at);
    $dateFermeture = Carbon::parse($barre_etat->date_fermer);

    $duree = $dateFermeture->diff($dateCreation);

     Carbon::setLocale('fr');

     $interval = CarbonInterval::createFromDateString($duree->format('%y years %m months %d days %h hours %i minutes %s seconds'));

     return $interval->forHumans(['parts' => 3, 'join' => true, 'short' => false]);
} else {
    return 'Le ticket n’est pas fermé';
}

    }


}
