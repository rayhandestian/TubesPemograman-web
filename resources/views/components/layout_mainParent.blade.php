<!-- resources/views/layouts/layout_main.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KiQualls</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>
<body class="bg-sky-200">

    <!-- Clouds Container (Background) -->
    <div class="fixed w-full h-full pointer-events-none z-0">
        <img src="{{ asset('img/clouds1.png') }}" alt="Cloud 1" class="cloud-float absolute w-32 opacity-100 top-10 left-0 z-0">
        <img src="{{ asset('img/clouds1.png') }}" alt="Cloud 2" class="cloud-float-slow absolute w-40 opacity-100 top-40 right-1/2 z-0">
        <img src="{{ asset('img/clouds1.png') }}" alt="Cloud 3" class="cloud-float-slow absolute w-36 opacity-100 top-80 left-1/4 z-0">
        <img src="{{ asset('img/clouds1.png') }}" alt="Cloud4" class="absolute w-40 opacity-100 top-100 right-0 z-0">
        <img src="{{ asset('img/matahari.png') }}" alt="Sun" class="absolute w-20 opacity-100 top-100 right-0 z-0">
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex-col items-center justify-center p-4 relative z-10">
        {{$slot}}
    </div>

</body>
</html>
