@extends('nav.nav')
@section('titol')
    Llista restaurants
@endsection
@section('contingut')
    <h1 class="mt-16 w-full text-center text-2xl underline">Restaurants a {{ $poble->nom }}</h1>
    <div class="w-full flex justify-center mt-16">
        <div class="w-full md:w-4/5 lg:w-4/5 grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($restaurants as $res)
                <div class="max-w-sm rounded overflow-hidden shadow-lg shadow-teal-300">
                    <img class="w-full" src="{{ asset('uploads/' . $res->foto) }}" alt="Sunset in the mountains">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $res->nom }}</div>
                        <p class="text-gray-700 text-base">
                            {{ $res->descripcio }}
                        </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <a href="" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Informació</a>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('togood-configure',['restaurant_id'=>$res->id]) }}" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Configurar ToGoodToGo</a>
                        @endif
                        <a href="{{ route('plats-sols',['restaurant_id'=>$res->id]) }}" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Plats</a>
                        <a href="{{ route('menus-r',['restaurant_id'=>$res->id]) }}" class="inline-block bg-amber-500 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Demanar</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
