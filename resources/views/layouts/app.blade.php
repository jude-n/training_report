<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Training Report</title>
</head>
<body class="bg-your-image bg-center bg-cover h-screen w-full bg-fixed">
<nav class="bg-primary p-4 border-b-2 border-white">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('training.home') }}" class="text-white text-xl font-bold">
            <img class="w-32 h-auto" src="{{ asset('images/uofi.png') }}" alt="University of Illinois">
        </a>
        <img class="w-full h-auto max-w-[195px]" src="{{ asset('images/trainer.png') }}" alt="University of Illinois Training Tracker">

        <ul class="flex">
            <li><a href="{{ route('training.home') }}" class="text-white hover:text-gray-300 px-4">Home</a></li>
        </ul>
    </div>
</nav>
<!-- Display the content of the page -->
@yield('content')
</body>
</html>