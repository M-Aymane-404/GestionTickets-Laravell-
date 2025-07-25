<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Ticket;
use App\Models\User;

use Livewire\WithPagination;

class AdminSearch extends Component
{
    use WithPagination;
        public $query ;
        public $tickets ;
        public $isFocused = false;

public function setFocus($focused)
{
    $this->isFocused = $focused;
}


    public function resetQuery(){

          $this->query = '';
                  $this->tickets = Ticket::all();

    }

public function updatedQuery($value)
{
    if (trim($value) === '') {
        $this->resetQuery();
    }
}


    public function mount()
    {
        $this->resetQuery();
    }

     public function searchByTitre()
    {
       $cleanQuery = trim($this->query);
      $this->tickets = Ticket::where('titre', 'LIKE', '%' . $cleanQuery . '%')->get();
    }


public function searchByAssistant()
{

     $cleanQuery = trim($this->query);
    $assistants = User::where('type', 'assistant')
        ->where(function ($query) use ($cleanQuery)  {
            $query->where('lastName', 'LIKE', '%' . $cleanQuery. '%')
                  ->orWhere('firstName', 'LIKE', '%' . $cleanQuery . '%');
        })
        ->get();

    $query = Ticket::query();

    foreach ($assistants as $assistant) {
        $query->orWhere('assignee', 'LIKE', '%' . $assistant->email . '%');
    }

     $query->orWhere('assignee', 'LIKE', '%' . $cleanQuery . '%');

    $this->tickets = $query->get();
}



 public function searchByDemandeur()
{
      $cleanQuery = trim($this->query);
    $demandeurs = User::where('type', 'client')
        ->where(function ($query) use ($cleanQuery)  {
            $query->where('lastName', 'LIKE', '%' .  $cleanQuery . '%')
                  ->orWhere('firstName', 'LIKE', '%' .  $cleanQuery . '%');
        })
        ->get();

    $query = Ticket::query();

    foreach ($demandeurs as $demandeur) {
        $query->orWhere('demandeur', 'LIKE', '%' . $demandeur->email . '%');
    }

     $query->orWhere('demandeur', 'LIKE', '%' .  $cleanQuery . '%');

    $this->tickets = $query->get();
}


   public function searchByStatus()
{
    $cleanQuery = str_replace(' ', '', $this->query); // removes all spaces

  $this->tickets = Ticket::where('etat', 'LIKE', '%' . $cleanQuery . '%')->get();
}

    public function render()
    {
        return view('livewire.admin-search');
    }
}

