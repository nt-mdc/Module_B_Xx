<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Product') }}
        </h2>
    </x-slot>



    <div class="py-12 max-w-7xl mx-auto">
        <form method="POST" action="{{ route('product.update.create') }}">
            @csrf
            <input type="hidden" name="hidden" value="0">
            <div>
                <x-input-label for="gtin" :value="__('gtin')" />
                <x-text-input id="gtin" class="block mt-1 w-full" type="text" name="gtin" :value="old('gtin')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('gtin')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="company_id" :value="__('company')" />
                <select name="company_id" id="company_id" class="w-full">
                    @foreach ($comp as $c)
                        <option value="{{ $c['id'] }}" @if (old('company_id') == $c['id']) selected @endif>
                            {{ $c['company_name'] }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="en_name" :value="__('en_name')" />
                <x-text-input id="en_name" class="block mt-1 w-full" type="text"
                    name="translations[en][name]" :value="old('translations.en.name')" required autofocus
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('translations.en.name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="en_description" :value="__('en_description')" />
                <textarea id="en_description" class="block mt-1 w-full" type="text"
                    name="translations[en][description]" required autofocus autocomplete="username" cols="30"
                    rows="2">{{ old('translations.en.description') }}</textarea>
                <x-input-error :messages="$errors->get('translations.en.description')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="fr_name" :value="__('fr_name')" />
                <x-text-input id="fr_name" class="block mt-1 w-full" type="text"
                    name="translations[fr][name]" :value="old('translations.fr.name')" required autofocus
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('translations.fr.name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="fr_description" :value="__('fr_description')" />
                <textarea id="fr_description" class="block mt-1 w-full" type="text"
                    name="translations[fr][description]" required autofocus autocomplete="username" cols="30"
                    rows="2">{{ old('translations.fr.description') }}</textarea>
                <x-input-error :messages="$errors->get('translations.fr.description')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="brand" :value="__('brand')" />
                <x-text-input id="brand" class="block mt-1 w-full" type="text" name="brand" :value="old('brand')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('brand')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="country" :value="__('country')" />
                <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('country')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="unit" :value="__('weight_unit')" />
                <x-text-input id="unit" class="block mt-1 w-full" type="text" name="unit" :value="old('unit')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('unit')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="net" :value="__('weight_net_content')" />
                <x-text-input id="net" class="block mt-1 w-full" type="text" name="net" :value="old('net')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('net')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="gross" :value="__('weight_gross(with_packing)')" />
                <x-text-input id="gross" class="block mt-1 w-full" type="text" name="gross" :value="old('gross')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('gross')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="image_path" :value="__('image')" />
                <x-text-input id="image_path" class="block mt-1 w-full" type="file" accept="image/*"
                    name="image_path" :value="old('image_path')" autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">


                <x-primary-button class="ms-3">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
