<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-xl font-bold p-6">Actived</h1>
                <div class="p-6 text-gray-900 grid grid-cols-3 gap-4">
                    @foreach ($products as $prod)
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
                    @foreach ($products as $prod)
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
