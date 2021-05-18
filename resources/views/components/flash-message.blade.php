@props(['color' => 'blue'])

<div {{ $attributes->merge(['class' => 'bg-'.$color.'-500'.' text-white fixed top-0 left-0 right-0 p-5']) }}>
    {{ $slot }}
</div>