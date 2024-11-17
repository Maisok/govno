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
<body>
    <x-header/>
    <div class="bg-gray-900 min-h-screen py-10 px-4">
        <div class="container mx-auto mb-8">
            <form action="{{ route('catalog') }}" method="GET" class="flex flex-wrap justify-center items-end gap-4">
                <div class="flex flex-col">
                    <label for="search" class="text-white mb-2">Поиск по марке и модели:</label>
                    <input type="text" name="search" id="search" class="rounded-md p-2 bg-gray-800 text-white" value="{{ request('search') }}">
                </div>
                <div class="flex flex-col">
                    <label for="year_from" class="text-white mb-2">Год от:</label>
                    <input type="number" name="year_from" id="year_from" class="rounded-md p-2 bg-gray-800 text-white" value="{{ request('year_from') }}">
                </div>
                <div class="flex flex-col">
                    <label for="year_to" class="text-white mb-2">Год до:</label>
                    <input type="number" name="year_to" id="year_to" class="rounded-md p-2 bg-gray-800 text-white" value="{{ request('year_to') }}">
                </div>
                <div class="flex flex-col">
                    <label for="mileage_from" class="text-white mb-2">Пробег от:</label>
                    <input type="number" name="mileage_from" id="mileage_from" class="rounded-md p-2 bg-gray-800 text-white" value="{{ request('mileage_from') }}">
                </div>
                <div class="flex flex-col">
                    <label for="mileage_to" class="text-white mb-2">Пробег до:</label>
                    <input type="number" name="mileage_to" id="mileage_to" class="rounded-md p-2 bg-gray-800 text-white" value="{{ request('mileage_to') }}">
                </div>
                <button type="submit" class="bg-blue-500 text-white rounded-md p-2 hover:bg-blue-600">Применить фильтры</button>
            </form>
        </div>
        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($cars as $car)
                <div class="bg-gray-800 rounded-lg p-4 text-center">
                    <a href="{{ route('cars.show', $car->id) }}">
                        @if ($car->images->count() > 0)
                            <img class="w-full h-60 object-cover rounded-md mb-4" src="{{ asset('storage/' . $car->images->first()->image_path) }}" alt="{{ $car->mark }} {{ $car->model }}">
                        @else
                            <img class="w-full h-60 object-cover rounded-md mb-4" src="{{ asset('images/car.jpg') }}" alt="{{ $car->mark }} {{ $car->model }}">
                        @endif
                    </a>
                    <h3 class="text-white font-semibold">{{ $car->mark }} {{ $car->model }}</h3>
                    <p class="text-gray-400">{{ $car->price }} RUB</p>
                </div>
            @endforeach
        </div>
    </div>
    <x-footer/>
</body>
</html>