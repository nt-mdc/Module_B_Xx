<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="passphrase" :value="__('passphrase')" />
            <x-text-input id="passphrase" class="block mt-1 w-full" type="text" name="passphrase" :value="old('passphrase')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('passphrase')" class="mt-2" />
        </div>

        

        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
