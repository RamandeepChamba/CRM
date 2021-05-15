@props(['name' => 'image', 'src' => null])

<x-label :for="$name">{{ ucfirst($name) }}</x-label>

<!-- Img container -->
<div id="img-preview-container" class="flex items-center h-80">
    <img src="{{ $src }}" 
        alt="image-preview"
        id="img-preview"
        class="object-contain w-full h-60">
</div>

<input type="file" name="{{ $name }}" id="logo">

@push('scripts')
    <script>
        const imgPreview = document.getElementById('img-preview');
        document.getElementById('logo').addEventListener('change', e => {
            const [file] = logo.files

            if(file) {
                let src = URL.createObjectURL(file)
                imgPreview.setAttribute('src', src)
            }
        })
    </script>
@endpush