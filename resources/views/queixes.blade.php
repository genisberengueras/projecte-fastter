@extends('nav.nav')
@section('titol')
    Queixes i reclamacions
@endsection
@section('contingut')
    @if(!Auth::user()->is_admin)
        <div class="w-full flex justify-center mt-16">
            <form action="{{ route('submitqueixa') }}" method="post" class="lg:w-1/3 md:w-2/3 sm:w-full p-2.5 shadow-2xl shadow-teal-300 rounded-2xl">
                @csrf
                <br>
                <h1 class="text-2xl underline">Els nostres errors ens fan millorar</h1>
                <br>
                <br>
                <label class="text-xl" for="">Fés una petita descripció de la teva queixa</label>
                <br>
                <br>
                <input type="text" class="w-full border-b border-black" name="descripcio" placeholder="Descriu el teu problema" required>
                <br>
                <br>
                <label class="text-xl" for="">Escriu el teu problema de manera més extensa</label>
                <br><br>
                <textarea name="desc_extensa" id="" class="w-full border" rows="10" required></textarea>
                <br><br>
                <button type="submit" class="text-white bg-amber-500 w-full p-2.5 rounded-2xl">Presentar queixa</button>
            </form>
        </div>
    @else
        <div class="w-full flex items-center flex-col mt-16">
            <h1 class="underline text-2xl">Queixes dels usuaris</h1>
            @foreach($queixes as $q)
                @php
                    $author=\App\Models\User::find($q->user_id);
                @endphp
                <div class="lg:w-1/3 md:w-2/3 sm:w-full p-10 rounded-2xl shadow-2xl mt-10">
                    <div class="w-full flex md:flex-row flex-col justify-between">
                        <span class="uppercase"><b>Motiu:</b> {{ $q->descripcio }}</span><span><b class="uppercase">Autor:</b> {{ $author->name }}</span>
                    </div>
                    <div class="mt-3.5 w-full">
                        <p>{{ $q->desc_extensa }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
