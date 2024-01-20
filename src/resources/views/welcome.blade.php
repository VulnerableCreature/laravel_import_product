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
<header class="container mx-auto">
    <div class="max-w-full h-20 py-4 px-8 flex items-center justify-center gap-8">
        <a href="#" class="py-2 px-8 bg-red-400 rounded-md font-medium hover:bg-red-600 transition ease-linear">Импорт</a>
        <a href="#" class="py-2 px-8 bg-red-400 rounded-md font-medium hover:bg-red-600 transition ease-linear">Экспорт</a>
    </div>
</header>
<div class="container mx-auto py-5">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        <div class="bg-white shadow-md rounded-md overflow-hidden">
            <img src="http://catalog.collant.ru/pics/SNL-504038_m.jpg" alt="Product 2" class="w-full h-32 object-cover">
            <div class="p-8">
                <h2 class="text-lg font-semibold mb-2">Product 2</h2>
                <p class="text-gray-600">Description of Product 2. Lorem ipsum dolor sit amet, consectetur adipiscing
                    elit.</p>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-xl font-bold text-gray-800">$29.99</span>
                    <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-md">Перейти к товару</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
