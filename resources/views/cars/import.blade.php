<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{asset('images/logo.png')}}" type="image/x-icon">
  @vite('resources/css/app.css')
  <title>Forward Auto</title>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">
    <x-header class="w-full"/>
    <div class="flex-grow flex items-center justify-center">
        <div class="bg-gray-800 rounded-lg p-8 shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Импорт автомобилей</h1>
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('cars.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center">
                @csrf
                <div class="mb-4 w-full">
                    <label for="file" class="block text-sm font-medium text-gray-400 mb-2">Выберите файл для импорта:</label>
                    <input type="file" name="file" id="file" class="w-full p-2 bg-gray-700 text-white rounded-md border border-gray-600" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Импортировать</button>
            </form>
            <div class="mt-6 text-center">
                <a href="{{ route('cars.export') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Скачать все автомобили в Excel</a>
            </div>
        </div>
    </div>
    <x-footer class="w-full"/>
</body>
</html>