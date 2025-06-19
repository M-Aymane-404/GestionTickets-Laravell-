<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $fillable = ['messageEnvoyer', 'piecesJointes', 'ticket_id', 'emetteur', 'date'];
}
