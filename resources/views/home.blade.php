<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('company.create') }}" class="grid grid-cols-3 gap-2">
                    @csrf

                    <div>
                        <x-input-label for="company_name" :value="__('Company Name')" />
                        <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name"
                            :value="old('company_name')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="company_email" :value="__('company email')" />
                        <x-text-input id="company_email" class="block mt-1 w-full" type="email" name="company_email"
                            :value="old('company_email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('company_email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="company_phone" :value="__('company_telephone_number')" />
                        <x-text-input id="company_phone" class="block mt-1 w-full" type="text" name="company_phone"
                            :value="old('company_phone')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('company_phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="company_address" :value="__('company_address')" />
                        <x-text-input id="company_address" class="block mt-1 w-full" type="text"
                            name="company_address" :value="old('company_address')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('company_address')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="owner_name" :value="__('owner_name')" />
                        <x-text-input id="owner_name" class="block mt-1 w-full" type="text" name="owner_name"
                            :value="old('owner_name')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('owner_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="owner_email" :value="__('owner_email')" />
                        <x-text-input id="owner_email" class="block mt-1 w-full" type="email" name="owner_email"
                            :value="old('owner_email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('owner_email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="owner_number" :value="__('owner_mobile_number')" />
                        <x-text-input id="owner_number" class="block mt-1 w-full" type="text" name="owner_number"
                            :value="old('owner_number')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('owner_number')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="contact_name" :value="__('contact_name')" />
                        <x-text-input id="contact_name" class="block mt-1 w-full" type="text" name="contact_name"
                            :value="old('contact_name')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('contact_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="contact_email" :value="__('contact_email')" />
                        <x-text-input id="contact_email" class="block mt-1 w-full" type="email" name="contact_email"
                            :value="old('contact_email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="contact_number" :value="__('contact_mobile_number')" />
                        <x-text-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number"
                            :value="old('contact_number')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
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
                    @foreach ($companies as $company)
                        @if (!$company['deactived'])
                            <a href="{{ route('company.edit', ['id' => $company['id']]) }}" class="cursor-pointer border rounded-lg p-4">
                                <h1 class="font-bold">{{ $company['name'] }}</h1>
                                <ul>
                                    <li>Telephone Number: {{ $company['number'] }}</li>
                                    <li>Email: {{ $company['email'] }}</li>
                                    <li>Address: {{ $company['address'] }}</li>
                                    <li>Owner: {{ $company['owner']['name'] }}</li>
                                    <li>Contact: {{ $company['contact']['name'] }}</li>
                                </ul>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-xl font-bold p-6">Deactived</h1>
                <div class="p-6 text-gray-900 grid grid-cols-3 gap-4">
                    @foreach ($companies as $company)
                        @if ($company['deactived'])
                            <a href="{{ route('company.edit', ['id' => $company['id']]) }}" class="cursor-pointer border rounded-lg p-4">
                                <h1 class="font-bold">{{ $company['name'] }}</h1>
                                <ul>
                                    <li>Telephone Number: {{ $company['number'] }}</li>
                                    <li>Email: {{ $company['email'] }}</li>
                                    <li>Address: {{ $company['address'] }}</li>
                                    <li>Owner: {{ $company['owner']['name'] }}</li>
                                    <li>Contact: {{ $company['contact']['name'] }}</li>
                                </ul>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
