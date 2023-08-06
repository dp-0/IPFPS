<div x-data="{ showFilePond: true }" x-init="@this.on('evidence-added', () => { showFilePond = false; })">
    <template x-if="showFilePond">
        <div x-data x-init="FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.setOptions({
            chunkUploads: true,
            allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error => { console.log(error) }, progress)
                },
                revert: (filename, load, error) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                },
            },
        });
        const pond = FilePond.create($refs.input);
        window.addEventListener('evidence-added', event => {
            pond.removeFiles();
        })" wire:ignore>
            <input type="file" x-ref="input" data-max-file-size="10MB">
        </div>
    </template>
</div>

