@extends('nav.nav')
@section('titol')
    Crear To Good To Go
@endsection
@section('contingut')
    <form class="lg:w-3/5 md:w-4/5 w-full mt-16 rounded-2xl shadow-2xl bg-gray-100 p-10 m-auto" action="{{ route('store-good') }}" method="post">
        @csrf
        <h1 class="text-2xl">To Good To Go</h1>
        <br>
        <label for="">Nom del producte</label>
        <br>
        <input class="p-2.5 bg-gray-100 border w-full" type="text" name="nom">
        <br>
        <label for="">Preu</label>
        <br>
        <input class="p-2.5 bg-gray-100 border w-full" type="number" name="preu">
        <br>
        <label for="">Data</label>
        <br>
        <input class="p-2.5 bg-gray-100 border w-full" type="datetime-local" name="data">
        <br>
        <label for="">Quantitat disponible</label>
        <br>
        <input class="p-2.5 bg-gray-100 border w-full" type="number" name="quantitat">
        <br>
        <br>
        <button type="submit" class="w-full bg-white p-2.5 text-black rounded-2xl shadow-2xl">Crear</button>
    </form>
@endsection
