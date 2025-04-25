<?php

use App\Livewire\Settings\Teams;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Teams::class)
        ->assertStatus(200);
});
