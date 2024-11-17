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

<div class="min-h-screen bg-[#1C1B21] text-white">
  <header class="relative">
    <img alt="Background image of a classic car" class="absolute inset-0 w-full h-full object-cover opacity-50" src="{{asset('images/bgmain.png')}}" />
    <div class="relative z-10 flex justify-around items-center p-6">
     <div class="flex items-center space-x-2">
      <span class="text-2xl font-bold">
       Форвард
      </span>
      <img src="{{asset("images/logo.png")}}" alt="">
      <span class="text-2xl font-bold text-purple-600">
       Авто
      </span>
     </div>
     <nav class="space-x-8">
      <a href="{{route('home')}}" class="text-lg hover:text-purple-400 text-white">Главная</a>
      <a href="{{route('catalog')}}" class=" text-lg hover:text-purple-400 text-white">Выбрать авто</a>

      @if (Auth::check())
      <a href="{{route('account')}}" class=" text-lg hover:text-purple-400 text-white">Личный кабинет</a>
      @if (Auth::user()->isAdmin())
      <div>
        <a href="{{route('admin')}}" class="text-lg hover:text-purple-400 text-white">Админ панель</a>
      </div>

      @elseif (Auth::user()->isManager())
      <div>
        <a href="{{route('manager.index')}}" class=" text-lg hover:text-purple-400 text-white">Менеджер панель</a>
      </div>
      @endif
      @else
      <a href="{{route('register')}}" class="text-lg hover:text-purple-400 text-white">Личный кабинет</a>
      @endif
      </a>
     </nav>
    </div>
    <div class="relative z-10 flex flex-col items-center justify-center h-screen text-center">
     <h1 class="text-6xl font-bold">
      Автосалон лучших машин города Иркутска
     </h1>
     <h2 class="text-5xl font-bold mt-4 text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">
      Мы ждем вас!
     </h2>
    </div>
   </header>

   <section class="relative z-10 py-12 bg-gradient-to-t to-transparent mb-10">
    <div class="container mx-auto px-6">
     <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-[#3C3C3C] rounded-lg overflow-hidden">
       <img alt="Economy segment car" class="w-full h-48 object-cover" height="300" src="{{asset('images/eco.png')}}" width="400"/>
       <div class="p-4 text-center">
        <h3 class="text-xl font-bold">
         Эконом сегмент
        </h3>
       </div>
      </div>
      <div class="bg-[#3C3C3C] rounded-lg overflow-hidden">
       <img alt="Premium segment car" class="w-full h-48 object-cover" height="300" src="{{asset('images/premium.png')}}" width="400"/>
       <div class="p-4 text-center">
        <h3 class="text-xl font-bold">
         Премиум сегмент
        </h3>
       </div>
      </div>
      <div class="bg-[#3C3C3C] rounded-lg overflow-hidden">
       <img alt="Business segment car" class="w-full h-48 object-cover" height="300" src="{{asset('images/buisness.png')}}" width="400"/>
       <div class="p-4 text-center">
        <h3 class="text-xl font-bold">
         Бизнес сегмент
        </h3>
       </div>
      </div>
     </div>
    </div>
   </section>

   <div class="flex flex-col items-center bg-[#1C1B21] mb-10">

   <!-- Hero Section -->
    <section class="text-center p-8 bg-[#1C1B21]">
      <h1 class="text-3xl md:text-5xl font-bold mb-2">Автосалон лучших машин города Иркутска</h1>
      <p class="text-xl md:text-2xl mt-2">Мы ждем вас!</p>
    </section>
  
    <div class="flex items-center space-x-8 bg-[#1C1B21]">
      <div class="relative">
       <img alt="Map showing the city of Irkutsk" class="rounded-full " src="{{asset('images/map.png')}}" />
      </div>
      <div>
       <h1 class="text-2xl font-bold mb-4">
        Найдем нужную вам машину в вашем городе
       </h1>
       <h2 class="text-lg mb-2">
        Актуальные предложения:
       </h2>
       <ul class="list-disc list-inside space-y-1">
        <li>
         <a class="hover:underline" href="#">
          BMW 320i 2020
         </a>
        </li>
        <li>
         Nissan GT-R 2018
        </li>
        <li>
         Toyota Camry 2016
        </li>
        <li>
         <a class=" hover:underline" href="#">
          Dodge RAM 2020
         </a>
        </li>
        <li>
         Toyota Tundra
        </li>
        <li>
         Toyota Yaris
        </li>
       </ul>
      </div>
     </div>
   </div>
  
 
  
    <section class="p-8 mb-10">
      <h2 class="text-2xl font-semibold text-center mb-6">Популярные предложения</h2>
      <div class="flex flex-wrap justify-center gap-6">
          @foreach ($popularCars as $car)
              <div class="bg-[#3C3C3C] rounded-lg overflow-hidden w-64">
                  <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" alt="Car Image" class="w-full h-40 object-cover">
                  <div class="p-4">
                      <a href="{{ route('cars.show', $car->id) }}" class="text-lg font-semibold">{{ $car->mark }} {{ $car->model }}</a>
                      <p class="text-sm mt-2">Год: {{ $car->year }}</p>
                      <p class="text-sm">Пробег: {{ $car->mileage }} км</p>
                      <p class="text-sm">Цена: {{ $car->price }} ₽</p>
                      <form action="{{ route('cars.show', $car->id) }}">
                          <button class="mt-4 px-4 py-2 w-full bg-purple-500 rounded hover:bg-purple-600">Подробнее</button>
                      </form>
                  </div>
              </div>
          @endforeach
      </div>
  </section>
  <div class="w-full flex justify-center">
    <div class="grid grid-cols-4 gap-4 p-4 mb-10 w-3/5">
      @foreach ($randomCars as $car)
          <div class="col-span-1 row-span-2">
              <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" alt="Car Image" class="rounded-lg w-full h-full object-cover">
          </div>
      @endforeach
      <div class="col-span-2 flex items-center justify-center bg-gray-700 rounded-lg p-4">
        <span class="text-white text-xl font-semibold">
         Фото наших авто
        </span>
       </div>
   </div>
     
  </div>

   <x-footer/>
  </div>
</body>
</html>