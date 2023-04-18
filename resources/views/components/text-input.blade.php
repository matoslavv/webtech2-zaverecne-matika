@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} class="form-control" {!! $attributes->merge(['class' => 'form-control']) !!} >
