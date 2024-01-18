@extends('nav.nav')
@section('titol')
    Admin Pobles
@endsection
@section('contingut')
    <div class="w-full flex justify-center mt-16">
        <form class="lg:w-1/3 md:w-2/3 sm:w-full shadow-2xl p-2.5 rounded-2xl" action="{{ route('addpoble') }}" method="post">
            @csrf
            <br><br>
            <label class="underline" for="nom">Escriu el nom</label>
            <br><br>
            <input type="text" name="nom" class="border-b border-black w-full p-2.5">
            <br><br><br><br>
            <button class="p-2.5 bg-amber-500 w-full rounded-2xl text-white shadow-2xl shadow-teal-300" type="submit">Afegir poble</button>
            <br><br>
        </form>
    </div>
@endsection
