@extends('nav.nav')
@section('titol')
    Configurar ToGoodToGo
@endsection
@section('contingut')
    <div class="lg:w-3/5 md:w-4/5 w-full mt-16 m-auto">
        <form class="shadow-2xl rounded p-2.5" action="{{ route('togood-title-save',['restaurant_id'=>$restaurant->id]) }}" method="post">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <h1 class="text-2xl text-center">Configuració Mistery Box per {{ $restaurant->nom }}</h1>
            <br>
            <br>
            <hr>
            <br>
            <label for="" class="text-xl">Escriu la descripció de la Mistery Box</label>
            <br>
            <textarea class="w-full border" name="desc_mistery_box" id="" cols="30" rows="10" >{{ $restaurant->desc_mistery_box }}</textarea>
            <br>
            <label for="">Preu del mistery box</label>
            <br><br>
            <input type="number" name="preu_mistery_box" class="border p-2.5 w-full" value="1">
            <br><br>
            <button type="submit" class="p-2.5 bg-black text-white w-full rounded">Guardar descripció Mistery Box</button>
        </form>
    </div>

    <div class="lg:w-3/5 md:w-4/5 w-full mt-16 m-auto">
        <form class="shadow-2xl rounded p-2.5" action="{{ route('togood-save') }}" method="post">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <label for="">Selecciona el tipus de plat:</label>
            <br><br>
            <select name="tipus_plat_id" class="p-2.5 rounded-2xl w-full">
                @foreach($tipus_plats as $tp)
                    <option value="{{ $tp->id }}">{{ $tp->nom }}</option>
                @endforeach
            </select>
            <br><br>
            <label for="">Quantitat del material de la Mistery Box</label>
            <br><br>
            <input type="number" name="quantitat" class="border p-2.5 w-full">
            <br><br>
            <button type="submit" class="p-2.5 bg-black text-white w-full rounded">Afegir combinació</button>
        </form>
    </div>
    <div class="lg:w-3/5 md:w-4/5 w-full mt-16 m-auto">
        @foreach($configuracions as $c)
            @php
                $tipus=\App\Models\TipusPlat::find($c->tipus_plat_id);
            @endphp
            <div class="p-2.5 flex justify-between">
                <span>
                    {{ $tipus->nom }}
                </span>
                <span>
                    x{{$c->quantitat}}
                    <a class="text-white bg-black p-2.5 rounded-2xl" href="{{ route('togood-destroy',['id'=>$c->id,'restaurant_id'=>$restaurant->id]) }}">Eiminar</a>
                </span>
            </div>
        @endforeach
    </div>
@endsection
