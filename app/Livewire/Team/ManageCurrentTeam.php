<?php

namespace App\Livewire\Team;

use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ManageCurrentTeam extends Component
{
    use AuthorizesRequests;
    #[Validate('required', 'string', 'max:255')]
    public $currentTeamName;
    public $currentTeamId;
    public $currentTeam;

    public function mount()
    {
        $this->currentTeamName = Auth::user()->currentTeam->name;
        $this->currentTeamId = Auth::user()->currentTeam->id;
        $this->currentTeam = Auth::user()->currentTeam;
    }

    public function switchTeam($teamId)
    {
        $team = Team::findOrFail($teamId);
        Auth::user()->switchTeam($team);
        $this->currentTeamName = Auth::user()->currentTeam->name;
        $this->currentTeamId = Auth::user()->currentTeam->id;
        $this->currentTeam = Auth::user()->currentTeam;
    }

    public function updatedCurrentTeamId($teamId)
    {
        $this->switchTeam($teamId);
    }

    public function updateCurrentTeamName()
    {
        $this->authorize('update', $this->currentTeam);
        Auth::user()->currentTeam->name = $this->currentTeamName;
        Auth::user()->currentTeam->save();
        $this->dispatch('current-team-updated');
    }

    public function render()
    {
        return view('livewire.team.manage-current-team');
    }
}
