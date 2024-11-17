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

<body>
    <x-header/>
    <div class="bg-gray-900 min-h-screen flex flex-col items-center p-4">

        <h1 class="text-white text-2xl font-bold mb-6">МОЙ ПРОФИЛЬ</h1>
      
        <div class="w-full max-w-5xl flex flex-col md:flex-row gap-8">
          <!-- Левый блок - информация о профиле -->
          <div class="bg-fiol text-white rounded-lg p-6 flex flex-col gap-6 md:w-1/3">
            <h2 class="text-center text-lg font-bold">{{ Auth::user()->username }}</h2>
            
            <div class="flex flex-col items-center">
              <p class="text-sm">Имя</p>
              <p class="text-lg border-2 border-white rounded-lg px-4 py-2 mt-1">{{ $user->name }}</p>
            </div>
      
            <div class="flex flex-col items-center">
              <p class="text-sm">Электронная почта</p>
              <p class="text-lg border-2 border-white rounded-lg px-4 py-2 mt-1">{{ $user->email }}</p>
            </div>

            <div class="flex flex-col items-center">
              <a href="{{ route('edit') }}" class="text-lg border-2 border-white rounded-lg px-4 py-2 mt-1">Редактировать данные</a>
            </div>

            <div class="flex flex-col items-center">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-lg border-2 border-white rounded-lg px-4 py-2 mt-1">Выход</button>
              </form>
            </div>
          </div>
      
          <!-- Правый блок - Бронирования -->
          <div class="flex flex-col md:w-2/3">
            <h2 class="text-white text-lg font-bold mb-4">Бронирования</h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-4">
              @foreach($bookings as $booking)
                <div class="flex flex-col items-center">

                  @if($booking->cars)
                    <img src="{{ asset('storage/' . $booking->cars->images->first()->image_path) }}" alt="{{ $booking->cars->mark }} {{ $booking->cars->model }}" class="w-full h-32 object-cover rounded-lg">
                    <p class="text-white mt-2 text-center text-sm">{{ $booking->cars->mark }} {{ $booking->cars->model }}</p>
                    <p class="text-white mt-2 text-center text-sm">С {{ $booking->start_date }} по {{ $booking->end_date }}</p>
                    <form method="POST" action="{{ route('bookings.cancel', $booking->id) }}" class="mt-2">
                        @csrf
                        @method('POST')
                        <button type="submit" class="text-red-500 hover:text-red-700">Отменить бронирование</button>
                    </form>
                  @else
                    <p class="text-white mt-2 text-center text-sm">Ошибка: данные о бронировании не найдены</p>
                  @endif
                </div>
              @endforeach
            </div>


            <!-- Бронирования на покупку -->
            <h2 class="text-white text-lg font-bold mb-4 mt-8">Бронирования на покупку</h2>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-4">
              @foreach($purchases as $purchase)
                <div class="flex flex-col items-center">
                  @if($purchase->cars)
                    <img src="{{ asset('storage/' . $purchase->cars->images->first()->image_path) }}" alt="{{ $purchase->cars->mark }} {{ $purchase->cars->model }}" class="w-full h-32 object-cover rounded-lg">
                    <p class="text-white mt-2 text-center text-sm">{{ $purchase->cars->mark }} {{ $purchase->cars->model }}</p>
                    <p class="text-white mt-2 text-center text-sm">Номер телефона: {{ $purchase->phone_number }}</p>
                    <form method="POST" action="{{ route('purchases.cancel', $purchase->id) }}" class="mt-2">
                        @csrf
                        @method('POST')
                        <button type="submit" class="text-red-500 hover:text-red-700">Отменить бронирование на покупку</button>
                    </form>
                  @else
                    <p class="text-white mt-2 text-center text-sm">Ошибка: данные о бронировании на покупку не найдены</p>
                  @endif
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    <x-footer/>
</body>
</html>