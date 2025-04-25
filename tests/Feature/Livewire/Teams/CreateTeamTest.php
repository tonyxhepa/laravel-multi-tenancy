<?php

use App\Livewire\Teams\CreateTeam;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CreateTeam::class)
        ->assertStatus(200);
});
