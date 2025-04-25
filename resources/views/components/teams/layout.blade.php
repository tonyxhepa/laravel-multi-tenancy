<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <flux:navlist>
            <flux:navlist.item :href="route('team.manage-current-team')" wire:navigate>{{ __('Manage Current Team') }}</flux:navlist.item>
            <flux:navlist.item :href="route('team.create-new-team')" wire:navigate>{{ __('Create New Team') }}</flux:navlist.item>
            <flux:navlist.item :href="route('team.invitation')" wire:navigate>{{ __('Manage Invitations') }}</flux:navlist.item>
        </flux:navlist>
    </div>
    <flux:separator class="md:hidden" />
    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ $heading ?? '' }}</flux:heading>
        <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>
        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
