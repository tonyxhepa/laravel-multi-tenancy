<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($token)
    {
        $invitation = Invitation::where('token', $token)
        ->whereNull('accepted_at')
        ->firstOrFail();

        if (Auth::check()) {
            Auth::user()->teams()->attach($invitation->team_id, ['is_manager' => false]);
            $invitation->update([
                'accepted_at' => now()
            ]);
            Auth::user()->switchTeam($invitation->team);
            return redirect()->route('team.manage-current-team')->with('message', 'You have successfully joined the team');
        } else {
            return redirect()->route('login')->with('message', 'You need to login to accept the invitation');
        }
}
}
