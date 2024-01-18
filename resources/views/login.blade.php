@extends('nav.nav')
@section('titol')
    Login
@endsection
@section('contingut')
    <div class="w-full flex justify-center">
        <form class="lg:w-1/3 md:w-2/3 sm:w-full w-9/12 mt-20 p-2.5 rounded-2xl shadow-xl shadow-teal-300" action="{{ route('attempt-login') }}" method="post">
            @csrf
            <h1 class="text-xl">Introdueix les teves dades</h1>
            <br>
            <label for="name">Nom d'usuari</label>
            <br>
            <input type="text" name="name" class="border-b w-full border-black" required value="{{ old('name') }}">
            <br>
            @error('name')
                <small class="text-red-600"{{ $message }}></small>
            @enderror
            <br>
            <label for="password">Contrasenya</label>
            <br>
            <input type="text" name="password" class="border-b w-full border-black" required value="{{ old('password') }}">
            <br>
            @error('password')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
            <br>
            <a class="text-sm" href="{{ route('signup') }}">Encara no tens usuari?</a>
            <br>
            <br>
            <button class="text-center w-full text-white bg-yellow-500 p-2.5 rounded-2xl">ACCEDEIX</button>
        </form>
    </div>
@endsection
