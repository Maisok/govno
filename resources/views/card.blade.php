<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{asset('images/logo.png')}}" type="image/x-icon">
  @vite('resources/css/app.css')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Forward Auto</title>
  <style>
    .carousel-item-centered {
    margin-right: 0% !important;
}
  </style>
</head>
<body class="min-h-screen bg-gray-900 text-white">
    <x-header/>
    <div class="container mx-auto">
        <div class="text-center text-2xl font-bold text-white mb-6">
            {{ $cars->mark }} {{ $cars->model }}
        </div>

        <div id="carCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner flex items-center justify-center">
                @foreach ($cars->images as $key => $image)
                    <div class="carousel-item w-full {{ $key == 0 ? 'active' : '' }} flex items-center justify-center carousel-item-centered">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $cars->mark }} {{ $cars->model }}" class="d-block w-[500px] object-cover rounded-lg mx-auto">
                    </div>
                @endforeach
                @if ($cars->images->isEmpty())
                    <div class="carousel-item active w-full flex items-center justify-center carousel-item-centered">
                        <img src="{{ asset('images/car.jpg') }}" alt="{{ $cars->mark }} {{ $cars->model }}" class="d-block w-100 h-48 object-cover rounded-lg mx-auto">
                    </div>
                @endif
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Specifications Section -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 text-center text-sm mb-8">
            <div>
                <p class="text-gray-400">Пробег</p>
                <p class="font-semibold">{{ $cars->mileage }} KM</p>
            </div>
            <div>
                <p class="text-gray-400">Год</p>
                <p class="font-semibold">{{ $cars->year }}</p>
            </div>
            <div>
                <p class="text-gray-400">Объем двигателя</p>
                <p class="font-semibold">{{ $cars->engine }}</p>
            </div>
            <div>
                <p class="text-gray-400">Мощность</p>
                <p class="font-semibold">{{ $cars->equipment }} л.с.</p>
            </div>
            <div>
                <p class="text-gray-400">Коробка</p>
                <p class="font-semibold">{{ $cars->transmission }}</p>
            </div>
            <div>
                <p class="text-gray-400">Привод</p>
                <p class="font-semibold">{{ $cars->drive_type }}</p>
            </div>
            <div>
                <p class="text-gray-400">Налог</p>
                <p class="font-semibold">{{ $cars->tax }} ₽ / год</p>
            </div>
            <div>
                <p class="text-gray-400">Место поставки</p>
                <p class="font-semibold">{{ $cars->delivery_location }}</p>
            </div>
        </div>

        <!-- Buttons Section -->
        <div class="flex justify-center gap-4">
            <form action="{{ route('book')}}" method="POST">
                @csrf
                <input type="hidden" name="car_id" value="{{ $cars->id }}">
                <input type="hidden" name="start_date" value="{{ now()->format('Y-m-d H:i:s') }}">
                <input type="hidden" name="end_date" value="{{ now()->addDays(7)->format('Y-m-d H:i:s') }}">
                <div class="mb-4">
                    <label for="phone_number" class="block text-gray-400 text-sm font-bold mb-2">Номер телефона</label>
                    <input id="phone_number" type="text" name="phone_number" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('phone_number')
                        <span class="text-red-500 text-xs italic">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="px-6 py-2 bg-purple-700 text-white rounded-md font-semibold hover:bg-purple-600">Забронировать</button>
            </form>

            <form action="{{ route('purchase')}}" method="POST">
                @csrf
                <input type="hidden" name="car_id" value="{{ $cars->id }}">
                <div class="mb-4">
                    <label for="phone_number_purchase" class="block text-gray-400 text-sm font-bold mb-2">Номер телефона</label>
                    <input id="phone_number_purchase" type="text" name="phone_number" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('phone_number')
                        <span class="text-red-500 text-xs italic">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="px-6 py-2 bg-green-700 text-white rounded-md font-semibold hover:bg-green-600">Забронировать на покупку</button>
            </form>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mt-4 text-center text-green-500">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const phoneInputs = document.querySelectorAll('input[name="phone_number"], input[name="phone_number_purchase"]');
    
            phoneInputs.forEach(input => {
                input.addEventListener('input', function () {
                    let phoneNumber = this.value.replace(/\D/g, ''); // Удаляем все нецифровые символы
                    if (phoneNumber.length > 0) {
                        phoneNumber = '8 ' + phoneNumber.substring(1); // Добавляем "8 " в начале
                    }
                    if (phoneNumber.length > 2) {
                        phoneNumber = phoneNumber.substring(0, 2) + ' ' + phoneNumber.substring(2);
                    }
                    if (phoneNumber.length > 6) {
                        phoneNumber = phoneNumber.substring(0, 6) + ' ' + phoneNumber.substring(6);
                    }
                    if (phoneNumber.length > 10) {
                        phoneNumber = phoneNumber.substring(0, 10) + ' ' + phoneNumber.substring(10);
                    }
                    if (phoneNumber.length > 13) {
                        phoneNumber = phoneNumber.substring(0, 13) + ' ' + phoneNumber.substring(13);
                    }
                    if (phoneNumber.length > 13) {
                        phoneNumber = phoneNumber.substring(0, 16);
                    }
                    this.value = phoneNumber;
                });
            });
        });
    </script>
</body>
</html>