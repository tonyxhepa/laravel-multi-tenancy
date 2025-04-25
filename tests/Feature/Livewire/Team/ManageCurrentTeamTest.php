<?php

use App\Livewire\Team\ManageCurrentTeam;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ManageCurrentTeam::class)
        ->assertStatus(200);
});
