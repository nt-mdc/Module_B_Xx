<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('GTIN Bulk Verification') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <form method="POST" action="{{ route('gtin.bulk') }}">
                    @csrf

                    <div>
                        <x-input-label for="gtins" :value="__('GTINs')" />
                        <textarea id="gtins" class="block mt-1 w-full" type="text" name="gtins" required autofocus
                            autocomplete="username" cols="15" rows="10">{{ old('gtins') }}</textarea>
                        <x-input-error :messages="$errors->get('gtins')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-3">
                            {{ __('Verify') }}
                        </x-primary-button>
                    </div>
                </form>
                <div class="text-center">
                    <h1 class="font-semibold text-center text-xl mb-4">Verified GTINs</h1>
                    @if (isset($rst))
                        @if ($allValid)
                            <div class="flex justify-center flex-col items-center my-6">
                                <img src="{{ asset('green-tick.png') }}" alt="" class="w-10">
                                <h1 class="font-bold mt-2">All Valid</h1>
                            </div>
                        @endif
                        <div class="grid grid-cols-2">
                            <div>
                                @foreach ($rst as $r)
                                    <p>{{ $r['gtin'] }}</p>
                                @endforeach
                            </div>
                            <div>
                                @foreach ($rst as $r)
                                    <p>{{ $r['valid'] ? 'Valid' : 'Invalid' }}</p>
                                @endforeach
                            </div>
                        </div>

                    @endif

                </div>
            </div>
            <form method="POST" class="py-12 flex items-center justify-center" action="{{ route('gtin.bulk') }}">
                @csrf
                <x-input-label for="gtins" :value="__('View Product')" />
                <x-text-input id="gtin" class="block mt-1 w-full" type="text" name="gtin" :value="old('gtin')"
                    required autofocus autocomplete="username" placeholder='GTIN' />
                <x-input-error :messages="$errors->get('gtin')" class="mt-2" />
                <x-primary-button class="ms-3">
                    {{ __('View') }}
                </x-primary-button>
            </form>
        </div>

    </div>
</x-app-layout>
