<div class="text-black">
    <x-card>
        <x-slot name="cardHeading">
            <span class="capitalize">Permissions for <span class="h4 text-success">{{ $roleName }}</span></span>
            @if (!($userPermissions->count() != count($permissions->flatten())))
                <x-confirms-password wire:then="toggleAll" wire:loading.attr="disabled">
                    <x-switch id="all" :checked="$rolePermissions->count() === count($permissions->flatten())">All</x-switch>
                </x-confirms-password>
            @endif
        </x-slot>
        @foreach ($permissions as $key => $value)
            <x-card>
                <x-slot name="cardHeading">
                    {{ $key }}
                    @if (!count(collect($permissions[$key])->diff($userPermissions->pluck('name', 'id')->toArray())))
                        <x-switch id="{{ $key }}" wire:click="toggleModelPermission('{{ $key }}')"
                            :checked="!$rolePermissions->isEmpty() &&
                                $rolePermissions->intersect($value)->count() === count($permissions[$key])"> All From {{ $key }}
                        </x-switch>
                    @endif
                </x-slot>
                <div class="row">
                    @foreach ($value as $permission)
                        <div class="col-3">
                            <x-switch :disabled="count($rolePermissions->where('name',$permission))" wire:click="togglePermission('{{ $permission }}')" :checked="$rolePermissions->contains($permission)"
                                id="{{ $permission }}"> {{ $permission }}
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
