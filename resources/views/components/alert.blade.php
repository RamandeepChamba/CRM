@props(['color' => 'blue'])

<div {{ $attributes->merge(['class' => 'text-'.$color.'-400']) }}>
    {{ $slot }}
</div>