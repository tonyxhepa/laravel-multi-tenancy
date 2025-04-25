<?php

use App\Livewire\Team\Invitation;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Invitation::class)
        ->assertStatus(200);
});
