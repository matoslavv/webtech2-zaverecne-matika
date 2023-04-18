
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                {{ __('login') }}
            </x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                {{ __('register') }}
            </x-nav-link>
        </li>
        <li>
            <x-localization-select/>
        </li>
      </ul>
    </div>
  </div>
</nav>
