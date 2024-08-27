@push('styles')

@endpush
@push('script')

@endpush

<x-front-layout>

    <div id="spinner" class="spinner-overlay hidden">
        <div class="spinner"></div>
    </div>

    <div
        class="relative w-full max-w-screen-xl px-1 py-8 mx-auto lg:grid lg:grid-cols-1 lg:gap-16 xl:gap-16 lg:py-4 border-t-2"
        style="width: 80%">
        <h2 class="mt-3 text-3xl tracking-tight text-gray-900 md:text-3xl uppercase">Pago online</h2>
        <div class="absolute bottom-0 left-[10.4%] w-[7%] h-1 bg-nissan transform -translate-x-[145%]"></div>
    </div>

    <form id="signUpForm" class="mx-auto mb-8" action="{{ route('frontend.quote.libelula.transfer') }}" method="POST">
        @csrf

        <!-- component -->
        <div
            class="relative  flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-white bg-no-repeat bg-cover">
            <div class="sm:max-w-lg w-full bg-white rounded-xl z-10 px-20">
                <div class="grid grid-cols-1 space-y-2">
                    <label for="name"
                           class="font-bold block mb-2 text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Monto
                        de reserva</label>
                    <div class="mt-2">
                        <input type="hidden" value="{{ $id }}" name="id">
                        <input type="text" name="name" id="name" autocomplete="given-name"
                               value="1394 Bs"
                               class="border-[#eeeeee] bg-[#eeeeee] text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3"
                               readonly
                               placeholder=""
                               required/>
                    </div>
                    <p style="font-size: 12px;" class="mt-3">Al presionar el botón, usted será redirigido a la pasarela de pagos Libélula. Todos los canales de pago disponibles en Libélula son supervisados por la ASFI.</p>
                </div>
                <div>
                    <button type="submit"
                            class="mt-5 flex items-center justify-center w-64 border border-transparent focus:outline-none bg-nissan hover:opacity-80 text-md uppercase hover:underline p-3 text-white text-center mx-4">
                        Realizar pago
                    </button>
                </div>
            </div>
        </div>


    </form>


</x-front-layout>

