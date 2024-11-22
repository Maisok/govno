<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{asset('images/logo.png')}}" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  @vite('resources/css/app.css')
  <title>Forward Auto</title>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <x-header/>
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-6">Добавить модель автомобиля</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('cars.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="mark" class="block text-gray-700 text-sm font-bold mb-2">Марка</label>
                <input id="mark" type="text" name="mark" value="{{ old('mark') }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('mark')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="model" class="block text-gray-700 text-sm font-bold mb-2">Модель</label>
                <input id="model" type="text" name="model" value="{{ old('model') }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('model')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="year" class="block text-gray-700 text-sm font-bold mb-2">Год</label>
                <input id="year" type="number" name="year" value="{{ old('year') }}" required min="1900" max="{{ date('Y') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('year')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="vin" class="block text-gray-700 text-sm font-bold mb-2">VIN</label>
                <input id="vin" type="text" name="vin" value="{{ old('vin') }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('vin')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="color" class="block text-gray-700 text-sm font-bold mb-2">Цвет</label>
                <input id="color" type="text" name="color" value="{{ old('color') }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('color')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="mileage" class="block text-gray-700 text-sm font-bold mb-2">Пробег</label>
                <input id="mileage" type="number" name="mileage" value="{{ old('mileage') }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('mileage')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Цена</label>
                <input id="price" type="number" name="price" value="{{ old('price') }}" required step="0.01"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('price')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="availability" class="block text-gray-700 text-sm font-bold mb-2">Доступность</label>
                <select id="availability" name="availability" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="1">Доступен</option>
                    <option value="0">Не доступен</option>
                </select>
                @error('availability')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="body_type" class="block text-gray-700 text-sm font-bold mb-2">Тип кузова</label>
                <input id="body_type" type="text" name="body_type" value="{{ old('body_type') }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('body_type')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="equipment" class="block text-gray-700 text-sm font-bold mb-2">Силы</label>
                <input id="equipment" type="text" name="equipment" value="{{ old('equipment') }}" required maxlength="4" pattern="\d*"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('equipment')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="engine" class="block text-gray-700 text-sm font-bold mb-2">Двигатель</label>
                <input id="engine" type="text" name="engine" value="{{ old('engine') }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('engine')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tax" class="block text-gray-700 text-sm font-bold mb-2">Налог</label>
                <input id="tax" type="number" name="tax" value="{{ old('tax') }}" required step="0.01"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('tax')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="transmission" class="block text-gray-700 text-sm font-bold mb-2">Трансмиссия</label>
                <input id="transmission" type="text" name="transmission" value="{{ old('transmission') }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('transmission')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="drive_type" class="block text-gray-700 text-sm font-bold mb-2">Тип привода</label>
                <input id="drive_type" type="text" name="drive_type" value="{{ old('drive_type') }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('drive_type')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="delivery_location" class="block text-gray-700 text-sm font-bold mb-2">Место доставки</label>
                <input id="delivery_location" type="text" name="delivery_location" value="{{ old('delivery_location') }}" maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('delivery_location')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="images" class="block text-gray-700 text-sm font-bold mb-2">Изображения</label>
                <input id="images" type="file" name="images[]" multiple
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('images.*')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Добавить модель
                </button>
            </div>
        </form>

        <h2 class="text-xl font-bold mb-4">Все модели автомобилей</h2>

        <form action="{{ route('cars.index') }}" method="GET" class="mb-4">
            <div class="flex items-center space-x-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Поиск по модели" class="border border-gray-300 p-2 rounded-md w-1/3">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Поиск</button>
            </div>
        </form>

        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'mark', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Марка</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'model', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Модель</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'year', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Год</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'vin', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">VIN</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'color', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Цвет</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'mileage', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Пробег</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'price', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Цена</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'availability', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Доступность</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'body_type', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Тип кузова</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'equipment', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Оборудование</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'engine', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Двигатель</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'tax', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Налог</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'transmission', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Трансмиссия</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'drive_type', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Тип привода</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                        <a href="{{ route('cars.index', ['sort' => 'delivery_location', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Место доставки</a>
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Действие</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($cars as $car)
                    <tr>
                        <td class="text-left py-3 px-4">{{ $car->mark }}</td>
                        <td class="text-left py-3 px-4">{{ $car->model }}</td>
                        <td class="text-left py-3 px-4">{{ $car->year }}</td>
                        <td class="text-left py-3 px-4">{{ $car->vin }}</td>
                        <td class="text-left py-3 px-4">{{ $car->color }}</td>
                        <td class="text-left py-3 px-4">{{ $car->mileage }}</td>
                        <td class="text-left py-3 px-4">{{ $car->price }}</td>
                        <td class="text-left py-3 px-4">{{ $car->availability ? 'Доступен' : 'Не доступен' }}</td>
                        <td class="text-left py-3 px-4">{{ $car->body_type }}</td>
                        <td class="text-left py-3 px-4">{{ $car->equipment }}</td>
                        <td class="text-left py-3 px-4">{{ $car->engine }}</td>
                        <td class="text-left py-3 px-4">{{ $car->tax }}</td>
                        <td class="text-left py-3 px-4">{{ $car->transmission }}</td>
                        <td class="text-left py-3 px-4">{{ $car->drive_type }}</td>
                        <td class="text-left py-3 px-4">{{ $car->delivery_location }}</td>
                        <td class="text-left py-3 px-4">
                            <a href="{{ route('cars.edit', $car->id) }}" class="text-blue-500 hover:text-blue-700">Редактировать</a>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить эту модель автомобиля?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const equipmentInput = document.getElementById('equipment');
        
            equipmentInput.addEventListener('input', function (e) {
                let value = e.target.value;
                if (value.length > 4) {
                    value = value.slice(0, 4);
                    e.target.value = value;
                }
                if (!/^\d*$/.test(value)) {
                    value = value.replace(/\D/g, '');
                    e.target.value = value;
                }
            });
        });
        </script>
</body>
</html>