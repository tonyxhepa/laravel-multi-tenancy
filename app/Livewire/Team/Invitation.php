<?php

namespace App\Livewire\Team;

use App\Mail\TeamInvitationMail;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Invitation as InvitationModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Invitation extends Component
{
    use AuthorizesRequests;
    public Team $currentTeam;
    public string $newMemberEmail;

    public function mount()
    {
        $this->currentTeam = Auth::user()->currentTeam;
    }

    public function inviteNewMember()
    {
        $this->validate([
            'newMemberEmail' => 'required|email',
        ]);
        if ($this->currentTeam->users()->where('email', $this->newMemberEmail)->exists()) {
            $this->dispatch('alert', type: 'error', message: __('User already exists in this team.'));
            return;
        }

        $invitation = InvitationModel::create([
            'team_id' => $this->currentTeam->id,
            'invited_by' => Auth::user()->id,
            'email' => $this->newMemberEmail,
            'token' => Str::random(40),
            'expires_at' => now()->addDays(7),
        ]);


        // Send email
        $url = URL::signedRoute('team.invitation.accept', [
            'token' => $invitation->token,
        ]);

        // Send email using your preferred method
         Mail::to($this->newMemberEmail)->send(new TeamInvitationMail($invitation,$url));

        session()->flash('message', 'Invitation sent successfully');
        $this->reset('newMemberEmail');
    }

    public function render()
    {
        return view('livewire.team.invitation');
    }
}
