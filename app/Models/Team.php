<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_team')->withPivot('is_manager');
    }

    /**
     * Get all users designated as managers for this team.
     * Returns a Collection, as technically multiple users could have is_manager = true.
     */
    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_user')
                    ->wherePivot('is_manager', true)
                    ->withPivot('is_manager')
                    ->withTimestamps();
    }

    public function manager(): HasOne
    {
        return $this->belongsToMany(User::class, 'team_user')
                    ->wherePivot('is_manager', true)
                    ->withPivot('is_manager')
                    ->withTimestamps()
                    ->one();
    }

    public function removeUser(User $user)
    {
        if ($user->current_team_id === $this->id) {
            $user->forceFill([
                'current_team_id' => null,
            ])->save();
        }

        $this->users()->detach($user);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function deleteTeam()
    {
        // Detach all users and clear their current_team_id if set to this team
        $this->users()->where('current_team_id', $this->id)
        ->update(['current_team_id' => null]);
        $this->users()->detach();

        // Delete all invitations related to this team
        $this->invitations()->delete();

        // Optionally, delete other related models here (e.g., projects, files, etc.)

        // Delete the team itself
        $this->delete();
    }
}
