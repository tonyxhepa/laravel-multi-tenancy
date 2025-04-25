<?php

use App\Livewire\TeamSetting;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(TeamSetting::class)
        ->assertStatus(200);
});
