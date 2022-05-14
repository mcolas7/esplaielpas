@extends('layout')

@section('title', 'Iniciar Sessió')

@section('css')
    <link href="/css/style.css" rel="stylesheet">
@endsection
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img class="mt-5 mb-0" src="/img/fliki2.png">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="user_name" :value="__('DNI')" />

                <x-input id="user_name" class="block mt-1 w-full" type="text" name="user_name" :value="old('user_name')" required autofocus />
            </div>

            <!-- Email Address --> 
            {{-- <div>
                <x-label for="email" :value="__('email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div> --}}

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Contrasenya')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __("Recorda'm") }}</span>
                </label>
            </div>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Has oblidat la contrasenya?') }}
                    </a>
                @endif

                <x-button class="ml-3" style="background: #6730b0">
                    {{ __('Iniciar Sessió') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
