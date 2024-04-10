@push('styles')
    <style>
        .color-button:hover {
            cursor: pointer;
        }

        .gradient-bg::after {
            content: "";
            display: block;
            background: transparent linear-gradient(180deg, transparent, rgba(0, 0, 0, .6)) 0 0 no-repeat padding-box;
            border-radius: 50%; /* This is to ensure the gradient follows the circle shape of the button */
        }

        .spinner-overlay {
            position: fixed; /* Full-page overlay */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Black background with opacity */
            display: flex;
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
            z-index: 1000; /* Make sure it's on top of other elements */
        }

        .spinner {
            border: 5px solid #f3f3f3; /* Light grey */
            border-top: 5px solid #c3002f; /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
@push('script')
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            submitEndpoint: '{{ route("frontend.getModels.second", ":id") }}',
            showroomEndpoint: '{{ route("frontend.getShowrooms", ":id") }}',
            gradesEndpoint: '{{ route("frontend.getGrades.second", ":id") }}',
            imagePath: '{{ asset('storage/vehicles/') }}',
        };
    </script>
    <script src="{{ asset('backend/assets/js/frontend/selectLoader2.js') }}"></script>
@endpush

<x-front-layout>

    <section class="bg-white mb-[100px] mt-[20px]">

        <div id="spinner" class="spinner-overlay hidden">
            <div class="spinner"></div>
        </div>
        <form id="signUpForm" class="mx-auto mb-8" action="{{ route('frontend.quote.store.final') }}" method="POST">
            @csrf
            <div
                class="relative w-full max-w-screen-xl px-1 py-8 mx-auto lg:grid lg:grid-cols-1 lg:gap-16 xl:gap-16 lg:py-4 border-t-2"
                style="width: 80%">
                <h2 class="mt-3 text-3xl tracking-tight text-gray-900 md:text-3xl uppercase">COTIZACIÓN ONLINE</h2>
                <div class="absolute bottom-0 left-[10.4%] w-[7%] h-1 bg-nissan transform -translate-x-[145%]"></div>
            </div>

            <div
                class="relative w-full max-w-screen-xl px-1 py-8 mx-auto lg:grid lg:grid-cols-1 lg:gap-16 xl:gap-24 lg:py-4 md:mb-[70px] mb-0"
                style="width: 80%">
                <h4 class="mt-1 text-1xl uppercase">ELIGE TU MODELO, GRADO, COLOR Y PULSA SIGUIENTE PARA OBTENER TU
                    PROFORMA</h4>
            </div>

            <div class="mx-auto md:w-4/5 w-full" sstyle="width: 80%">
                <div class="flex flex-col md:flex-row">
                    <div class="w-full md:flex-grow md:w-7/10 pb-4 md:pb-0" sstyle="flex-basis: 70%;">
                        <div class="flex flex-col md:flex-row justify-evenly md:justify-between mx-auto" style="max-width: 960px;">
                            <label for="models"></label>
                            <select id="models"
                                    name="models"
                                    class="mx-auto border border-black text-gray-900 focus:ring-black focus:border-black block w-80 px-2.5 py-3 uppercase my-4 md:my-0"
                                    required>
                                <option value="0">Selecciona un modelo</option>
                                @php $selected_model = $quote->model; @endphp
                                @foreach($models as $model)
                                    <option
                                        value="{{$model->id}}" {{ ($selected_model == $model->id) ? 'selected' : '' }}>{{$model->name}}</option>
                                @endforeach
                            </select>
                            <label for="grade"></label>
                            <select id="grade"
                                    name="grade"
                                    class="mx-auto border border-black text-gray-900 focus:ring-black focus:border-black block w-80 px-2.5 py-3 uppercase"
                                    required>
                                @php $selected_grade = $quote->grade; @endphp
                                @foreach($grades as $grade)
                                    <option
                                        value="{{$grade->id}}" {{ ($selected_grade == $grade->id) ? 'selected' : '' }}>{{$grade->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="flex justify-center md:justify-between mt-10">
                            <img id="carImage"
                                 src="{{ asset('storage/vehicles/'.$quote->modelOfCar->slug .'/'.$quote->modelOfCar->image) }}"
                                 alt="{{ $quote->modelOfCar->name }}">
                        </div>

                        <div class="flex flex-col items-center justify-center">
                            <div class="flex flex-wrap justify-center items-center space-x-2 space-y-8" id="colorContainer">

                                @if(!empty($colors))
                                    @foreach($colors as $key => $color)
                                        @php
                                            $escaped_code = e($color->color_code);
                                            $escaped_name = e($color->name);
                                        @endphp
                                        <div class="flex flex-col items-center justify-center relative {{ $key == 0 ? 'mt-8' : 'mt-2' }}">
                                            <span
                                                class="absolute text-sm text-center mb-2 hidden title top-[-2rem] "
                                                id="{{ $escaped_code }}">{{ $first_word = explode(' ', trim($escaped_name))[0] }}</span>
                                            <a class="w-12 h-12 rounded-full focus:outline-none color-button"
                                               data-color-code="{{ $escaped_code }}"
                                               data-img-url="{{ asset('storage/vehicles/'. $quote->modelOfCar->slug . "/" . $color->image) }}"
                                               href="#"
                                               title="{{ $escaped_name }}"
                                               style=" background: linear-gradient(45deg, {{ $escaped_code }}, #333333); "></a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <input type="hidden" id="selected_color" name="selected_color"
                                   value="{{ $colors[0]->color_code }}"/>
                            <input type="hidden" id="quote_id" name="quote_id" value="{{ $quote->id }}"/>
                            <p class="uppercase text-center mt-5 text-xs">selecciona el color deseado</p>
                        </div>


                    </div>
                    <div class="w-full md:flex-grow md:w-3/10  md:text-left mx-auto md:mx-0 text-center" style="flex-basis: 30%;">
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

                        <div class="flex justify-center md:justify-between mt-10">
                            <a id="data_sheet_span" target="_blank" href="{{ $quote->modelOfCar->data_sheet }}"
                               class="w-4/5 md:w-full mx-auto uppercase py-3 px-3 bg-gray-300 hover:bg-gray-500 flex justify-between text-sm leading-6">
                                <span class="font-thin">descargar ficha técnica</span>
                                <span class="font-bold text-xl mt-[-3px]"> > </span>
                            </a>
                        </div>

                        <div class="justify-between mt-10">
                            <div class="w-full border border-[#eeeeee] bg-white p-3 md:text-right text-center text-sm">
                                <p class="text-gray-600">Precio</p>
                                <p class="font-bold">$us. <span
                                        id="price_span">{{ number_format($quote->gradeOfCar->price, 2) }} </span></p>
                            </div>
                            <div class="w-full border border-[#eeeeee] bg-white p-3 md:text-right text-center text-sm">
                                <p class="text-gray-600">Descuento</p>
                                <p class="font-bold">$us. <span
                                        id="discount_span">{{ number_format($quote->gradeOfCar->discount, 2) }} </span>
                                </p>
                            </div>
                            <div class="w-full border border-[#eeeeee] bg-white p-3 md:text-right text-center text-sm">
                                <p class="text-gray-600">Costos Adicionales</p>
                                <p class="font-bold">$us. <span
                                        id="aditional_costs_span">{{ number_format($quote->gradeOfCar->discount, 2) }} </span>
                                </p>
                            </div>
                            <div class="w-full border border-[#eeeeee] bg-white p-3 md:text-right text-center text-sm">
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

            <div class="mx-auto mt-10 w-full md:w-[450px]">

                <button type="submit"
                        class="flex items-center justify-between w-1/3 mx-auto border border-transparent focus:outline-none bg-nissan hover:opacity-50 text-md uppercase p-3 text-white text-center">
                    <span class="px-0 md:px-3">Siguiente</span>
                    <span class="font-bold text-2xl -mt-1 ml-5 md:ml-0">></span>
                </button>
                <p class="uppercase text-center mt-5 text-xs">pulse el boton para ver proforma</p>

            </div>


            <div class="mx-auto mt-12 bg-[#eeeeee] p-10" style="width: 80%">

                <div
                    class="relative w-full max-w-screen-xl px-1 mx-auto lg:grid lg:grid-cols-1 lg:gap-16 xl:gap-16">
                    <h2 class="mt-3 text-3xl tracking-tight text-gray-900 md:text-3xl pb-3 uppercase">DATOS DE LA
                        PROFORMA</h2>
                    <div
                        class="absolute bottom-0 left-[10.4%] w-[7%] h-1 bg-nissan transform -translate-x-[145%]"></div>
                </div>

                <div class="grid grid-cols-3 gap-4 text-sm mt-5 p-2">
                    <div class="col-span-1 border p-2 text-bold"><strong>Proforma a nombre de:</strong></div>
                    <div class="col-span-2 border p-2">{{ $quote->name . " " . $quote->last_name }}</div>
                    <div class="col-span-1 border p-2"><strong>Cédula de identidad:</strong></div>
                    <div class="col-span-2 border p-2">{{ $quote->dni }} {{ $quote->ext }}</div>
                    <div class="col-span-1 border p-2"><strong>Fecha de proforma:</strong></div>
                    <div class="col-span-2 border p-2">{{ $quote->created_at }}</div>
                    <div class="col-span-1 border p-2"><strong>Ciudad:</strong></div>
                    <div class="col-span-2 border p-2">{{ $quote->cityOfCar->name }}</div>
                </div>


            </div>


        </form>


        <div class="mx-auto mt-10" style="width: 80%">

            <p class="uppercase text-center mt-5 text-xs"><a
                    href="{{ route('frontend.quote_second.show', $quote->id) }}"
                    class="uppercase text-center mt-5 text-xs hover:underline">Cambiar datos de proforma</a></p>

        </div>


    </section>
</x-front-layout>
