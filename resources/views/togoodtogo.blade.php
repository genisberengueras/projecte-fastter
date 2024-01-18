@extends('nav.nav')
@section('titol')
    To Good To Go
@endsection
@section('contingut')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <div class="w-full flex flex-col items-center mt-5">
        @csrf
        @if(Auth::user()->is_admin)
            <a class="p-2.5 bg-amber-500 text-white rounded-2xl shadow-2xl" href="{{ route('create-good') }}">Afegir producte</a>
        @endif
        <div class="lg:w-3/5 md:w-4/5 w-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1">

            @foreach($togoodtogo as $tg)
                <div class="w-4/5 m-auto rounded shadow-2xl mt-16">
                    <div class="w-full flex text-2xl justify-center p-2.5 border-b">
                        <span>{{ $tg->nom }}</span>
                    </div>
                    <div class="p-2.5 flex justify-between">
                        <br>
                        <span>Preu: {{ $tg->preu }} &euro;</span><span>Data: {{ $tg->data }}</span>
                        <br>
                    </div>
                    <div class="p-2.5">
                        @if(!Auth::user()->is_admin)
                            <input type="number" id="producte-{{ $tg->id }}" class="w-full border text-left" value="1">

                            <button class="text-white p-1 bg-blue-500 mt-5 w-full rounded-2xl" onclick="addLinia({{ $tg->id }},{{ $tg->preu }})">Afegir a la comanda</button>
                            <button class="text-white p-1 bg-red-500 mt-5 w-full rounded-2xl" onclick="removeLinia({{ $tg->id }})">Treure de la comanda</button>
{{--                            <div><input type="checkbox" name="productes" onclick="addLinia({{ $tg->id }})"><label for="">Afegir a la comanda</label></div>--}}
                        @endif
                    </div>
                </div>
            @endforeach
            <button onclick="openModal()" class="mt-16 w-36 bg-amber-500 p-2.5 rounded-2xl shadow-2xl text-center text-white" id="preu">Pagar</button>
        </div>
    </div>
    <div id="myModal" class="modal-background">
        <div class="modal-content bg-white p-6 rounded shadow-md">
            <h3 class="font-medium text-gray-900">Dades de pagament:</h3>
            <br>
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

        function openModal() {
            document.getElementById('myModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }

        function processPayment() {
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

                        hacerSubmit();
                    }
                });

                closeModal();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Falten dades',
                });
            }
        }

        function hacerSubmit() {
            if(liniesComanda.length<1){
                alert('res seleccionat');
            }else{
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                let data = {data: liniesComanda};

                let opciones = {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify(data)
                };

                fetch('/crear-comanda-multiple', opciones)
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
                        console.error("Error:", error);
                    });
            }
        }

        window.onclick = function(event) {
            if (event.target === document.getElementById('myModal')) {
                closeModal();
            }
        };
    </script>
@endsection
