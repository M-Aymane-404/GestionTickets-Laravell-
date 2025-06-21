<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class BarreEtat extends Model
{
   protected $table = 'barre_etat';
   protected $fillable = ['ticket_id','date_nouveau','date_enCours','date_traiter','date_fermer'];



}
