<section class="w-full">
    @include('partials.teams-heading')
    <x-teams.layout :heading="$currentTeamName" :subheading="__('Manage Current Team')">
       <section class="my-6 w-full space-y-6 bg-white dark:bg-neutral-900 rounded-lg p-6">
        <flux:heading>Swap Current Team</flux:heading>
            <flux:select wire:model.change="currentTeamId" placeholder="Choose team...">
                @foreach(Auth::user()->teams as $team)
                    <flux:select.option :value="$team->id">{{ $team->name }}</flux:select.option>
                @endforeach
            </flux:select>
        </section>
        @can('update', $currentTeam)
       <section class="my-6 w-full space-y-6 bg-white dark:bg-neutral-900 rounded-lg p-6">
            <flux:heading>Update Current Team</flux:heading>
            <form wire:submit="updateCurrentTeamName" class="my-6 w-full space-y-6">
                <flux:input wire:model="currentTeamName" :label="__('Name')" type="text" required autofocus autocomplete="name" />
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>
                <x-action-message class="me-3" on="current-team-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </section>
    @endcan
    </x-teams.layout>
</section>
