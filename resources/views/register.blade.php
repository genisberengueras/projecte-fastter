@extends('nav.nav')
@section('titol')
    Registre
@endsection
@section('contingut')
    <div class="w-full flex justify-center">
        <form class="lg:w-1/3 md:w-2/3 sm:w-full w-9/12 mt-20 p-2.5 rounded-2xl shadow-xl shadow-teal-300" action="{{ route('store-user') }}" method="post">
            @csrf
            <h1 class="text-xl">Crea el teu usuari</h1>
            <br>
            <label for="name">Nom d'usuari</label>
            <br>
            <input type="text" name="name" class="border-b w-full border-black" required>
            <br>
            @error('name')
            <small class="text-red-600"{{ $message }}></small>
            @enderror
            <br>
            <label for="email">Email</label>
            <br>
            <input type="text" name="email" class="border-b w-full border-black" required value="{{ old('email') }}">
            <br>
            @error('email')
            <small class="text-red-600">{{ $message }}</small>
            @enderror
            <br>
            <label for="password">Contrasenya</label>
            <br>
            <input type="password" name="password" class="border-b w-full border-black" required value="{{ old('password') }}">
            <br>
            @error('password')
            <small class="text-red-600">{{ $message }}</small>
            @enderror
            <br>
            <label for="password_confirmation">Confirma la contrasenya</label>
            <br>
            <input type="password" name="password_confirmation" class="border-b w-full border-black" required>
            <br>
            @error('password_confirmation')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
            <br>
            <br>
            <button class="text-center w-full text-white bg-yellow-500 p-2.5 rounded-2xl">ACCEDEIX</button>
        </form>
    </div>
@endsection
