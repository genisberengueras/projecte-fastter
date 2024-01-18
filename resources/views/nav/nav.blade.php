<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>@yield('titol')</title>
</head>
<style>
    body {
        /*background-color: #000; !* Fondo negro *!*/
        /*background-image: linear-gradient(45deg, #3D3D3D 25%, transparent 25%, transparent 75%, #3D3D3D 75%, #3D3D3D), linear-gradient(45deg, #3D3D3D 25%, transparent 25%, transparent 75%, #3D3D3D 75%, #3D3D3D); !* Textura de piel *!*/
        /*background-size: 10px 10px; !* Tamaño de la textura *!*/
        /*background-color: black;*/
        /*filter: saturate(1.2);*/
        /*background: linear-gradient(to right, #404040, #1a1a1a); !* Gradiente de pizarra *!*/
        /*position: relative;*/
        /*overflow: hidden; !* Evitar desbordamiento de contenido *!*/
        background:
            /* Gradiente de pizarra */
            linear-gradient(to right, #404040, #1a1a1a),

                /* Manchas difuminadas */
            radial-gradient(ellipse at center, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0) 80%),

                /* Textura de piel */
            repeating-linear-gradient(45deg, #8B4513, #8B4513 10px, #D2B48C 10px, #D2B48C 20px);

        /* Ajustes generales */
        background-attachment: fixed; /* Fijar la imagen de fondo */
        background-size: 100% 100%, auto, auto; /* Tamaño de las capas de fondo */
        position: relative;
        overflow: hidden; /* Evitar desbordamiento de contenido */
    }
</style>
<body class="text-white">
<nav class="w-screen h-fit overflow-hidden shadow-white shadow-2xl">
    <div class="py-4 lg:px-8 px-4 max-w-[1280px] h-16 m-auto text-custom-yellow flex items-center justify-between">
        <div class="flex items-center">
            <img src="{{ asset('images/fastter.png') }}" alt="fastter" class="w-16 h-16">
{{--            <h1 class="lg:text-2xl text-xl uppercase tracking-wider cursor-pointer font-bold">FASTTER</h1>--}}
        </div>
        <div class="flex lg:gap-8 gap-6 uppercase tracking-wider cursor-pointer text-lg items-center" id="navItems">
                <a href="{{ route('home') }}" class="group text-custom-yellow">
                    Inici
                    <div class="w-0 group-hover:w-full h-0.5 bg-white ease-in-out duration-500"></div>
                </a>
                <a href="{{ route('quisom') }}" class="group text-custom-yellow">
                    Qui som
                    <div class="w-0 group-hover:w-full h-0.5 bg-white ease-in-out duration-500"></div>
                </a>
                <a href="{{ route('onrepartim') }}" class="group text-custom-yellow">
                    On repartim
                    <div class="w-0 group-hover:w-full h-0.5 bg-white ease-in-out duration-500"></div>
                </a>
                @php
                    $currentHour = date('H');
                    $showLink = ($currentHour >= 10);
                @endphp
            @if(Auth::check())
                @if($showLink || Auth::user()->is_admin)
                    <a href="{{ route('togoodtogo') }}" class="group text-custom-yellow">
                        To Good To Go
                        <div class="w-0 group-hover:w-full h-0.5 bg-white ease-in-out duration-500"></div>
                    </a>
                @endif
            @endif
            @if(Auth::check())
                <a href="{{ route('queixes') }}" class="group rounded-2xl p-2.5 flex hover:shadow-xl shadow-sky-200 transition duration-700">
                    Queixes
                    <div class="w-0 group-hover:w-full h-0.5 bg-white ease-in-out duration-500"></div>
                </a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('pobles') }}" class="group bg-yellow-500 rounded-2xl p-2.5 flex hover:shadow-xl shadow-sky-200 transition duration-700">
                        Gestió Menus
                        <div class="w-0 group-hover:w-full h-0.5 bg-white ease-in-out duration-500"></div>
                    </a>
                    <a href="{{ route('pobles') }}" class="group bg-yellow-500 rounded-2xl p-2.5 flex hover:shadow-xl shadow-sky-200 transition duration-700">
                        +Poble
                        <div class="w-0 group-hover:w-full h-0.5 bg-white ease-in-out duration-500"></div>
                    </a>
                    <a href="{{ route('restaurants') }}" class="group bg-yellow-500 rounded-2xl p-2.5 flex hover:shadow-xl shadow-sky-200 transition duration-700">
                        +Restaurant
                        <div class="w-0 group-hover:w-full h-0.5 bg-white ease-in-out duration-500"></div>
                    </a>
                @endif
                    <a href="{{ route('logout') }}" class="group bg-yellow-500 rounded-2xl p-2.5 flex hover:shadow-xl shadow-sky-200 transition duration-700">
                        Sortir
                        <div class="w-0 group-hover:w-full h-0.5 bg-white ease-in-out duration-500"></div>
                    </a>
            @else
                <a href="{{ route('login') }}" class="group bg-yellow-500 rounded-2xl p-2.5 flex hover:shadow-xl shadow-sky-200 transition duration-700">
                    Accedeix
                    <div class="w-0 group-hover:w-full h-0.5 bg-white ease-in-out duration-500"></div>
                </a>
            @endif
        </div>
        <div id="hamburger" class="fa fa-bars flex items-center text-xl" style="display:none;"></div>
        <div id="mobileNav"
             class="fixed flex flex-col gap-8 pt-16 px-4 text-xl uppercase bg-teal-500 h-full inset-0 top-16 w-[70%] left-[-70%] ease-in-out duration-500 cursor-pointer">
            <span><a href="{{ route('home') }}">Inici</a></span>
            <span><a href="{{ route('quisom') }}">Qui som?</a></span>
            <span>On repartim</span>
            @if(Auth::check())
                @if(Auth::user()->is_admin)
                @endif
            @else
                <span class="bg-yellow-500 rounded-2xl p-2.5 flex hover:shadow-xl shadow-sky-200 transition duration-700 text-center"><a href="{{ route('login') }}">Accedeix</a></span>
            @endif
        </div>
    </div>
</nav>

<script>
    var navItems = document.getElementById("navItems");
    var mobileNav = document.getElementById("mobileNav");
    var hamburger = document.getElementById("hamburger");


    function adjustNavbar() {
        screenWidth = parseInt(window.innerWidth);

        if (screenWidth < 541) {
            navItems.style.display = "none";
            hamburger.style.display = "flex";
        }
        else {
            navItems.style.display = "flex";
            hamburger.style.display = "none";
        }
    }

    adjustNavbar();

    window.addEventListener("resize", adjustNavbar);

    hamburger.addEventListener("click", function () {
        mobileNav.classList.toggle("left-[-70%]");
        hamburger.classList.toggle("fa-bars");
        hamburger.classList.toggle("fa-close");
    })
</script>
@yield('contingut')
</body>
</html>
