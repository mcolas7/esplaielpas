<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{route('home')}}">
                <img class="mt-5 mb-0 pb-0" src="{{asset('/img/fliki2.png')}}"">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __("Has oblidat no contrasenya? Cap problema. Només has d'escriure el teu correu electrònic i t'enviarem un enllaç per restablir la teva contrasenya.") }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button style="background: #6730b0">
                    {{ __('Restablir contrasenya') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
