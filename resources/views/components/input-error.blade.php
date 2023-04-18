@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => '']) }}>
        @foreach ((array) $messages as $message)
            <li>
                <div class="invalid-feedback">{{ $message }}</div>
            </li>
        @endforeach
    </ul>
@endif
