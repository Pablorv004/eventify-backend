@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Eventify</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body py-0>
    <div class="position-relative overflow-hidden" style="height: 775px;">
        <video autoplay muted loop class="w-100 h-100" style="object-fit: cover;">
            <source src="videos/eventifybg.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center"
            style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="logo">
                <img src="images/logo/eventify-logo.png" alt="EVENTIFY">
            </div>
        </div>
    </div>

    <div class="about-us text-center py-5">
        <h2>About Us</h2>
        <p>Welcome to Eventify! We are dedicated to providing the best event management services...</p>
    </div>
</body>

</html>
@endsection