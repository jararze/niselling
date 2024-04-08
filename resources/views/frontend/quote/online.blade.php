@push('styles')

@endpush
@push('script')
    <script>
        window.onload = function() {
            var onlineRadio = document.getElementById('payment-online');
            var transferRadio = document.getElementById('payment-transfer');

            onlineRadio.addEventListener('change', function() {
                document.getElementById('bank_accounts').classList.add('hidden');
            });

            transferRadio.addEventListener('change', function() {
                document.getElementById('bank_accounts').classList.remove('hidden');
            });
        };
    </script>
@endpush

<x-front-layout>

    <div id="spinner" class="spinner-overlay hidden">
        <div class="spinner"></div>
    </div>

    <div
        class="relative w-full max-w-screen-xl px-1 py-8 mx-auto lg:grid lg:grid-cols-1 lg:gap-16 xl:gap-16 lg:py-4 border-t-2"
        style="width: 80%">
        <h2 class="mt-3 text-3xl tracking-tight text-gray-900 md:text-3xl uppercase">forma de pago</h2>
        <div class="absolute bottom-0 left-[10.4%] w-[7%] h-1 bg-nissan transform -translate-x-[145%]"></div>
    </div>

    <form id="signUpForm" class="mx-auto mb-8" action="{{ route('frontend.bank.transfer') }}" method="POST">
        @csrf
        <input type="hidden" value="{{ $id }}" name="id">
        <div class="mx-auto" style="width: 80%">
            <div class="flex mx-auto mt-10" style="width: 300px">
                <div class="flex-grow mx-auto">

                    <div class="flex justify-between">
                        <div class="sm:col-span-3">
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                    <input id="payment-online" name="payment" type="radio" value="0"
                                           class="h-6 w-6 rounded border-gray-300 text-nissan focus:ring-nissan">
                                </div>
                                <div class="leading-6">
                                    <label for="payment-online" class="">Pago online</label>
                                </div>
                            </div>
                            <p style="font-size: 12px" class="mt-3">Pague su reserva con tarjetas VISA, Mastercard, QR
                                Simple, Tigo Money y más, mediante la pasarela de pagos Libélula.</p>
                        </div>
                    </div>

                    <div class="flex justify-between mt-10">
                        <div class="sm:col-span-3">
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                    <input id="payment-transfer" name="payment" type="radio" value="1"
                                           class="h-6 w-6 rounded border-gray-300 text-nissan focus:ring-nissan">
                                </div>
                                <div class="leading-6">
                                    <label for="payment-transfer" class="">Transferencia Bancaria</label>
                                </div>
                            </div>
                            <p style="font-size: 12px" class="mt-3">Será necesario que adjunte el comprobante de
                                transferencia.</p>
                        </div>
                    </div>

                    <div class="flex justify-between mt-10 hidden" id="bank_accounts">
                        <div class="">
                            <div class="items-center">
                                <div class="border px-3 " style="width: 300px; font-size: 11px">
                                    <div class="border-b py-3">
                                        <p><strong>Banco:</strong>Banco Bisa</p>
                                        <p><strong>Tipo de cuenta:</strong>Caja de ahorros (Bs.)</p>
                                        <p><strong>Nombre:</strong>Taiyo Motors S.A.</p>
                                        <p><strong>Nit:</strong>1020727020</p>
                                        <p><strong>Nro. de cuenta:</strong>1161090014</p>
                                    </div>
                                    <div class="border-b py-3">
                                        <p><strong>Banco:</strong>Banco Mercantil Santa Cruz</p>
                                        <p><strong>Tipo de cuenta:</strong>Caja de ahorros (Bs.)</p>
                                        <p><strong>Nombre:</strong>Taiyo Motors S.A.</p>
                                        <p><strong>Nit:</strong>1020727020</p>
                                        <p><strong>Nro. de cuenta:</strong>4010395477</p>
                                    </div>
                                    <div class="border-b py-3">
                                        <p><strong>Banco:</strong>Banco Nacional de Bolivia</p>
                                        <p><strong>Tipo de cuenta:</strong>Caja de ahorros (Bs.)</p>
                                        <p><strong>Nombre:</strong>Taiyo Motors S.A.</p>
                                        <p><strong>Nit:</strong>1020727020</p>
                                        <p><strong>Nro. de cuenta:</strong>1000163852</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="flex flex-col items-center mx-auto mt-10" style="width: 500px; text-align: center">
                <p style="font-size: 12px" class="mt-3">* El grado y color seleccionado están sujetos a disponibilidad.
                    No se preocupe, ante cualquier inconformidad usted podrá acceder a un reembolso.</p>
                <p style="font-size: 12px; text-align: center" class="mt-3"><a href="https://www.nissan.com.bo/terminos-condiciones.html" target="_blank">Ver nuestros terminos y
                        condiciones.</a></p>
            </div>

            <div class="flex flex-col items-center mx-auto mt-10 " style="width: 80%">
                <button type="submit"
                   class="mt-5 flex items-center justify-center w-64 border border-transparent focus:outline-none bg-nissan hover:opacity-80 text-md uppercase hover:underline p-3 text-white text-center mx-4">
                    reservar con $us 200
                </button>
            </div>


            <div class="flex flex-col items-center mx-auto mt-10" style="width: 500px; text-align: center">
                <p style="font-size: 12px" class="mt-3">Una vez finalizado el proceso de pago, un Asesor Profesional de
                    Ventas se pondrá en contacto con usted para confirmar su reserva.</p>
                <p style="font-size: 12px; text-align: center" class="mt-3"><a
                        href="{{ route('frontend.quote.final.proform', $id) }}">VOLVER</a></p>
            </div>


        </div>
    </form>


</x-front-layout>

