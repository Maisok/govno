
<header class="bg-gray-800 p-4 flex justify-between items-center">
    <div class="text-3xl font-bold text-purple-600">
      <img src="{{asset('images/logo.png')}}" alt="Logo" class="h-20">
    </div>
    <nav class="flex space-x-6 text-sm uppercase">
      <a href="{{route('home')}}" class="hover:text-purple-400 text-white">Главная</a>
      <a href="{{route('catalog')}}" class="hover:text-purple-400 text-white">Выбрать авто</a>

      @if (Auth::check())
      <a href="{{route('account')}}" class="hover:text-purple-400 text-white">Личный кабинет</a>
      @if (Auth::user()->isAdmin())
      <div>
        <a href="{{route('admin')}}" class="hover:text-purple-400 text-white">Админ панель</a>
      </div>

      @elseif (Auth::user()->isManager())
      <div>
        <a href="{{route('manager.index')}}" class="hover:text-purple-400 text-white">Менеджер панель</a>
      </div>
      @endif
      @else
      <a href="{{route('register')}}" class="hover:text-purple-400 text-white">Личный кабинет</a>
      @endif


      
    </nav>
  </header>