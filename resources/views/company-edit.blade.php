<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('company.update', ['id' => $company['id']]) }}"
                    class="grid grid-cols-3 gap-2">
                    @csrf

                    <div>
                        <x-input-label for="company_name" :value="__('Company Name')" />
                        <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name"
                            :value="old('company_name', $company['name'])" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="company_email" :value="__('company email')" />
                        <x-text-input id="company_email" class="block mt-1 w-full" type="email" name="company_email"
                            :value="old('company_email', $company['email'])" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('company_email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="company_phone" :value="__('company_telephone_number')" />
                        <x-text-input id="company_phone" class="block mt-1 w-full" type="text" name="company_phone"
                            :value="old('company_phone', $company['number'])" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('company_phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="company_address" :value="__('company_address')" />
                        <x-text-input id="company_address" class="block mt-1 w-full" type="text"
                            name="company_address" :value="old('company_address', $company['address'])" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('company_address')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="owner_name" :value="__('owner_name')" />
                        <x-text-input id="owner_name" class="block mt-1 w-full" type="text" name="owner_name"
                            :value="old('owner_name', $company['owner']['name'])" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('owner_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="owner_email" :value="__('owner_email')" />
                        <x-text-input id="owner_email" class="block mt-1 w-full" type="email" name="owner_email"
                            :value="old('owner_email', $company['owner']['email'])" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('owner_email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="owner_number" :value="__('owner_mobile_number')" />
                        <x-text-input id="owner_number" class="block mt-1 w-full" type="text" name="owner_number"
                            :value="old('owner_number', $company['owner']['number'])" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('owner_number')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="contact_name" :value="__('contact_name')" />
                        <x-text-input id="contact_name" class="block mt-1 w-full" type="text" name="contact_name"
                            :value="old('contact_name', $company['contact']['name'])" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('contact_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="contact_email" :value="__('contact_email')" />
                        <x-text-input id="contact_email" class="block mt-1 w-full" type="email" name="contact_email"
                            :value="old('contact_email', $company['contact']['email'])" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="contact_number" :value="__('contact_mobile_number')" />
                        <x-text-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number"
                            :value="old('contact_number', $company['contact']['number'])" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="deact"><input type="radio" value="1" name="deactiv" id="deact"
                                @if ($company['deactivated']) checked @endif> Deactivated</x-input-label>
                        <x-input-label for="act"><input type="radio" value="0" name="deactiv" id="act"
                                @if (!$company['deactivated']) checked @endif> Activated</x-input-label>
                    </div>

                    <div class="flex items-center justify-end mt-4">


                        <x-primary-button class="ms-3">
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-xl font-bold p-6">Actived</h1>
                <div class="p-6 text-gray-900 grid grid-cols-3 gap-4">
                    @foreach ($company['products'] as $prod)
                        @if (!$prod['hidden'])
                            <a href="{{ route('home') }}" class="cursor-pointer border rounded-lg p-4">
                                <h1 class="font-bold">{{ $prod['gtin'] }}</h1>
                                <ul>
                                    <li>{{ $prod['translations'][0]['name'] }}</li>
                                    <li class="line-clamp-2">{{ $prod['translations'][0]['description'] }}</li>
                                    <li>{{ $prod['detail']['brand'] }} // {{ $prod['detail']['country'] }}</li>
                                    <li>{{ $prod['weight']['gross'] }}{{ $prod['weight']['unit'] }} //
                                        {{ $prod['weight']['net'] }}{{ $prod['weight']['unit'] }}</li>
                                </ul>
                                <form method="POST" action="">
                                    @csrf
                                    <div class="flex items-center justify-end mt-4">

                                        <input type="hidden" name="hidden" value="1">

                                        <x-primary-button class="ms-3">
                                            {{ __('HIde') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-xl font-bold p-6">Deactived</h1>
                <div class="p-6 text-gray-900 grid grid-cols-3 gap-4">
                    @foreach ($company['products'] as $prod)
                        @if ($prod['hidden'])
                            <a href="{{ route('home') }}" class="cursor-pointer border rounded-lg p-4">
                                <h1 class="font-bold">{{ $prod['gtin'] }}</h1>
                                <ul>
                                    <li>{{ $prod['translations'][0]['name'] }}</li>
                                    <li class="line-clamp-2">{{ $prod['translations'][0]['description'] }}</li>
                                    <li>{{ $prod['detail']['brand'] }} // {{ $prod['detail']['country'] }}</li>
                                    <li>{{ $prod['weight']['gross'] }}{{ $prod['weight']['unit'] }} //
                                        {{ $prod['weight']['net'] }}{{ $prod['weight']['unit'] }}</li>
                                </ul>
                                <form method="POST" action="">
                                    @csrf
                                    <div class="flex items-center justify-end mt-4">

                                        <input type="hidden" name="hidden" value="0">

                                        <x-primary-button class="ms-3">
                                            {{ __('Show') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                                <form method="POST" action="">
                                    @csrf
                                    <div class="flex items-center justify-end mt-4">


                                        <x-danger-button class="ms-3">
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
