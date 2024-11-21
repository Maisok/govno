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

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=9fbfa4df-7869-44a3-ae8e-0ebc49545ea9" type="text/javascript"></script>
<script>
    ymaps.ready(init);

    function init() {
        var myMap = new ymaps.Map('map', {
            center: [52.753994, 104.622093],
            zoom: 9, 
            controls: []
        });

        // Данные для геокодирования
        var address = "Иркутск Ленина 5А";
        var prod_name = ""; // Пример данных
        var image_url = "https://example.com/image.jpg"; // Пример данных
        var advert_id = 1; // Пример данных

        // URL изображения по умолчанию
        var defaultImageUrl = "https://example.com/default-image.jpg";

        // Функция для геокодирования и добавления метки на карту
        function geocodeAndAddToMap(address, prod_name, image_url, advert_id) {
            ymaps.geocode(address, {
                results: 1
            }).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0),
                    coords = firstGeoObject.geometry.getCoordinates(),
                    bounds = firstGeoObject.properties.get('boundedBy');

                // Проверяем, существует ли URL изображения
                var imageUrl = image_url ? image_url : defaultImageUrl;

                // Создаем метку с пользовательским контентом
                var placemark = new ymaps.Placemark(coords, {
                    
                    hintContent: prod_name // Пользовательский контент в подсказке
                }, {
                   
                });

                myMap.geoObjects.add(placemark);

                // Центрируем карту на последней добавленной метке
                myMap.setCenter(coords, 15, {
                    checkZoomRange: true
                });
            });
        }

        // Выполняем геокодирование и добавление метки для адреса
        geocodeAndAddToMap(address, prod_name, image_url, advert_id);
    }
</script>
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


   <div class="flex flex-col items-center bg-[#1C1B21] mb-10">

   <!-- Hero Section -->
    <section class="text-center p-8 bg-[#1C1B21]">
      <h1 class="text-3xl md:text-5xl font-bold mb-2">Автосалон лучших машин города Иркутска</h1>
      <p class="text-xl md:text-2xl mt-2">Мы ждем вас!</p>
    </section>
  
    <div class="flex items-center space-x-8 bg-[#1C1B21]">
      <div class="relative">
        <div id="map" class="w-[500px] h-[500px] mt-4 mb-12"></div>
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
        @foreach ($randomCars as $index => $car)
            @if ($index == 0)
                <div class="col-span-1 row-span-2">
                    <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" alt="Car Image" class="rounded-lg w-full h-full object-cover">
                </div>
            @elseif ($index == 1)
                <div class="col-span-1 row-span-1">
                    <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" alt="Car Image" class="rounded-lg w-full h-full object-cover">
                </div>
            @elseif ($index == 2)
                <div class="col-span-1 row-span-1">
                    <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" alt="Car Image" class="rounded-lg w-full h-full object-cover">
                </div>
            @elseif ($index == 3)
                <div class="col-span-1 row-span-2">
                    <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" alt="Car Image" class="rounded-lg w-full h-full object-cover">
                </div>
            @endif
        @endforeach
        <div class="col-span-2 row-span-1 flex items-center justify-center bg-gray-700 rounded-lg p-4">
            <span class="text-white text-xl font-semibold">
                Фото наших авто
            </span>
        </div>
    </div>
</div>
     
  </div>

   <x-footer/>
  </div>
</body>
</html>