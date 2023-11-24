<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to the tailwind css file -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Training Report</title>
</head>
<body>
<!-- Create a navbar with a logo and a link to the homepage -->
<nav class="bg-primary p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-white text-xl font-bold">
            <img class="w-32 h-auto" src="{{ asset('images/uofi.png') }}" alt="University of Illinois">
        </a>
        <ul class="flex">
            <li><a href="{{ route('home') }}" class="text-white hover:text-gray-300 px-4">Home</a></li>
        </ul>
    </div>
</nav>
<!-- Display the content of the page -->
@yield('content')
</body>
</html>