<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGameList</title>
    <link rel="stylesheet" href="{{ asset('mainstyles.css') }}">
    <link rel="icon" href="{{ asset('images/websitelogo/logo.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <script src="js/dropdown.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"
    />
</head>
<body class="flex flex-col min-h-screen bg-gradient-to-r from-blue-100 to-blue-900">
<x-navbar/>
<div class="mt-36 flex-1 mb-96">
    {{$slot}}
</div>
<x-footer/>
</body>
</html>
