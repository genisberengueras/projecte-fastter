@extends('nav.nav')
@section('titol')
    Qui som?
@endsection
@section('contingut')
    <div class="flex justify-center">
        <div class="lg:w-2/5 md:w-3/5 sm:w-4/5 mt-10 p-10 rounded-2xl shadow-2xl shadow-teal-300 border">
            <br>
            <h1 class="text-4xl">FASTTER WEB</h1>
            <br>
            <h2 class="text-xl">QUI SOM?</h2>
            <br>
            <p class="text-justify">Som una empresa de delivery de la comarca d’Osona.</p>
            <br>
            <p class="text-justify">El que ens distingeix és que ens centrem en petites poblacions com Torelló, Sant Hipòlit i Manlleu, perquè la seva població pugui gaudir del servei.</p>
            <br>
            <p class="text-justify">El que fem és repartir menjar i menús d’una selecció de restaurants de les diferents poblacions, perquè el client pugui gaudir del menjar desde la comoditat de casa seva.</p>
            <br>
            <p class="text-justify">Ens caracteritza la rapidesa i la qualitat d’un menjar de proximitat conegut arreu de la comarca d’uns quants restaurants dels municipis d’Osona</p>
            <br>
            <div class="flex justify-center">
                <img class="w-96" src="{{ asset('images/fastter.png') }}" alt="Logo Fastter">
            </div>
            <br>
        </div>
    </div>
@endsection
