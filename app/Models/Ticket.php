<?php

namespace App\Models;
use App\Models\User;

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
}
