@extends('nav.nav')
@section('titol')
    Afegir menus
@endsection
@section('contingut')
    <div class="w-full flex justify-center mt-16">
        <form class="lg:w-1/3 md:w-2/3 w-full shadow-2xl p-2.5 rounded-2xl" method="post" action="{{ route('platsave') }}">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $menu_id }}">
            <br>
            <label for="">Escriu el nom del plat</label>
            <br><br>
            <input class="p-2.5 border-b border-black w-full" type="text" name="plat" required>
            <br><br>
            <label for="">Quin tipus de plat es?</label>
            <br><br>
            <select class="w-full p-2.5 bg-white shadow-2xl" name="tipu_plat" id="tipu_plat" required>
                <option value="1">1r Plat</option>
                <option value="2">2n Plat</option>
                <option value="3">Postres</option>
            </select>
            <br><br>
            <button type="submit" class="w-full p-2.5 bg-amber-500 rounded-2xl text-white shadow-2xl">Afegir plat</button>
        </form>
    </div>
@endsection
