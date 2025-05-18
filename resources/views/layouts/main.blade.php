<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GFB</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
        <link rel="stylesheet" href=" {{ Vite::asset('resources/css/app.css') }}">
    </head>
    <header>
        @section('header')
        <nav>
            <a href="/" @if(Route::currentRouteName() == "dashboard.render") aria-current="true" @endif>Dashboard</a>
            <a href="/plans" @if(Route::currentRouteName() == "plans.index") aria-current="true" @endif>Plans</a>
            <a href="/incomes" @if(Route::currentRouteName() == "incomes.index") aria-current="true" @endif >Incomes</a>
            <a href="/household" @if(Route::currentRouteName() == "household.render") aria-current="true" @endif >Household</a>
        </nav>
        <button form="logout" type="submit">Log out</button>
        <form id=logout action="/logout" method="POST" style="display: none;">@csrf</form>
        @show
    </header>

    <body>
        <main>
            @yield('content')
        </main>
    </body>
</html>
