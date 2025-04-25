<?php

use App\Livewire\Team\CreateNewTeam;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CreateNewTeam::class)
        ->assertStatus(200);
});
