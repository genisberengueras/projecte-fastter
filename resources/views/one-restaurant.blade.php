@extends('nav.nav')
@section('titol')
    {{ $restaurant->nom }}
@endsection
@section('contingut')
    <div class="w-full flex justify-center mt-16">
        <div class="lg:w-3/5 md:w-4/5 sm:w-full flex">
            <div id="image" class="w-1/2 bg-amber-500">
                <img class="h-auto w-96 rounded-lg" src="{{ asset('uploads/' . $restaurant->foto) }}" alt="{{ $restaurant->nom }}}">
            </div>
            <div id="other" class="w-1/2 bg-blue-600">

            </div>
        </div>
    </div>
@endsection
