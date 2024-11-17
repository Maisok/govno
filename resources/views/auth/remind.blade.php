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
<body class="bg-[#2c264d] min-h-screen flex flex-col items-center justify-center">
  <div class="w-full max-w-sm mx-auto px-6">
    <h1 class="text-center text-3xl font-bold text-white mb-8">Вход</h1>
    <form class="space-y-4">

      <div class="relative">
        <input type="text" placeholder="Имя пользователя"
               class="w-full px-4 py-3 bg-transparent border-2 border-white/50 text-white placeholder-white rounded-[20px_0_20px_0] focus:outline-none focus:border-purple-400">
      </div>

      <div class="relative">
        <input type="text" placeholder="Элекронная почта"
               class="w-full px-4 py-3 bg-transparent border-2 border-white/50 text-white placeholder-white rounded-[20px_0_20px_0] focus:outline-none focus:border-purple-400">
      </div>

      <div class="relative">
        <input type="password" placeholder="Пароль"
               class="w-full px-4 py-3 bg-transparent border-2 border-white/50 text-white placeholder-white rounded-[20px_0_20px_0] focus:outline-none focus:border-purple-400">
      </div>


      <button type="submit"
              class="w-full py-3 bg-black text-purple-300 font-bold text-lg rounded-[20px_0_20px_0] hover:bg-purple-800 hover:text-white transition">
        Зарегистрироваться
      </button>
    </form>


    <div class="mt-10 flex justify-center">
      <img src="{{asset('images/logo.png')}}" alt="Logo" class="w-20 h-20">
    </div>
  </div>
</body>
</html>