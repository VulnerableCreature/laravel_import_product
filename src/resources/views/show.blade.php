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

</div>
</body>
<section class="max-h-full">
    <div class="max-w-6xl px-4 mx-auto">
        <div class="flex flex-wrap mb-24 -mx-4">
            <div class="w-full px-4 mb-8 md:w-1/2 md:mb-0">
                <div class="sticky top-0 overflow-hidden ">
                    @forelse($photos as $photo)
                    <div class="relative mb-6 lg:mb-10 lg:h-96">
{{--                        <img class="object-contain w-full lg:h-full"--}}
{{--                             src="https://i.postimg.cc/0jwyVgqz/Microprocessor1-removebg-preview.png" alt="">--}}
                        <img class="object-contain w-full lg:h-full"
                             src="{{ url($photo->path) }}" alt="">
                    </div>
                        @empty
                    <p>Photo not found</p>
                    @endforelse
                </div>
            </div>
            <div class="w-full px-4 md:w-1/2">
                <div class="lg:pl-20">
                    <div class="mb-6 ">
                        <h2 class="max-w-xl mt-6 mb-6 text-xl font-semibold leading-loose tracking-wide text-gray-700 md:text-2xl dark:text-black">
                            {{ $product->name }}
                        </h2>
                        <p class="inline-block text-2xl font-semibold text-gray-700 dark:text-black">
                            <span>{{ $product->price }} рублей</span>
                        </p>
                    </div>
                    <div class="py-6 mb-6 border-t border-b border-gray-200 dark:border-gray-700">
                        <span class="text-2xl font-semibold text-black">Описание</span>
                        <p class="mt-2 text-md text-dark">{{ $product->description }}</p>
                    </div>
                    <div class="py-6 mb-6">
                        <span class="text-2xl font-semibold text-black">Характеристики</span>
                        @forelse($characteristics as $characteristic)
                            <p class="mt-2 text-md text-dark">{{ $characteristic->key }}, {{ $characteristic->value }}</p>
                            @empty
                            <p class="mt-2 text-md text-dark">Характеристики отсутствуют</p>
                        @endforelse
                    </div>
                </div>
                <div class="lg:pl-20">
                    <a href="{{ route('index') }}" class="p-4 bg-blue-500 text-white rounded-md">Вернуться к товарам</a>
                </div>
            </div>
        </div>
    </div>
</section>
</html>
