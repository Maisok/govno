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
<body class="bg-[#2c264d] min-h-screen">
    <x-header/>
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="w-full max-w-sm mx-auto px-6">
            <h1 class="text-center text-3xl font-bold text-white mb-8">Редактировать профиль</h1>
        
            @if (session('success'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                  {{ session('success') }}
              </div>
            @endif
        
            <form method="POST" action="{{ route('update') }}" class="space-y-4">
                @csrf
        
                <!-- Поле для имени -->
                <div class="relative">
                    <input type="text" required autofocus id="name" name="name" placeholder="Имя пользователя" value="{{ old('name', $user->name) }}"
                           class="w-full px-4 py-3 bg-transparent border-2 border-white/50 text-white placeholder-white rounded-[20px_0_20px_0] focus:outline-none focus:border-purple-400">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Поле для email -->
                <div class="relative">
                    <input type="email" id="email" name="email" placeholder="Электронная почта" value="{{ old('email', $user->email) }}"
                           class="w-full px-4 py-3 bg-transparent border-2 border-white/50 text-white placeholder-white rounded-[20px_0_20px_0] focus:outline-none focus:border-purple-400">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Поле для пароля -->
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Новый пароль"
                           class="w-full px-4 py-3 bg-transparent border-2 border-white/50 text-white placeholder-white rounded-[20px_0_20px_0] focus:outline-none focus:border-purple-400">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Поле для подтверждения пароля -->
                <div class="relative">
                    <input id="password_confirmation" type="password" placeholder="Подтвердите новый пароль" name="password_confirmation"
                           class="w-full px-4 py-3 bg-transparent border-2 border-white/50 text-white placeholder-white rounded-[20px_0_20px_0] focus:outline-none focus:border-purple-400">
                </div>
        
                <!-- Кнопка обновления профиля -->
                <button type="submit"
                        class="w-full py-3 bg-black text-purple-300 font-bold text-lg rounded-[20px_0_20px_0] hover:bg-purple-800 hover:text-white transition">
                    Обновить профиль
                </button>
            </form>
        
            <!-- Логотип -->
            <div class="mt-10 flex justify-center">
              <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" alt="Logo" class="w-20 h-20"></a>
            </div>
          </div>
    </div>
 
</body>
</html>