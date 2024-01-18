@extends('nav.nav')
@section('titol')
    Comandes usuari
@endsection
@section('contingut')
    <div class="w-full flex flex-col items-center mt-16">
        <h1 class="text-3xl underline">Les teves comandes</h1>
        <small><a class="text-blue-700" href="{{ route('comandes-multiples',[Auth::user()->id]) }}">(Plats sols)</a></small>
        <br>
        @foreach($comandes as $key=>$c)
            <br>
            <div class="lg:w-3/5 md:w-4/5 w-full p-2.5 shadow-2xl flex flex-col items-center">
                <div class="w-full flex">
                    <div class="w-1/2">Codi comanda: {{ $c['comanda']->id }}
                    <br>
                    <small class="text-red-500">*Utilitza aquest codi si tens aquest problema</small>
                    </div>
                    <div class="w-1/2">Direcció: <span>{{ $c['comanda']->direccio }}</span></div>
                </div>
                <hr>
                <br>
                <div style="display:none;cursor: pointer" onclick="showOrHideInfo({{ $key }})" id="comanda-{{ $key }}" class="w-full border lg:w-3/5 md:w-4/5 w-full p-2.5">
                    <span>Plats demanats:</span>
                    <ul>
                        <br>
                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ $c['linies'][0]->primer_plat }}</li>
                        <br>
                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ $c['linies'][0]->segon_plat }}</li>
                        <br>
                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ $c['linies'][0]->postres }}</li>
                        <br>
                    </ul>
                    <span>{{ $c['comanda']->preu_total }} &euro;</span>
                </div>
                <hr class=" w-full">
                <button onclick="showOrHideInfo({{ $key }})">Més informació</button>
            </div>
            <br>
        @endforeach
    </div>
    <script>
        function showOrHideInfo(id) {
            let divTo = document.getElementById('comanda-'+id);
            if(divTo.style.display==='none'){
                divTo.style.display='block';
            }else{
                divTo.style.display='none';
            }
        }
    </script>
@endsection
