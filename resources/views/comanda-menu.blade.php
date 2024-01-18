@extends('nav.nav')
@section('titol')
    Comanda menú
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
    <form method="post" class="w-full flex items-center flex-col mt-16" action="{{ route('comanda-store') }}" id="form-comanda">
        @csrf
        <input type="hidden" name="menu_id" value="{{ $menu['id'] }}">
        <div class="lg:w-1/3 md:w-2/3 w-full p-2.5 rounded-2xl shadow-2xl border border-teal-300 shadow-teal-300 mt-5">
            <h1 class="text-2xl text-center underline">{{ $menu['nom_menu'] }}</h1>
        </div>
        <br>
        <br>
        <div class="lg:w-1/3 md:w-2/3 w-full p-2.5 rounded-2xl shadow-2xl border border-teal-300 shadow-teal-300 mt-5">
            <br>
            <h2 class="text-xl text-center">Primer</h2>
            <br>
            <hr>
            <br>
            @foreach($menu['primers_plats'] as $plat)
                <div class="flex items-center mb-4">
                    <input id="default-radio-1" type="radio" required value="{{ $plat->id }}" name="primer_plat" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $plat->plat }}</label>
                </div>
                <br>
                <hr>
                <br>
            @endforeach
        </div>
        <br>
        <br>
        <div class="lg:w-1/3 md:w-2/3 w-full p-2.5 rounded-2xl shadow-2xl border border-teal-300 shadow-teal-300 mt-5">
            <br>
            <h2 class="text-xl text-center">Segon</h2>
            <br>
            <hr>
            <br>
            @foreach($menu['segons_plats'] as $plat)
                <div class="flex items-center mb-4">
                    <input id="default-radio-1" type="radio" required value="{{ $plat->id }}" name="segon_plat" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $plat->plat }}</label>
                </div>
                <br>
                <hr>
                <br>
            @endforeach
        </div>
        <br>
        <br>
        <div class="lg:w-1/3 md:w-2/3 w-full p-2.5 rounded-2xl shadow-2xl border border-teal-300 shadow-teal-300 mt-5">
            <br>
            <h2 class="text-xl text-center">Postres</h2>
            <br>
            <hr>
            <br>
            @foreach($menu['postres'] as $plat)
                <div class="flex items-center mb-4">
                    <input id="default-radio-1" type="radio" required value="{{ $plat->id }}" name="postres" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $plat->plat }}</label>
                </div>
                <br>
                <hr>
                <br>
            @endforeach
        </div>
        <br>
        <br>
        <div class="lg:w-1/3 md:w-2/3 w-full p-2.5 rounded-2xl shadow-2xl border border-teal-300 shadow-teal-300 mt-5">
            <br>
            <h2>Escriu la teva direccio</h2>
            <br>
            <input class="border-b border-amber-500 w-full" type="text" name="direccio" id="direccio" required>
            <br>
            <br>
        </div>
        <br>
        <br>
        <div class="lg:w-1/3 md:w-2/3 w-full p-2.5 rounded-2xl shadow-2xl border border-teal-300 shadow-teal-300 mt-5 bg-amber-500 text-center">
            <a onclick="openModal()" class="w-full text-center text-white" style="cursor: pointer">Realitzar la comanda</a>
        </div>
        <br><br>
    </form>

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
            // Aquí puedes realizar la acción que deseas después de procesar el pago
            console.log('Realizando submit...');
            //Check dels plats
            let primerPlat = document.querySelector('input[name="primer_plat"]:checked');
            let segonPlat = document.querySelector('input[name="segon_plat"]:checked');
            let postres = document.querySelector('input[name="postres"]:checked');
            let direccio = document.getElementById('direccio');
            let form = document.getElementById('form-comanda');

            if (primerPlat && segonPlat && postres) {
                form.submit();
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Tens de seleccionar una opció a cada camp',
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
