<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
    @foreach (config('app.supported_locales') as $locale)
        {{-- @if ($locale != App::getLocale()) --}}
            <a class="dropdown-item" href="{{ route('change.locale', $locale) }}"> {{$locale}}</a>
        {{-- @endif --}}
    @endforeach
</div>
