@extends('nav.nav')
@section('titol')
    Menus
@endsection
@section('contingut')
    <div class="w-full flex justify-center mt-16">
        <form class="lg:w-1/3 md:w-2/3 w-full p-2.5 shadow-2xl rounded-2xl" action="{{ route('addmenus') }}" method="post">
            @csrf
            <br><br>
            <label for="">Nom del menú</label>
            <br><br>
            <input class="w-full border-b border-black" type="text" name="title">
            <br><br>
            <label for="">Preu del menú</label>
            <br><br>
            <input class="w-full border-b border-black" type="number" name="preu">
            <br><br>
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <button class="bg-amber-500 text-white p-2.5 w-full rounded-2xl shadow-2xl" type="submit">Crear menú</button>
        </form>
    </div>
    <div class="w-full flex justify-center mt-10">
        <table class="lg:w-1/3 md:w-2/3 w-full">
            @foreach($menus as $m)
                <tr>
                    <td class="border border-black">{{ $m->title }} </td>
                    <td class="border border-black">{{ $m->preu }} €</td>
                    <td class="border border-black"><a href="{{ route('plats',['menu_id'=>$m->id]) }}">Afegir plats</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
