@props(['photo'])
<div class="flex justify-content-center">
    <div class="image-preview relative w-48 h-48 rounded-full overflow-hidden bg-gray-800">
        <label for="photo-input" class="preview-label cursor-pointer flex justify-center items-center w-full h-full">
            <div class="relative">
                @if ($photo)
                    @if (gettype($photo) === 'string')
                        <img src="{{ $photo }}" alt="Image Preview" class=" w-48 h-48 object-cover rounded-full">
                    @else
                        <img src="{{ $photo->temporaryUrl() }}" alt="Image Preview"
                            class=" w-48 h-48 object-cover rounded-full">
                    @endif
                @endif
                <span class="overlay-text text-white text-lg mt-2 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">Select
                    Photo</span>
            </div>
        </label>
        <input type="file" id="photo-input" accept="image/*" {{ $attributes }} class="hidden">
    </div>
</div>
