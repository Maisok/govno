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
        <h1 class="text-2xl font-bold mb-6">Редактировать модель автомобиля</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="mark" class="block text-gray-700 text-sm font-bold mb-2">Марка</label>
                <input id="mark" type="text" name="mark" value="{{ old('mark', $car->mark) }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('mark')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="model" class="block text-gray-700 text-sm font-bold mb-2">Модель</label>
                <input id="model" type="text" name="model" value="{{ old('model', $car->model) }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('model')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="year" class="block text-gray-700 text-sm font-bold mb-2">Год</label>
                <input id="year" type="number" name="year" value="{{ old('year', $car->year) }}" required min="1900" max="{{ date('Y') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('year')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="vin" class="block text-gray-700 text-sm font-bold mb-2">VIN</label>
                <input id="vin" type="text" name="vin" value="{{ old('vin', $car->vin) }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('vin')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="color" class="block text-gray-700 text-sm font-bold mb-2">Цвет</label>
                <input id="color" type="text" name="color" value="{{ old('color', $car->color) }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('color')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="mileage" class="block text-gray-700 text-sm font-bold mb-2">Пробег</label>
                <input id="mileage" type="number" name="mileage" value="{{ old('mileage', $car->mileage) }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('mileage')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Цена</label>
                <input id="price" type="number" name="price" value="{{ old('price', $car->price) }}" required step="0.01"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('price')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="availability" class="block text-gray-700 text-sm font-bold mb-2">Доступность</label>
                <select id="availability" name="availability" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="1" {{ old('availability', $car->availability) ? 'selected' : '' }}>Доступен</option>
                    <option value="0" {{ old('availability', $car->availability) ? '' : 'selected' }}>Не доступен</option>
                </select>
                @error('availability')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="body_type" class="block text-gray-700 text-sm font-bold mb-2">Тип кузова</label>
                <input id="body_type" type="text" name="body_type" value="{{ old('body_type', $car->body_type) }}" required maxlength="30"
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
                <input id="engine" type="text" name="engine" value="{{ old('engine', $car->engine) }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('engine')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tax" class="block text-gray-700 text-sm font-bold mb-2">Налог</label>
                <input id="tax" type="number" name="tax" value="{{ old('tax', $car->tax) }}" required step="0.01"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('tax')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="transmission" class="block text-gray-700 text-sm font-bold mb-2">Трансмиссия</label>
                <input id="transmission" type="text" name="transmission" value="{{ old('transmission', $car->transmission) }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('transmission')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="drive_type" class="block text-gray-700 text-sm font-bold mb-2">Тип привода</label>
                <input id="drive_type" type="text" name="drive_type" value="{{ old('drive_type', $car->drive_type) }}" required maxlength="30"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('drive_type')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="delivery_location" class="block text-gray-700 text-sm font-bold mb-2">Место доставки</label>
                <input id="delivery_location" type="text" name="delivery_location" value="{{ old('delivery_location', $car->delivery_location) }}" maxlength="30"
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
                    Обновить модель
                </button>
            </div>
        </form>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Текущие изображения</label>
            <div class="flex flex-wrap">
                @foreach ($car->images as $image)
                    <div class="relative mr-4 mb-4">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Car Image" class="w-32 h-32 object-cover">
                        <form action="{{ route('cars.deleteImage', ['car' => $car->id, 'image' => $image->id]) }}" method="POST" class="absolute top-0 right-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
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