<div class="text-black">
    <x-card>
        <x-slot name="cardHeading">
            <span class="capitalize">Permissions for <span class="h4 text-success">{{ $roleName }}</span></span>
            <x-confirms-password wire:then="toggleAll" wire:loading.attr="disabled">
                <x-switch id="all" :checked="$rolePermissions->count() === count($permissions->flatten())" >All</x-switch>
            </x-confirms-password>
            
        </x-slot>
        @foreach ($permissions as $key => $value)
            <x-card>
                <x-slot name="cardHeading">
                    {{ $key }}
                    <x-switch id="{{ $key }}" wire:click="toggleModelPermission('{{$key}}')" :checked="!$rolePermissions->isEmpty() && $rolePermissions->intersect($value)->count() === count($permissions[$key])"> All From {{ $key }}</x-switch>
                </x-slot>
                <div class="row">
                    @foreach ($value as $permission)
                        <div class="col-3">
                            <x-switch wire:click="togglePermission('{{$permission}}')"  :checked="$rolePermissions->contains($permission)" id="{{ $permission }}"> {{ $permission }}
                            </x-switch>
                        </div>
                    @endforeach
                </div>
                <x-slot name="cardFooter"></x-slot>
            </x-card>
            <br>
        @endforeach
        <x-slot name="cardFooter"></x-slot>
    </x-card>
</div>
