<?php

use App\Http\Controllers\InvitationController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Teams;
use App\Livewire\Team\CreateNewTeam;
use App\Livewire\Team\Invitation;
use App\Livewire\Team\ManageCurrentTeam;
use App\Livewire\Team\UpdateCurrentTeam;
use App\Livewire\Teams\CreateTeam;
use App\Livewire\Teams\SelectTeam;
use App\Livewire\Teams\UpdateTeam;
use App\Livewire\TeamSetting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('team/manage-current-team', ManageCurrentTeam::class)->name('team.manage-current-team');
    Route::get('team/create-new-team', CreateNewTeam::class)->name('team.create-new-team');
    Route::get('team/invitation', Invitation::class)->name('team.invitation');
});

Route::get('invitations/accept/{token}', InvitationController::class)->middleware('signed')->name('team.invitation.accept');

require __DIR__.'/auth.php';
