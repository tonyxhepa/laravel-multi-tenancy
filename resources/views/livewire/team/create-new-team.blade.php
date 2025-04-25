<section class="w-full">
    @include('partials.teams-heading')
    <x-teams.layout :heading="__('Create New Team')">
       <section class="my-6 w-full space-y-6 bg-white dark:bg-neutral-900 rounded-lg p-6">
        <form wire:submit="createNewTeam" class="my-6 w-full space-y-6">
            <flux:input wire:model="newTeamName" :label="__('Name')" type="text" required autofocus autocomplete="name" />
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Create') }}</flux:button>
                </div>
                <x-action-message class="me-3" on="current-team-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
       </section>
    </x-teams.layout>
</section>
