<?php

use App\Livewire\Teams\UpdateTeam;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(UpdateTeam::class)
        ->assertStatus(200);
});
