@extends('nav.nav')
@section('titol')
    FASTTER
@endsection
@section('contingut')
    <div class="flex flex-col items-center justify-center w-full">
        @if(Auth::check())
            <div class="w-full flex justify-center mt-5">
                <a href="{{ route('comanda-usuari',['user_id'=>Auth::user()->id]) }}" class="lg:w-2/5 md:w-4/5 w-full bg-amber-500 p-2.5 rounded-2xl text-white text-center shadow-2xl">Les meves comandes</a>
            </div>
        @endif
        <form action="{{ route('filter-pobles') }}" class="lg:w-2/5 md:w-4/5 w-full shadow-2xl mt-20 p-2.5 rounded-2xl bg-custom-blue" method="post">
            @csrf
            <h1 class="text-4xl">De quin poble ets ?</h1>
            <br><br>
            <select class="w-full p-2.5 shadow bg-custom-blue shadow-2xl" name="select_poble" size="3">
                @foreach($pobles as $p)
                    <option value="{{ $p->id }}" class="p-2.5 shadow text-xl">{{ $p->nom }}</option>
                @endforeach
            </select>
            <br><br>
            <button type="submit" class="w-full bg-yellow-500 p-2.5 rounded-2xl shadow-2xl text-white">Buscar restaurants</button>
        </form>
    </div>
@endsection
