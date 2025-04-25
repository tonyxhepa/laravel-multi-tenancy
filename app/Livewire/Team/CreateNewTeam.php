<?php

namespace App\Livewire\Team;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateNewTeam extends Component
{
    public $newTeamName;

    public function createNewTeam()
    {
        Auth::user()->teams()->create([
            'name' => $this->newTeamName,
            'slug' => str($this->newTeamName)->slug(),
        ]);

        $this->dispatch('current-team-updated');
    }
    public function render()
    {
        return view('livewire.team.create-new-team');
    }
}
