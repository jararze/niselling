@push('styles')

@endpush
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const upload = document.getElementById('fileInput');
        const output = document.getElementById('output');
        const placeholder = document.getElementById('placeholder');
        const prompt = document.getElementById('prompt');
        const remove = document.getElementById('remove');

        upload.addEventListener('change', function() {
            const reader = new FileReader();

            reader.onloadend = function () {
                output.src = reader.result;
                placeholder.classList.add('hidden');
                output.classList.remove('hidden');
                prompt.innerText = 'Comprobante cargado';
                remove.classList.remove('hidden');
                upload.style.pointerEvents = "none";
            }

            if (upload.files[0]) {
                reader.readAsDataURL(upload.files[0]);
            }
        });

        remove.addEventListener('click', function() {
            output.src = "";
            placeholder.classList.remove('hidden');
            output.classList.add('hidden');
            upload.value = "";
            prompt.innerText = 'Arrastre el Comprobante aqui';
            remove.classList.add('hidden');
            upload.style.pointerEvents = "auto";
        });

        // const form = document.getElementById('signUpForm');
        // form.addEventListener('submit', function(event) {
        //     const fileInput = document.getElementById('fileInput');
        //     if (fileInput.files.length === 0) {
        //         event.preventDefault();
        //         Swal.fire({
        //             title: 'Error!',
        //             text: 'Por favor, adjunte su comprobante de transferencia.',
        //             icon: 'error',
        //             confirmButtonText: 'OK'
        //         });
        //     }
        // });
    </script>
@endpush

<x-front-layout>

    <div id="spinner" class="spinner-overlay hidden">
        <div class="spinner"></div>
    </div>

    <div
        class="relative w-full max-w-screen-xl px-1 py-8 mx-auto lg:grid lg:grid-cols-1 lg:gap-16 xl:gap-16 lg:py-4 border-t-2"
        style="width: 80%">
        <h2 class="mt-3 text-3xl tracking-tight text-gray-900 md:text-3xl uppercase">transferencia bancaria</h2>
        <div class="absolute bottom-0 left-[10.4%] w-[7%] h-1 bg-nissan transform -translate-x-[145%]"></div>
    </div>

    <form id="signUpForm" class="mx-auto mb-8" action="{{ route('frontend.quote.store.voucher') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- component -->
        <div
            class="relative min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-white bg-no-repeat bg-cover">
            <div class="sm:max-w-lg w-full bg-white rounded-xl z-10 px-20">
                <div class="grid grid-cols-1 space-y-2">
                    <label for="name"
                           class="font-bold block mb-2 text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Monto
                        de reserva</label>
                    <div class="mt-2">
                        <input type="hidden" value="{{ $id }}" name="id">
                        <input type="text" name="name" id="name" autocomplete="given-name"
                               value="200 $us"
                               class="border-[#eeeeee] bg-[#eeeeee] text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3"
                               placeholder="" required/>
                    </div>
                    <p style="font-size: 12px; text-align: center" class="mt-3">Adjunte el
                        comprobante de transferencia para que procedamos con la reserva.</p>
                </div>
                <div class="grid grid-cols-1 space-y-2 mt-4">
                    <label class="text-sm font-bold tracking-wide after:content-['*'] after:ml-0.5 after:text-nissan">Subir el comprobante</label>
                    <div class="flex items-center justify-center w-full">
                        <label
                            class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center">
                            <div
                                class="h-full w-full text-center flex flex-col items-center justify-center">
                                <!---<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>-->
                                <div class="flex flex-auto mx-auto relative group">
                                    <img id="output" class="hidden has-mask object-center" src="" alt="Tu imagen aquí">
                                    <img id="placeholder"
                                        class="has-mask h-36 object-center"
                                         src="https://img.freepik.com/free-vector/image-upload-concept-landing-page_52683-27130.jpg?size=338&ext=jpg"
                                         alt="freepik image">
                                    <div id="remove" class="hidden absolute top-0 right-0 bg-white font-bold rounded-br-full cursor-pointer text-red-500 p-2">X</div>
                                </div>
                                <p id="prompt" class="pointer-none text-gray-500 "><span class="text-sm">Arrastre el</span> comprobante aqui <br/> </p>
                            </div>
                            <input name="comprobante" id="fileInput" type="file" cclass="opacity-0 absolute" required>
                        </label>
                    </div>
                </div>
                <p class="text-sm text-gray-300">
                    <span>Tipos de archivos aceptados: doc,pdf o imagenes</span>
                </p>
                <div>
                    <button type="submit"
                       class="mt-5 flex items-center justify-center w-64 border border-transparent focus:outline-none bg-nissan hover:opacity-80 text-md uppercase hover:underline p-3 text-white text-center mx-4">
                        enviar comprobante
                    </button>
                </div>
            </div>
        </div>


    </form>


</x-front-layout>

