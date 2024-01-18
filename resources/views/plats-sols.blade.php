@extends('nav.nav')
@section('titol')
    Comprar plats per separat
@endsection
@section('contingut')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Estilo oscuro de fondo para el modal */
        .modal-background {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        /* Estilo del modal */
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        /* Estilo del botón que activa el modal */
        .open-modal-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    @if(Auth::user()->is_admin)
        <div class="m-auto lg:w-2/5 md:w-4/5 w-full mt-16">
            <form action="{{ route('plat-store') }}" method="post" class="w-full p-10 rounded-2xl shadow-2xl">
                @csrf
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                <br>
                <br>
                <label for="">Escriu el nom del plat</label>
                <br>
                <input type="text" class="border-b w-full" name="nom_plat">
                <br>
                <br>
                <label for="">Escriu el preu del plat</label>
                <br>
                <input type="number" class="border-b w-full" name="preu">
                <br><br>
                <label for="">Selecciona el tipus del plat</label>
                <br>
                <br>
                <select name="tipus_plat" class="w-full p-2.5 rounded-2xl">
                    @foreach($tipus as $t)
                        <option  value="{{ $t->id }}">{{ $t->nom }}</option>
                    @endforeach
                </select>
                <br><br>
                <button type="submit" class="w-full p-2.5 bg-amber-500 text-white rounded-2xl">Afegir plat</button>
            </form>
        </div>
    @endif

    <div class="text-center">
        <h1 class="text-3xl font-bold mb-4 text-indigo-700">Mystery Box ({{ $restaurant->preu_mistery_box }}&euro;)</h1>
        <!-- Ajusta los estilos del botón para que sean más llamativos -->
        <button id="openModalBtn" class="bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 hover:from-pink-600 hover:via-red-600 hover:to-yellow-600 text-white font-bold py-3 px-6 rounded-full shadow-lg transform transition-transform duration-300 hover:scale-105">
            Obrir Mystery Box
        </button>
    </div>
    <div class="m-auto lg:w-3/5 md:w-4/5 w-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 mt-16">
        @foreach($plats as $p)
            @php
                $tipu = \App\Models\TipusPlat::where('id',$p->tipus_plat)->get();
            @endphp
            <div class="m-auto shadow-2xl rounded w-4/5">
                <div class="w-full flex justify-center p-2.5">
                    <h1 class="text-xl">{{ $p->nom_plat }}</h1>
                </div>
                <hr>
                <div class="w-full p-2.5">
                    <div class="w-full flex justify-between">
                        <span >Preu:</span><span>{{ $p->preu }} &euro;</span>
                    </div>
                    <br>
                    <input type="number" id="producte-{{ $p->id }}" value="1" class="border w-full">
                    <button class="bg-blue-500 w-full p-1 rounded-2xl text-white mt-5" onclick="addLinia({{ $p->id }},{{ $p->preu }})">Afegir a la comanda</button>
                    <button class="bg-red-500 w-full p-1 rounded-2xl text-white mt-5" onclick="removeLinia({{ $p->id }})">Treure de la comanda</button>
                </div>
            </div>
        @endforeach
        <button onclick="openModal()" class="mt-16 w-36 bg-amber-500 p-2.5 rounded-2xl shadow-2xl text-center text-white" id="preu">Pagar</button>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModalBtn">&times;</span>
            <h1>T'han tocat tots aquests productes per només {{ $restaurant->preu_mistery_box }}&euro;</h1>
            <div id="results-from" class="w-full p-2.5">
            </div>
            <br>
            <button type="submit" class="w-full text-center p-5 bg-white hover:bg-black text-black hover:text-white transition duration-1000 shadow-2xl" id="openModalMistery">Pagar ({{ $restaurant->preu_mistery_box }})</button>
        </div>
    </div>

    <div id="myModalMistery" class="modal">
        <div class="modal-content">
            <h3 class="font-medium text-gray-900">Dades de pagament:</h3>
            <span class="close" id="closeModalBtnMistery">&times;</span>
            <label for="cardNumber" class="block text-sm font-medium text-gray-700">Escriu el teu numero de targeta</label>
            <input type="text" id="cardNumber" placeholder="Escriu el teu numero de targeta" class="mt-1 p-2 border rounded">

            <label for="cvc" class="block text-sm font-medium text-gray-700">CVC:</label>
            <input type="text" id="cvc" placeholder="Escriu el CVC" class="mt-1 p-2 border rounded">

            <label for="expiryDate" class="block text-sm font-medium text-gray-700">Data de caducitat:</label>
            <input type="text" id="expiryDate" placeholder="MM/AA" class="mt-1 p-2 border rounded">
            <br>
            <button onclick="processPayment()" class="bg-blue-500 text-white py-2 px-4 rounded mt-4">Processar Pagament</button>
            <button onclick="closeModal()" class="bg-gray-500 text-white py-2 px-4 rounded mt-2">Cancel·lar</button>
        </div>
    </div>

    <script>
        let is_not_mistery=0;
        function openModal(){
            is_not_mistery=1;
            document.getElementById('myModalMistery').style.display = 'block';
        }
        let liniesComanda = [];
        function addLinia(producte_id,preu) {
            let quantitat = parseInt(document.getElementById('producte-'+producte_id).value);
            document.getElementById('producte-'+producte_id).classList.add('bg-green-500');
            liniesComanda.push({
                producte_id: producte_id,
                quantitat: quantitat,
                user_id: {{ Auth::user()->id }},
                preu: preu
            });
            console.log(liniesComanda);
            updatePreu();
        }
        function removeLinia(producte_id) {
            liniesComanda.forEach((value, index, array)=>{
                if(value.producte_id===producte_id){
                    array.pop(value);
                }
            });
            document.getElementById('producte-'+producte_id).classList.remove('bg-green-500');
            console.log(liniesComanda);
            updatePreu();
        }
        function updatePreu() {
            let preu = document.getElementById('preu');
            let suma = 0;
            liniesComanda.forEach((value, index, array)=>{
                preuLinia = value.preu * value.quantitat;
                suma = suma + value.preu;
            });
            console.log(suma);
            preu.innerText=`Pagar (${suma} €)`
        }

        let mistery_box=[];
        function generate_mistery_box() {
            fetch('{{ route('gen-mistery-box',['restaurant_id'=>$restaurant->id]) }}')
                .then(response => response.json())
                .then(data => {
                    mistery_box=data;
                    let resultats = document.getElementById('results-from');
                    resultats.innerText=``;
                    data.forEach((element,index,array)=>{
                        let resultat = document.createElement('div');
                        resultat.classList.add('w-full');
                        resultat.classList.add('p-2.5');
                        resultats.appendChild(resultat);
                        let new_item = document.createElement('div');
                        new_item.classList.add('flex');
                        new_item.classList.add('justify-between');
                        resultat.appendChild(new_item);
                        let span_one=document.createElement('span');
                        new_item.appendChild(span_one);
                        span_one.innerText=`${element.nom_plat}`;
                        let span_two=document.createElement('span');
                        new_item.appendChild(span_two);
                        span_two.innerText=`${element.preu}€`;
                    });
                });
        }
        document.addEventListener('DOMContentLoaded', function () {
            const openModalBtn = document.getElementById('openModalBtn');
            const openModalMistery = document.getElementById('openModalMistery');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const closeModalMistery = document.getElementById('closeModalBtnMistery');
            const modal = document.getElementById('myModal');
            const modal_mistery = document.getElementById('myModalMistery');

            openModalBtn.addEventListener('click', function () {
                modal.style.display = 'block';
                is_not_mistery=0;
                generate_mistery_box();
            });

            openModalMistery.addEventListener('click',function () {
                modal_mistery.style.display = 'block';
            });

            closeModalBtn.addEventListener('click', function () {
                modal.style.display = 'none';
            });

            closeModalMistery.addEventListener('click',function () {
                modal_mistery.style.display = 'none';
            });

            // Cierra el modal si el usuario hace clic fuera de él
            window.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

            window.addEventListener('click', function (event) {
                if (event.target === modal_mistery) {
                    modal_mistery.style.display = 'none';
                }
            });

        });

        function processPayment(value) {
            const cardNumber = document.getElementById('cardNumber').value;
            const cvc = document.getElementById('cvc').value;
            const expiryDate = document.getElementById('expiryDate').value;

            if (cardNumber && cvc && expiryDate) {
                // Simulación de mensaje creativo con SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: '¡Pago procesado con éxito!',
                    text: 'Gracias por tu pago.',
                    showConfirmButton: false,
                    timer: 3000,
                    didClose: () => {
                        hacerSubmit(value);
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Falten dades',
                });
            }
        }

        function hacerSubmit(test) {
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            let data = {data: mistery_box, restaurant_id: {{ $restaurant->id }} };

            let opciones = {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify(data)
            };

            if (is_not_mistery==1){
                let urlFinal = '{{ route('create-comanda-multiple') }}';
            }else{
                let urlFinal = '{{ route('store_mbox') }}';
            }



            fetch('{{ route('store_mbox') }}', opciones)
                .then(function (respuesta) {
                    // Verificar si la solicitud fue exitosa (código de estado 200)
                    if (respuesta.ok) {
                        // Manejar la respuesta del servidor
                        return respuesta.json();
                    } else {
                        // Manejar errores si la solicitud no fue exitosa
                        throw new Error("Error en la solicitud");
                    }
                })
                .then(function (datosRespuesta) {
                    // Hacer algo con los datos de la respuesta
                    window.location.href = datosRespuesta.redirect_url;
                })
                .catch(function (error) {
                    // Manejar errores generales
                    // console.error("Error:", error);
                });
        }
    </script>
@endsection
