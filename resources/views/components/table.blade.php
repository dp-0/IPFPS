<x-card>
    <x-slot:cardHeading>
        <span>{{ $heading }}</span>
        <span><input type="text" name="search" wire:model="search" id="search" class="form-control"></span>
    </x-slot:cardHeading>

    {{ $slot }}

    <x-slot:cardFooter>
        {{ $pagination }}
    </x-slot:cardFooter>
</x-card>
