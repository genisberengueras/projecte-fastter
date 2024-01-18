@extends('nav.nav')
@section('titol')
    Llista menus per restaurant
@endsection
@section('contingut')
    <div class="w-full flex justify-center mt-16">
        @if(isset($restaurant))
            <h1 class="text-2xl">{{ $restaurant->nom }}</h1>
        @endif
    </div>
    <div class="grid md:grid-cols-2 grid-cols-1 mt-16">
        @foreach($menus as $menu)
            <div class="lg:w-1/2 md:w-2/3 w-11/12 m-auto p-2.5 shadow-2xl shadow-teal-300 md:mt-1 mt-16 border rounded-2xl border-teal-300 ">
                <br>
                <h1 class="text-xl text-center">{{ $menu['title'] }}</h1>
                <br>
                <hr style="border-top: dotted 1px;" />
                <br>
                <h1 class="text-xl text-center">Primers plats</h1>
                <br>
                <hr style="border-top: dotted 1px;" />
                @foreach($menu['primers_plats'] as $plat)
                    <br>
                    <p class="text-center">{{ $plat->plat }}</p>
                    <br>
                    <hr>
                @endforeach
                <hr style="border-top: dotted 1px;" />
                <br>
                @foreach($menu['segons_plats'] as $plat)
                    <br>
                    <p class="text-center">{{ $plat->plat }}</p>
                    <br>
                    <hr>
                @endforeach
                <hr style="border-top: dotted 1px;" />
                <br>
                <h1 class="text-xl text-center">Postres</h1>
                <br>
                <hr style="border-top: dotted 1px;" />
                @foreach($menu['postres'] as $postre)
                    <br>
                    <p class="text-center">{{ $postre->plat }}</p>
                    <br>
                    <hr>
                @endforeach
                <br>
                <div class="w-full text-center">
                    <button onclick="window.location.replace('{{ route('crear-comanda',['menu_id'=>$menu['id']]) }}')" class="w-full p-2.5 bg-amber-500 text-center text-white rounded-2xl">Fer comanda ({{ $menu['preu'] }}&euro;)</button>
                </div>
                <br>
            </div>
        @endforeach

    </div>
    <br><br><br>
@endsection
