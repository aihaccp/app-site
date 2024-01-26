<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register-post') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
            <div class="mt-4">
                <x-input id="company_id" class="block mt-1 w-full" type="hidden" name="company_id" value="{{Auth::user()->id_company}}" required/>
            </div>

            <div class="mt-4">
                <x-input id="role_id" class="block mt-1 w-full" type="hidden" name="role_id" value="2" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4" style="display:block; margin-left: auto; color:#6C99D3; font-weight: bold">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-app-layout>
