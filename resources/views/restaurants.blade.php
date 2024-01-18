@extends('nav.nav')
@section('titol')
    Admin restaurants
@endsection
@section('contingut')
    <div class="w-full flex justify-center">
        <div class="lg:w-1/3 md:w-2/3 sm:w-full mt-16">
            <form class="w-full p-3.5 shadow-2xl rounded-2xl" action="{{ route('addrest') }}" method="post" enctype="multipart/form-data">
                @csrf
                <br>
                <h1 class="text-2xl">Dades generals del restaurant</h1>
                <br><br>
                <label for="">Nom del restaurant</label>
                <br>
                <br>
                <input class="w-full border-b border-black" type="text" name="nom" required value="{{ old('nom') }}">
                <br>
                <br>
                <label for="">Nom del poble</label>
                <br>
                <br>
                <select name="poble" id="poble" required class="w-full p-2.5 border-b border-black">
                    @foreach($pobles as $p)
                        <option value="{{ $p->id }}">{{ $p->nom }}</option>
                    @endforeach
                </select>
                <br>
                <br>
                <label for="">Descripció</label>
                <br><br>
                <textarea class="w-full border border-black" name="descripcio" id="descripcio"></textarea>
                <br><br>
                <label for="">Direcció</label>
                <br>
                <br>
                <input class="w-full border-b border-black" type="text" name="direccio" required value="{{ old('direccio') }}">
                <br>
                <br>
                <label for="">Penja una foto del restaurant</label>
                <br>
                <br>
                <input type="file" class="rounded-2xl p-2.5 shadow-xl shadow-teal-300" name="foto" required>
                <br>
                <br>
                <br>
                <hr class="h-1 bg-black">
                <br>
                <br>
                <h1 class="text-2xl">Horaris</h1>
                <br>
                <small class="text-red-500">Escriu els horaris en el següent format, ex: 7:00-23:00, assegura't que tinguint tots els mateix format, si un dia està tancat fica -1</small>
                <br>
                <br>
                <input class="w-full border-b border-black" type="text" placeholder="Dilluns" name="dilluns">
                <br><br>
                <input class="w-full border-b border-black" type="text" placeholder="Dimarts" name="dimarts">
                <br><br>
                <input class="w-full border-b border-black" type="text" placeholder="Dimecres" name="dimecres">
                <br><br>
                <input class="w-full border-b border-black" type="text" placeholder="Dijous" name="dijous">
                <br><br>
                <input class="w-full border-b border-black" type="text" placeholder="Divendres" name="divendres">
                <br><br>
                <input class="w-full border-b border-black" type="text" placeholder="Dissabte" name="dissabte">
                <br><br>
                <input class="w-full border-b border-black" type="text" placeholder="Diumenge" name="diumenge">
                <br><br>
                <button class="w-full p-2.5 bg-amber-500 text-white rounded-2xl shadow-teal-300 shadow-2xl" type="submit">Afegir</button>
            </form>
        </div>
    </div>
    <div class="w-full flex justify-center overflow-scroll mt-16">
        <table>
            @foreach($restaurants as $r)
                <tr>
                    <td>{{ $r->nom }}</td>
                    <td><a href="{{ route('menus-g', ['id' => $r->id]) }}">Menus</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
