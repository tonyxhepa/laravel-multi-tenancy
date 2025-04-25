<?php

use App\Livewire\Teams\SelectTeam;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(SelectTeam::class)
        ->assertStatus(200);
});
