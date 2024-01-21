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
        <a href="{{ route('index') }}"
           class="py-2 px-8 bg-red-400 rounded-md font-medium hover:bg-red-600 transition ease-linear">Товары</a>
    </div>
</header>
<div class="container mx-auto py-5">
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 flex items-center gap-6">
            <input
                type="file"
                class="w-full min-w-0 flex-auto rounded border border-solid {{ $errors->has('import_file') ? 'border-red-300' : 'border-blue-300' }} px-3 py-[0.32rem] text-lg font-normal {{ $errors->has('import_file') ? 'text-red-700':'text-blue-700' }} file:-mx-3 file:-my-[0.32rem] file:border-0  file:px-3 file:py-[0.32rem] file:[margin-inline-end:0.75rem] {{ $errors->has('import_file') ? 'file:text-red-700' : 'file:text-blue-700' }} {{ $errors->has('import_file') ? 'file:bg-red-100' : 'file:bg-blue-100' }}" name="import_file"/>
            <input type="submit" value="Загрузить" class="py-2 px-5 bg-blue-300 rounded-md">
        </div>
        @error('import_file')
        <p class="text-red-700 font-semibold">{{ $message }}</p>
        @enderror
    </form>
</div>
</body>

</html>
