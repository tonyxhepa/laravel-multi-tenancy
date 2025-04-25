<section class="w-full">
    @include('partials.teams-heading')
    <x-teams.layout :heading="__('Manage Members')" :subheading="__('Add or remove members')">
        <section class="my-6 w-full space-y-6 bg-white dark:bg-neutral-900 rounded-lg p-6">
            <flux:heading>Invite New Member</flux:heading>
            <form wire:submit="inviteNewMember" class="my-6 w-full space-y-6">
                <flux:input wire:model="newMemberEmail" :label="__('Email')" type="email" required autofocus autocomplete="email" />
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-end">
                        <flux:button variant="primary" type="submit" class="w-full">{{ __('Invite') }}</flux:button>
                </div>
                <x-action-message class="me-3" on="current-team-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
       </section>
       <section class="my-6 w-full space-y-6 bg-white dark:bg-neutral-900 rounded-lg p-6">
        <flux:heading>All Members</flux:heading>
        <div class="space-y-6">
            @foreach($currentTeam->users as $member)
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div>
                            <p class="text-sm font-medium">{{ $member->name }}</p>
                            <p class="text-sm text-gray-500">{{ $member->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <flux:button variant="primary" wire:click="removeMember({{ $member->id }})" class="w-full">{{ __('Remove') }}</flux:button>
                    </div>
                </div>
            @endforeach
        </div>
        </section>
    </x-teams.layout>
</section>
