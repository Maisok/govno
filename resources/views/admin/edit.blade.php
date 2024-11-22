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
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <x-header/>
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-6">Edit Manager</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="mb-6">
            @csrf
            @method('PUT')
            <div class="flex items-center space-x-4">
                <input type="text" name="name" value="{{ $user->name }}" placeholder="Name" class="border border-gray-300 p-2 rounded-md w-1/3">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <input type="email" name="email" value="{{ $user->email }}" placeholder="Email" class="border border-gray-300 p-2 rounded-md w-1/3">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <input type="password" name="password" placeholder="New Password (leave blank to keep current)" class="border border-gray-300 p-2 rounded-md w-1/3">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Update Manager</button>
            </div>
        </form>

        <a href="{{ route('admin') }}" class="text-blue-500 hover:underline">Back to Admin Panel</a>
    </div>
</body>
</html>