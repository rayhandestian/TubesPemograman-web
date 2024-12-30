<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - KiQualls</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-sky-200">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <!-- Clouds Container -->
        <div class="fixed w-full h-full pointer-events-none">
          <img src="{{ asset('img/clouds1.png') }}" alt="Cloud 1" class="cloud-float absolute w-32 opacity-100 top-10 left-0">
          <img src="{{ asset('img/clouds1.png') }}" alt="Cloud 2" class="cloud-float-slow absolute w-40 opacity-100 top-40 right-1/2">
          <img src="{{ asset('img/clouds1.png') }}" alt="Cloud 3" class="cloud-float-slow absolute w-36 opacity-100 top-80 left-1/4">
          <img src="{{ asset('img/clouds1.png') }}" alt="Sun" class="absolute w-40 opacity-100 top-100 right-0">
          <img src="{{ asset('img/matahari.png') }}" alt="Sun" class="absolute w-20 opacity-100 top-100 right-0">
        </div>
    </div>
    <nav class="bg-blue-200 p-4">
        <div class="container mx-auto flex items-center">
            <div class="flex items-center">
                <img src="{{ asset('img/avatar.png') }}" class="w-12 h-12 rounded-full">
                <div class="ml-4">
                    <p class="text-xl">Selamat Datang,</p>
                    <p class="text-2xl font-bold">{{ auth()->user()->name ?? 'Tamu' }}</p>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('home') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Home</a>
                <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded">Permainan</a>
                <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded">Profile</a>
            </div>
        </div>
    </nav>
    {{$slot}}
</body>
</html>