@php
    $roles = array('Student', 'Teacher');
@endphp

<x-guest-layout>
    <div class="login-wrapper">
        <form method="POST" action="{{ route('register') }}" class="login">
        <fieldset>
            <legend class="text-center">{{__('register')}}</legend>
            @csrf

            <div class="form-group">
                <x-input-label for="name" :value="__('name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="form-group">
                <x-input-label for="surname" :value="__('surname')" />
                <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="surname" />
                <x-input-error :messages="$errors->get('surname')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="form-group">
                <x-input-label for="role" :value="__('role')" />
                <x-select id="role" name="role" :value="old('role')" required autocomplete="off">
                    <x-slot name="content">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" @selected(old('role') == $role)>
                                {{ __(strtolower($role)) }}
                            </option>
                        @endforeach
                    </x-slot>
                </x-select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group mt-2">
                <x-input-label for="password" :value="__('password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="form-group mt-2">
                <x-input-label for="password_confirmation" :value="__('confirm_password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>


            <div class="d-flex justify-center flex-column mt-4">
                <a class="text-center mb-2" href="{{ route('login') }}">
                    {{ __('already_registered?') }}
                </a>

                <x-button class="w-100" type="submit">
                    {{ __('register') }}
                </x-button>
            </div>
            </fieldset>
        </form>
    </div>
</x-guest-layout>
