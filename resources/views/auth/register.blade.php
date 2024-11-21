<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{asset('images/logo.png')}}" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  @vite('resources/css/app.css')
  <title>Forward Auto</title>
</head>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const phoneInput = document.getElementById('phone_number');

      phoneInput.addEventListener('input', function (e) {
          let phoneNumber = e.target.value.replace(/\D/g, ''); // Удаляем все нецифровые символы
          if (phoneNumber.length > 0) {
              phoneNumber = '8 ' + phoneNumber.substring(1); // Добавляем префикс "8 "
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
          e.target.value = phoneNumber;
      });
  });
</script>
<body class="bg-[#2c264d] min-h-screen flex flex-col items-center justify-center">
  <div class="w-full max-w-sm mx-auto px-6">
    <h1 class="text-center text-3xl font-bold text-white mb-8">Регистрация</h1>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
      <div class="relative">
        <input type="text" required autofocus id="name" name="name" placeholder="Имя пользователя"
               class="w-full px-4 py-3 bg-transparent border-2 
               border-white/50 text-white placeholder-white 
               rounded-[20px_0_20px_0] focus:outline-none focus:border-purple-400">
      </div>

      @error('name')
      <span>{{ $message }}</span>
  @enderror

      <div class="relative">
        <input type="email" id="email" name="email" placeholder="Элекронная почта"
               class="w-full px-4 py-3 bg-transparent border-2 
               border-white/50 text-white placeholder-white rounded-[20px_0_20px_0] 
               focus:outline-none focus:border-purple-400">
      </div>

      @error('email')
      <span>{{ $message }}</span>
  @enderror


      <div class="relative">
        <input type="password" id="password" name="password" placeholder="Пароль"
               class="w-full px-4 py-3 bg-transparent border-2 border-white/50 
               text-white placeholder-white rounded-[20px_0_20px_0] focus:outline-none 
               focus:border-purple-400">
      </div>

      @error('password')
      <span>{{ $message }}</span>
  @enderror

  <div class="relative">
    <input id="password_confirmation" type="password" placeholder="Подтвердите пароль" 
    name="password_confirmation" required
    class="w-full px-4 py-3 bg-transparent border-2 border-white/50 
    text-white placeholder-white rounded-[20px_0_20px_0] focus:outline-none 
    focus:border-purple-400">
</div>



      <button type="submit"
              class="w-full py-3 bg-black text-purple-300 font-bold text-lg rounded-[20px_0_20px_0] hover:bg-purple-800 hover:text-white transition">
        Зарегистрироваться
      </button>
    </form>
    <p class="mt-4 text-center text-white/70 text-sm hover:text-purple-400 cursor-pointer">
      <a href="{{route('login')}}">Есть аккаунт?</a>
    </p>

    <div class="mt-10 flex justify-center">
      <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" alt="Logo" class="w-20 h-20"></a>
    </div>
  </div>
</body>
</html>