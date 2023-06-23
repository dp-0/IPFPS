@props(['id' => '', 'checked' => false])
<span class="form-row">
    <x-action-message class="ml-2" on="save-{{ $id }}">
        {{ __('Saved.') }}
    </x-action-message>
    <div class="custom-control custom-switch">
        <input type="checkbox" id="{{ $id }}" {{ $attributes }} {{ $checked ? 'checked' : '' }}
            class="custom-control-input">
        <label class="custom-control-label capitalize" for="{{ $id }}">{{ $slot }}</label>
    </div>
    <x-action-message class="ml-2" on="{{ $id }}">
        {{ __('Saved.') }}
    </x-action-message>
</span>
