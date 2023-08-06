@props(['items', 'selectedItem', 'dataSelected','id'=>'user-dropdown'])

<div class="relative block w-full" id="{{$id}}">
    @if ($selectedItem)
        <div class="selected-item flex justify-between items-center items-base cursor-pointer p-2 border rounded h-10"
            wire:click="'reset' . $dataSelected">
            <span>
                <img id="{{ $dataSelected }}-image" src="{{ asset(($selectedItem['profile_photo_path'])?$selectedItem['profile_photo_path']:$selectedItem['profile_photo_url']) }}"
                    alt="{{ $selectedItem['name'] }}" class="w-8 h-8 rounded-full d-inline" loading="lazy">
                <span id="{{ $dataSelected }}-name" class="ml-2">{{ $selectedItem['name'] }}</span>
            </span>
            <span><i class="fa fa-angle-down fa-lg"></i></span>
        </div>
    @else
        <div class="selected-item flex justify-between items-center items-base cursor-pointer p-2 border rounded">
            <span id="{{ $dataSelected }}-name" class="mr-2">Select an Item</span>
            <span><i class="fa fa-angle-down fa-lg"></i></span>
        </div>
    @endif
    <div id="{{$id}}-dropdown-options"
        class="dropdown-options absolute w-full top-full left-0 h-80 hidden bg-white border rounded mt-1 shadow-md z-10 max-h-80 overflow-y-auto">
        <div class="search-box p-2">
            <input type="text" id="{{ $dataSelected }}-search-input" placeholder="Search Items"
                class="form-control w-full rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>
        @foreach ($items as $item)
            <div id="{{$id}}-option" class="option flex items-center cursor-pointer p-2 hover:bg-gray-100"
                wire:click="$set('{{ $dataSelected }}', {{ $item }})" {{ $attributes }}>
                <img src="{{ asset(($item->profile_photo_path)?:$item->profile_photo_url) }}" alt="Item" class="w-8 h-8 rounded-full mr-2" loading="lazy">
                <span class="option-name">{{ $item->name }}</span>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdown = document.querySelector('#{{$id}}');
            var selectedItemImage = document.getElementById('{{ $dataSelected }}-image');
            var selectedItemName = document.getElementById('{{ $dataSelected }}-name');
            var dropdownOptions = document.querySelector('#{{$id}}-dropdown-options');
            var searchInput = document.getElementById('{{ $dataSelected }}-search-input');

            dropdown.addEventListener('click', function() {
                dropdownOptions.classList.toggle('hidden');
                searchInput.focus();
            });

            var options = document.querySelectorAll('#{{$id}}-option');
            options.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.stopPropagation();

                    const itemName = this.querySelector('.option-name').innerText;
                    const itemImage = this.querySelector('img').src;

                    selectedItemName.innerText = itemName;
                    selectedItemImage.src = itemImage;

                    dropdownOptions.classList.add('hidden');
                });
            });

            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();

                options.forEach(option => {
                    const optionName = option.querySelector('.option-name').innerText.toLowerCase();

                    if (optionName.includes(query)) {
                        option.style.display = 'flex';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });
            document.addEventListener('click', function(e) {
                if (!dropdown.contains(e.target)) {
                    dropdownOptions.classList.add('hidden');
                }
            });
        });
    </script>
@endpush
