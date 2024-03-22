@push('styles')

@endpush
@push('script')

@endpush

<x-front-layout>

    <div id="spinner" class="spinner-overlay hidden">
        <div class="spinner"></div>
    </div>

{{--    <form id="signUpForm" class="mx-auto mb-8" action="{{ route('frontend.quote.store.final') }}" method="POST">--}}
{{--        @csrf--}}
        <div
            class="relative w-full max-w-screen-xl px-1 py-8 mx-auto lg:grid lg:grid-cols-1 lg:gap-16 xl:gap-16 lg:py-4 border-t-2"
            style="width: 80%">
            <h2 class="mt-3 text-3xl tracking-tight text-gray-900 md:text-3xl uppercase">PROFORMA</h2>
            <div class="absolute bottom-0 left-[10.4%] w-[7%] h-1 bg-nissan transform -translate-x-[145%]"></div>
        </div>

        <div
            class="relative w-full max-w-screen-xl px-1 py-8 mx-auto  lg:grid-cols-1 lg:gap-16 xl:gap-24 lg:py-4"
            style="width: 80%">
            <h4 class="mt-1 text-3xl uppercase">{{ $quote->modelOfCar->name }}</h4>
            <h4 class="text-1xl uppercase">{{ $quote->gradeOfCar->name }}</h4>
        </div>

        <div class="mx-auto" style="width: 80%">
            <div class="flex">
                <div class="flex-grow" style="flex-basis: 70%;">

                    <div class="flex justify-between mt-10">
                        <img id="carImage" src="{{ asset('storage/vehicles/'.$quote->modelOfCar->slug .'/'.$quote->colorOfCar->image) }}" alt="{{ $quote->colorOfCar->name }}">
                        <input type="hidden" id="quote_id" name="quote_id" value="{{ $quote->id }}"/>
                    </div>

                </div>
                <div class="flex-grow" style="flex-basis: 30%; margin-top: -80px">
                    <div class="text-sm">
                        <p><strong>Cilindrada:</strong> <span
                                id="cylindered_span">{{ $quote->gradeOfCar->cylindered  }}</span></p>
                        <p><strong>Transmisión:</strong> <span
                                id="transmission_span">{{ $quote->gradeOfCar->transmission  }}</span></p>
                        <p><strong>Tracción:</strong> <span
                                id="traction_span">{{ $quote->gradeOfCar->traction  }}</span></p>
                        <p><strong>Año Comercial:</strong> <span
                                id="commercial_date_span">{{ $quote->gradeOfCar->commercial_date  }}</span></p>
                    </div>

                    <div class="flex justify-between mt-10">
                        <a id="data_sheet_span" target="_blank" href="{{ $quote->modelOfCar->data_sheet }}"
                           class="w-full uppercase py-3 px-3 bg-gray-300 hover:bg-gray-500 flex justify-between text-sm leading-6">
                            <span class="font-thin">descargar proforma</span>
                            <span class="font-bold text-xl mt-[-3px]"> > </span>
                        </a>
                    </div>

                    <div class="justify-between mt-10">
                        <div class="w-full border border-[#eeeeee] bg-white p-3 text-right text-sm">
                            <p class="text-gray-600">Precio</p>
                            <p class="font-bold">$us. <span
                                    id="price_span">{{ number_format($quote->gradeOfCar->price, 2) }} </span></p>
                        </div>
                        <div class="w-full border border-[#eeeeee] bg-white p-3 text-right text-sm">
                            <p class="text-gray-600">Descuento</p>
                            <p class="font-bold">$us. <span
                                    id="discount_span">{{ number_format($quote->gradeOfCar->discount, 2) }} </span>
                            </p>
                        </div>
                        <div class="w-full border border-[#eeeeee] bg-white p-3 text-right text-sm">
                            <p class="text-gray-600">Costos Adicionales</p>
                            <p class="font-bold">$us. <span
                                    id="aditional_costs_span">{{ number_format($quote->gradeOfCar->discount, 2) }} </span>
                            </p>
                        </div>
                        <div class="w-full border border-[#eeeeee] bg-white p-3 text-right text-sm">
                            <p class="text-gray-600">Precio Final</p>
                            <p class="font-bold text-nissan">
                                $us. <span
                                    id="final_price_span">{{ number_format(($quote->gradeOfCar->price - $quote->gradeOfCar->discount + $quote->gradeOfCar->discount), 2) }} </span>
                            </p>
                            <p class="font-thin text-[11px]">El precio incluye placas, registros definitivos y
                                SOAT.</p>
                        </div>
                    </div>


                </div>

            </div>
        </div>

        <div class="mx-auto mt-10 flex justify-center" style="width: 80%">
            <button type="submit" class="flex items-center justify-center w-64 border border-transparent focus:outline-none bg-nissan hover:opacity-80 text-md uppercase hover:underline p-3 text-white text-center mx-4">chatear por whatsapp</button>
            <button type="submit" class="flex items-center justify-center w-64 border border-transparent focus:outline-none bg-black hover:opacity-80 text-md uppercase hover:underline p-3 text-white text-center mx-4">reservar con $us 200</button>
            <button type="submit" class="flex items-center justify-center w-64 border border-transparent focus:outline-none bg-gray-300 hover:opacity-80 text-md uppercase hover:underline p-3 text-black text-center mx-4">solicitar llamada telefónica</button>
        </div>
        {{--            <p class="uppercase text-center mt-5 text-xs">pulse el boton para ver proforma</p>--}}


        <div class="mx-auto mt-12 bg-[#eeeeee] mb-[30px] p-10" style="width: 80%">

            <div
                class="relative w-full max-w-screen-xl px-1 mx-auto lg:grid lg:grid-cols-1 lg:gap-16 xl:gap-16">
                <h2 class="mt-3 text-3xl tracking-tight text-gray-900 md:text-3xl pb-3 uppercase">DATOS DE LA
                    PROFORMA</h2>
                <div
                    class="absolute bottom-0 left-[10.4%] w-[7%] h-1 bg-nissan transform -translate-x-[145%]"></div>
            </div>

            <div class="grid grid-cols-6 gap-4 text-sm mt-5 p-2">
                <div class="col-span-2 border p-2 text-bold"><strong>Proforma a nombre de:</strong> <br>{{ $quote->name . " " . $quote->last_name }}</div>
                <div class="col-span-2 border p-2"><strong>Número de Proforma:</strong> <br> {{ $quote->dni }} {{ $quote->ext }}</div>
                <div class="col-span-2 border p-2"><strong>Asesor Profesional de Ventas:</strong> <br> {{ $quote->dni }} {{ $quote->ext }}</div>
                <div class="col-span-2 border p-2"><strong>Cédula de identidad:</strong> <br> {{ $quote->dni }} {{ $quote->ext }}</div>
                <div class="col-span-2 border p-2"><strong>Fecha de proforma:</strong> <br> {{ $quote->created_at }}</div>
                <div class="col-span-2 border p-2"><strong>Celular APV:</strong> <br> {{ $quote->created_at }}</div>
                <div class="col-span-2 border p-2"><strong>Ciudad:</strong> <br> {{ $quote->cityOfCar->name }}</div>
                <div class="col-span-2 border p-2"><strong>Showroom:</strong> <br> {{ $quote->showroomOfCar->name }}</div>
                <div class="col-span-2 border p-2"><strong>Correo Electrónico APV:</strong> <br> {{ $quote->cityOfCar->name }}</div>
            </div>


        </div>
        {{--            <a href="{{ route('') }}" class="uppercase text-center mt-5 text-xs">Cambiar datos de proforma</a>--}}


{{--    </form>--}}

    <div class="mx-auto">
        <div class="flex">
            <div class="flex-grow" style="flex-basis: 80%;">

            </div>
        </div>

    </div>



</x-front-layout>
