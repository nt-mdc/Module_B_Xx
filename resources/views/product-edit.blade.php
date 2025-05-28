<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('GTIN: ' . $prod['gtin']) }} - {{ $prod['hidden'] ? __("Deactivated") : __("Activated") }}
        </h2>
    </x-slot>



    <div class="py-12 max-w-7xl mx-auto">
        <form method="POST" enctype="multipart/form-data" action="{{ route('product.update.create', ['gtin' => $prod['gtin']]) }}">
            @csrf

            <div>
                <x-input-label for="gtin" :value="__('gtin')" />
                <x-text-input id="gtin" class="block mt-1 w-full" type="text" name="gtin" :value="old('gtin', $prod['gtin'])"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('gtin')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="company_id" :value="__('company_id')" />
                <select name="company_id" id="company_id" class="w-full">
                    @foreach ($comp as $c)
                        <option value="{{ $c['id'] }}" @if ($c['id'] == $prod['comapny_id']) selected @endif>
                            {{ $c['company_name'] }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
            </div>

            @foreach ($prod['translations'] as $trans)
                <div>
                    <x-input-label for="{{ $trans['language'] }}_name" :value="__($trans['language'] . '_name')" />
                    <x-text-input id="{{ $trans['language'] }}_name" class="block mt-1 w-full" type="text"
                        name="translations[{{ $trans['language'] }}][name]" :value="old('translations.' . $trans['language'] . '.name', $trans['name'])" required autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get($trans['language'] . '_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="{{ $trans['language'] }}_desc" :value="__($trans['language'] . '_descripton')" />
                    <textarea id="{{ $trans['language'] }}_desc" class="block mt-1 w-full" type="text"
                        name="translations[{{ $trans['language'] }}][description]" required autofocus autocomplete="username"
                        cols="30" rows="2">{{ old('translations.' . $trans['language'] . '.description', $trans['description']) }}</textarea>
                    <x-input-error :messages="$errors->get($trans['language'] . '_desc')" class="mt-2" />
                </div>
            @endforeach

            <div>
                <x-input-label for="brand" :value="__('brand')" />
                <x-text-input id="brand" class="block mt-1 w-full" type="text" name="brand" :value="old('brand', $prod['detail']['brand'])"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('brand')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="country" :value="__('country')" />
                <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country', $prod['detail']['country'])"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('country')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="unit" :value="__('weight_unit')" />
                <x-text-input id="unit" class="block mt-1 w-full" type="text" name="unit" :value="old('unit', $prod['weight']['unit'])"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('unit')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="net" :value="__('weight_net_content')" />
                <x-text-input id="net" class="block mt-1 w-full" type="text" name="net" :value="old('net', $prod['weight']['net'])"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('net')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="gross" :value="__('weight_gross(with_packing)')" />
                <x-text-input id="gross" class="block mt-1 w-full" type="text" name="gross" :value="old('gross', $prod['weight']['gross'])"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('gross')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="image_path" :value="__('image')" />
                <img class="max-w-xl" src="{{asset('storage/'.$prod['image']['image_path'])}}" alt="">
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
        <form method="POST" action="{{route('product.delete.image', ['gtin' => $prod['gtin']])}}">
            @csrf
            <div class="flex items-center justify-end mt-4">
                <x-danger-button class="ms-3">
                    {{ __('Remove Image') }}
                </x-danger-button>
            </div>
        </form>

        <form method="POST" action="{{ route('product.toggle', ['gtin' => $prod['gtin']]) }}">
            @csrf
            <div class="flex items-center justify-end mt-4">
                <input type="hidden" name="hidden" value="{{ $prod['hidden'] ? 0 : 1 }}">
                <x-primary-button class="ms-3">
                    {{ $prod['hidden'] ? __('Show') : __('Hide') }}
                </x-primary-button>
            </div>
        </form>

        @if ($prod['hidden'])
            <form method="POST" action="{{ route('product.delete', ['gtin' => $prod['gtin']]) }}">
                @csrf
                <div class="flex items-center justify-end mt-4">
                    <x-danger-button class="ms-3">
                        {{ __('Delete Product permanently') }}
                    </x-danger-button>
                </div>
            </form>
        @endif


    </div>
</x-app-layout>
