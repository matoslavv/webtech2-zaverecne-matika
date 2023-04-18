<x-dropdown trigger="{{strtoupper(app()->getLocale())}}">
    <x-slot name="content">
        @foreach (config('app.supported_locales') as $locale)
            <x-dropdown-link :href="route('change.locale', $locale)">
            {{strtoupper($locale)}}
            </x-dropdown-link>
        @endforeach
    </x-slot>
</x-dropdown>

