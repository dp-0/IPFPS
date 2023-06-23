<x-card>
    <x-slot:cardHeading>
        <span>{{ $heading }}</span>
        <span class="form-row">
            <div class="col-9">
                <input type="text" name="search" wire:model="search" id="search" autocomplete="search"
                    class="form-control pr-1 @error('search') is-invalid @enderror" placeholder="search here...">
                @error('search')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-3">
                <select name="perPage" wire:model="perPage"
                    class="form-control @error('perPage')
                    is-invalid
                @enderror">
                    <option value="-1">All</option>
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                </select>
                @error('perPage')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </span>
    </x-slot:cardHeading>
    {{ $slot }}
    <x-slot:cardFooter>
        {{ $pagination }}
    </x-slot:cardFooter>
</x-card>
