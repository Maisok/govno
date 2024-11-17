<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{asset('images/logo.png')}}" type="image/x-icon">
  @vite('resources/css/app.css')
  <title>Forward Auto - Manager</title>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">
    <x-header class="w-full"/>
    <div class="flex-grow flex items-center justify-center">
        <div class="bg-gray-800 rounded-lg p-8 shadow-lg w-full max-w-4xl">
            <h1 class="text-2xl font-bold mb-6 text-center">Управление автомобилями</h1>
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('manager.index') }}" method="GET" class="mb-6 flex items-center">
                <input type="text" name="search" placeholder="Поиск по марке и модели" class="p-2 bg-gray-700 text-white rounded-md border border-gray-600" value="{{ request('search') }}">
                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Поиск</button>
            </form>
            <form action="{{ route('sales.export') }}" method="GET" class="mb-6 flex items-center">
                <div class="flex flex-col">
                    <label for="start_date" class="text-white mb-2">Начальная дата:</label>
                    <input type="date" name="start_date" id="start_date" class="rounded-md p-2 bg-gray-800 text-white">
                </div>
                <div class="flex flex-col">
                    <label for="end_date" class="text-white mb-2">Конечная дата:</label>
                    <input type="date" name="end_date" id="end_date" class="rounded-md p-2 bg-gray-800 text-white">
                </div>
                <button type="submit" class="ml-2 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Скачать отчет</button>
            </form>
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th class="p-2">Марка</th>
                        <th class="p-2">Модель</th>
                        <th class="p-2">Год</th>
                        <th class="p-2">Цена</th>
                        <th class="p-2">Статус</th>
                        <th class="p-2">Продан</th>
                        <th class="p-2">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $car)
                        <tr>
                            <td class="p-2">{{ $car->mark }}</td>
                            <td class="p-2">{{ $car->model }}</td>
                            <td class="p-2">{{ $car->year }}</td>
                            <td class="p-2">{{ $car->price }} RUB</td>
                            <td class="p-2">
                                <form action="{{ route('manager.updateAvailability', $car->id) }}" method="POST" class="inline">
                                    @csrf
                                    <select name="availability" onchange="this.form.submit()" class="p-2 bg-gray-700 text-white rounded-md border border-gray-600" {{ $car->sold ? 'disabled' : '' }}>
                                        <option value="available" {{ $car->availability == 1 && !$car->sold ? 'selected' : '' }}>Доступен</option>
                                        <option value="unavailable" {{ $car->availability == 0 || $car->sold ? 'selected' : '' }}>Недоступен</option>
                                    </select>
                                </form>
                            </td>
                            <td class="p-2">
                                @if($car->sold)
                                    <span class="text-red-500">Продан</span>
                                @else
                                    <span class="text-green-500">Не продан</span>
                                @endif
                            </td>
                            <td class="p-2">
                                <a href="{{ route('cars.show', $car->id) }}" class="text-blue-500 hover:text-blue-700">Просмотр</a>
                                @if(!$car->sold)
                                <form action="{{ route('manager.markAsSold', $car->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="ml-2 text-red-500 hover:text-red-700">Продан</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-footer class="w-full"/>
</body>
</html>