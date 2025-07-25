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
      $this->tickets = Ticket::where('titre', 'LIKE', '%' . $this->query . '%')->get();
    }


public function searchByAssistant()
{
    $assistants = User::where('type', 'assistant')
        ->where(function ($query) {
            $query->where('lastName', 'LIKE', '%' . $this->query . '%')
                  ->orWhere('firstName', 'LIKE', '%' . $this->query . '%');
        })
        ->get();

    $query = Ticket::query();

    foreach ($assistants as $assistant) {
        $query->orWhere('assignee', 'LIKE', '%' . $assistant->email . '%');
    }

     $query->orWhere('assignee', 'LIKE', '%' . $this->query . '%');

    $this->tickets = $query->get();
}



 public function searchByDemandeur()
{
    $demandeurs = User::where('type', 'client')
        ->where(function ($query) {
            $query->where('lastName', 'LIKE', '%' . $this->query . '%')
                  ->orWhere('firstName', 'LIKE', '%' . $this->query . '%');
        })
        ->get();

    $query = Ticket::query();

    foreach ($demandeurs as $demandeur) {
        $query->orWhere('demandeur', 'LIKE', '%' . $demandeur->email . '%');
    }

     $query->orWhere('demandeur', 'LIKE', '%' . $this->query . '%');

    $this->tickets = $query->get();
}


      public function searchByStatus()
    {
      $this->tickets = Ticket::where('etat', 'LIKE',  '%' . $this->query . '%')->get();
    }

    public function render()
    {
        return view('livewire.admin-search');
    }
}

