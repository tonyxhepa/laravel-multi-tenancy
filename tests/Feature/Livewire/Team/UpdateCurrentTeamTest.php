<?php

use App\Livewire\Team\UpdateCurrentTeam;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(UpdateCurrentTeam::class)
        ->assertStatus(200);
});
