@props([
    'title',
    'submitted',
    'link'
])

@php
    $classes = $submitted ? 'border-success' : 'border-danger';
    $classesBadge = $submitted ? 'bg-success' : 'bg-danger';
    $textBadge = $submitted ? __('submitted') : __('progress');
@endphp

<div {{ $attributes->merge(['class' => "problem-card col-12 $classes" ]) }}>
    {{-- Problem ID --}}
    <div class="">
        <h5 class="problem-card-title">{{$title}}</h5>
        <span class="badge d-inline-block {{ $classesBadge }}">{{$textBadge}}</span>
    </div>

    {{-- {{ $slot }} --}}
    <div class="actions d-flex justify-content-end mt-2">
        <x-button class="p-0">
            <x-nav-link :href="route('dashboard')" class="px-3 py-2">
            {{__("view")}}
            </x-nav-link>
        </x-button>
    </div>
</div>
