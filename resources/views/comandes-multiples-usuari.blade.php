@extends('nav.nav')
@section('titol')
    Comandes usuari
@endsection
@section('contingut')
    <div class="m-auto lg:w-3/5 md:w-4/5 sm:w-full">
        @foreach($data as $comanda)
            <div class="p-10 shadow-2xl mt-16 m-auto rounded-2xl w-full">
                <div class="w-full flex justify-between md:flex-row flex-col">
                    <div>
                        <h3 class="text-xl">Codi: {{ $comanda['id'] }}</h3>
                        <small class="text-red-500">*Utilitza aquest codi a la secció de queixes</small>
                    </div>
                    <div>
                        Data: {{ $comanda['data']->format('d-m-Y') }}
                    </div>
                </div>
                <div class="w-full">
                    <hr>
                    <br>
                    <p>Preu: {{ $comanda['preu'] }}&euro;</p>
                    <br>
                    <hr>
                    <br>
                    <h4>Productes:</h4>
                    <br>
                    <div class="lg:w-3/5 border m-auto">
                        @foreach($comanda['linies'] as $l)
                            <div class="flex justify-between p-2.5">
                                <span>{{ $l['nom'] }}</span><span>x {{ $l['quantitat'] }}</span>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
