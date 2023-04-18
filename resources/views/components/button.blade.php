@props([
    'type' => 'button',
    'size' => 'md',

    'variant' => 'primary',
    'variants' => [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'danger' => 'btn-danger',
        'warning' => 'btn-warning'
    ],
])

<button type="{{ $type }}" {{ $attributes->merge(['class' => "btn " . "{$variants[$variant]}" ]) }}">
    {{ $slot }}
</button>
