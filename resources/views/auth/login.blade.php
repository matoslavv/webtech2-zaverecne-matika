<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login-wrapper">
        <form method="POST" action="{{ route('login') }}" class="login">
        <fieldset>
            <legend class="text-center">{{__('login')}}</legend>
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label :for="__('email')" :value="__('email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group mt-2">
                <x-input-label :for="__('password')" :value="__('password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    {{ __('remember_me') }}
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="w-100" type="submit">
                    {{ __('login') }}
                </x-button>
            </div>
            </fieldset>
        </form>
    </div>

</x-guest-layout>
