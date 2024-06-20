<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGameList</title>
    <link rel="stylesheet" href="{{ asset('mainstyles.css') }}">
    <link rel="icon" href="{{ asset('images/websitelogo/logo.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
</head>
<body class="flex flex-col min-h-screen bg-gradient-to-r from-blue-100 to-blue-900">
<x-navbar/>
<div class="mt-36 flex-1 mb-96">
    {{$slot}}
</div>
<x-footer/>
</body>
</html>
