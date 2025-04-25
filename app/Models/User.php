<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'user_team')->withPivot('is_manager');
    }

    public function isManagerOf(Team $team): bool
    {
        if (!$this->belongsToTeam($team)) {
            return false;
        }
        return $this->teams()->where('team_id', $team->id)->wherePivot('is_manager', true)->exists();
    }

    public function belongsToTeam(Team $team): bool
    {
        return $this->teams()->where('team_id', $team->id)->exists();
    }

    /**
     * Determine if the given team is the current team.
     *
     * @param  mixed  $team
     * @return bool
     */
    public function isCurrentTeam($team)
    {
        return $team->id === $this->currentTeam->id;
    }

    public function currentTeam()
{
    return $this->belongsTo(Team::class, 'current_team_id');
}

    public function switchTeam(Team $team): bool
    {
        // Optionally, validate that the user belongs to this team
        if (!$this->teams()->where('team_id', $team->id)->exists()) {
            throw new \Exception('User does not belong to the selected team.');
        }

        $this->forceFill([
            'current_team_id' => $team->id,
        ])->save();

        $this->setRelation('currentTeam', $team);

        return true;
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class, 'invited_by');
    }
}
