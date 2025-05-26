<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-1 gap-4">
                    @foreach ($products as $prod)
                        <a href="{{ route('product.edit', ['gtin' => $prod['gtin']]) }}" class="cursor-pointer border rounded-lg p-4">
                            <h1 class="font-bold">{{ $prod['gtin'] }}</h1>
                            <ul>
                                <li>{{ $prod['translations'][0]['name'] }}</li>
                                <li class="line-clamp-2">{{ $prod['translations'][0]['description'] }}</li>
                                <li>{{ $prod['detail']['brand'] }} // {{ $prod['detail']['country'] }}</li>
                                <li>{{ $prod['weight']['gross'] }}{{ $prod['weight']['unit'] }} //
                                    {{ $prod['weight']['net'] }}{{ $prod['weight']['unit'] }}</li>
                            </ul>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
