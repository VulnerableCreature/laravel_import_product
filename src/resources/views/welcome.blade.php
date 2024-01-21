<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Тестовое задание | Офис</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @vite('resources/css/app.css')
</head>

<body>
<div class="container mx-auto py-5">
    <header>
        <div class="max-w-full h-20 py-4 px-8 flex items-center justify-center gap-8">
            <a href="{{ route('import') }}"
               class="py-2 px-8 bg-red-400 rounded-md font-medium hover:bg-red-600 transition ease-linear">Импорт</a>
            <a href="#" class="py-2 px-8 bg-red-400 rounded-md font-medium hover:bg-red-600 transition ease-linear">Экспорт</a>
        </div>
    </header>
    @if(session('success'))
        <div
            class="mt-3 mb-3 bg-green-500 opacity-95 p-3 border border-green-900 text-opacity-0 text-center font-semibold rounded-lg">
            {{ session('success') }}
        </div>
        <div
            class="mt-3 mb-3 bg-yellow-500 opacity-95 p-3 border border-yellow-900 text-opacity-0 text-center font-semibold rounded-lg">
            {{ session('count') }}
        </div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse($products as $product)
            <div class="bg-white shadow-md rounded-md overflow-hidden">
                <img src="http://catalog.collant.ru/pics/SNL-504038_m.jpg" alt="Product 2"
                     class="w-full h-32 object-cover">
                <div class="p-8">
                    <h2 class="text-lg font-semibold mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-600">{{ $product->firstLetterDescription }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-xl font-bold text-gray-800">{{ $product->price }} руб.</span>
                        <a href="{{ route('product.show', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Перейти к
                            товару</a>
                    </div>
                </div>
            </div>
        @empty
            <div
                class="mt-3 mb-3 bg-red-500 opacity-95 p-3 border border-red-900 text-opacity-0 text-center font-semibold rounded-lg">
                Записи не найдены
            </div>
        @endforelse
    </div>
</div>
</body>

</html>
