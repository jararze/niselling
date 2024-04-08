@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/wizzard.css') }}">
@endpush
@push('script')

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            submitEndpoint: '{{ route("frontend.getGrades", ":id") }}',
            showroomEndpoint: '{{ route("frontend.getShowrooms", ":id") }}',
        };
    </script>

    <script src="{{ asset('backend/assets/js/frontend/wizzard.js') }}"></script>
    <script src="{{ asset('backend/assets/js/frontend/selectLoader.js') }}"></script>
@endpush

<x-front-layout>


    <section class="bg-white mb-[100px] mt-[20px]">

        <div id="spinner" class="spinner-overlay" style="display: none;">
            <div class="spinner"></div>
        </div>
        <form id="signUpForm" class="mx-auto mb-8" action="{{ route('frontend.quote.save') }}" method="POST">
            @csrf
            <!-- start step indicators -->
            <div class="form-header flex gap-3 text-xs text-center mb-[50px]">
                <span class="stepIndicator flex-1 pb-8 relative">1</span>
                <span class="stepIndicator flex-1 pb-8 relative">2</span>
            </div>
            <!-- end step indicators -->

            <div
                class="relative w-full max-w-screen-xl px-1 py-8 mx-auto lg:grid lg:grid-cols-1 lg:gap-16 xl:gap-24 lg:py-4 border-t-2 mb-[70px]">
                <h2 class="mt-3 text-3xl tracking-tight text-gray-900 md:text-3xl uppercase">Cotiza en línea</h2>
                <div class="absolute bottom-0 left-[10.4%] w-[7%] h-1 bg-nissan transform -translate-x-[145%]"></div>
            </div>

            <!-- step one -->
            <div class="step mx-auto" style="width: 400px">
                <div class="mb-6" x-data="{ selected: false }">
                    <label for="models"
                           class="font-bold block mb-2 text-gray-900 after:content-['*'] after:ml-0.5 after:text-nissan">
                        Modelo
                        <span x-show="selected" class="text-green ml-2" style="color: #00A261">&#10003;</span>
                    </label>
                    <select id="models"
                            name="models"
                            x-on:change="selected = $event.target.value !== '0'"
                            x-on:focus="focus = true"
                            x-on:blur="focus = false"
                            x-bind:class="{ 'outline-none ring-2 ring-green-800 border-green-900': selected, 'focus:outline-none focus:ring-2 focus:ring-green-800 focus:border-green-900': focus }"
                            class="border border-black text-gray-900 !focus-within:border-green-500 block w-full px-2.5 py-3 uppercase"
                            required>
                        <option value="0">Selecciona un modelo</option>
                        @foreach($models as $model)
                            <option value="{{$model->id}}">{{$model->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6" x-data="{isSelected: false, focus:false}">
                    <label for="grade"
                           class="font-bold block mb-2 text-gray-900 after:content-['*'] after:ml-0.5 after:text-nissan">
                        Grado
                        <span x-show="isSelected" class="text-green ml-2" style="color: #00A261">&#10003;</span>
                        <!-- This checkmark will appear next to label text -->
                    </label>
                    <select
                        id="grade"
                        name="grade"
                        class="border !focus-within:border-green-500 border-black text-gray-900 block w-full px-2.5 py-3 uppercase"
                        required
                        x-on:change="isSelected = $event.target.value !== ''"
                        x-on:focus="focus = true"
                        x-on:blur="focus = false"
                        x-bind:class="{ 'border-green-900 ring-2 ring-green-800': isSelected, 'focus:outline-none focus:ring-2 focus:ring-green-800 focus:border-green-900': focus }">
                        <option value="">Selecciona un grado</option>
                        <!-- Add other options here -->
                    </select>
                </div>
                <div class="mb-6">
                    <p class="text-nissan text-sm">* Campos obligatorios</p>
                </div>
            </div>

            <!-- step two -->
            <div class="step">
                <div class="space-y-12">

                    <div class="border-b border-gray-900/10 pb-12">

                        <div class="mt-10 grid grid-cols-1 gap-x-40 gap-y-4 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="name"
                                       class="font-bold block mb-2 text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Nombre</label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name" autocomplete="given-name"
                                           class="border border-black text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3"
                                           placeholder="Primer Nombre" required/>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="phone"
                                       class="font-bold block mb-2 text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Celular</label>
                                <div class="mt-2">
                                    <input type="tel" name="phone" id="phone" autocomplete="given-cellphone"
                                           class="border border-black text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3"
                                           placeholder="Número de teléfono celular" pattern="[0-9]{8}" required/>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="last-name"
                                       class="font-bold block mb-2 text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Apellido</label>
                                <div class="mt-2">
                                    <input type="text" name="last-name" id="last-name" autocomplete="given-last-name"
                                           class="border border-black text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3"
                                           placeholder="Primer Apellido" required/>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="city"
                                       class="font-bold block mb-2 text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Ciudad</label>
                                <div class="mt-2">
                                    <select id="city" name="city" id="city"
                                            class="border border-black text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3"
                                            required>
                                        <option value="0">Selecciona una ciudad</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="dni"
                                       class="font-bold block mb-2 text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Carnet
                                    de Identidad</label>
                                <div class="mt-2">
                                    <input type="number" name="dni" id="dni" autocomplete="given-dni"
                                           class="border border-black text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3"
                                           placeholder="Número de CI" required style="width: 70%; float: left"/>
                                    <select id="ext" name="ext" id="ext"
                                            class="border border-black text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3"
                                            required style="width: 25%; float: right">
                                        <option value="">EXT</option>
                                        <option label="BN" value="BN">BN</option>
                                        <option label="CB" value="CB">CB</option>
                                        <option label="CH" value="CH">CH</option>
                                        <option label="LP" value="LP">LP</option>
                                        <option label="OR" value="OR">OR</option>
                                        <option label="PA" value="PA">PA</option>
                                        <option label="PT" value="PT">PT</option>
                                        <option label="SC" value="SC">SC</option>
                                        <option label="TJ" value="TJ">TJ</option>
                                    </select>
                                </div>
                            </div>


                            <div class="sm:col-span-3">
                                <label for="showroom"
                                       class="font-bold block mb-2 text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Showroom</label>
                                <div class="mt-2">
                                    <select id="showroom" name="showroom"
                                            class="border border-black text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3"
                                            required>
                                        <option value="">Selecciona una ciudad</option>
                                    </select>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="email"
                                       class="font-bold block mb-2 text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Email</label>
                                <div class="mt-2">
                                    <input type="email" name="email" id="email" autocomplete="given-email"
                                           class="border border-black text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3"
                                           placeholder="Correo Electrónico" required/>
                                </div>
                            </div>


                            <div class="sm:col-span-3">
                                <div class="relative flex gap-x-3 mt-10">
                                    <div class="flex h-6 items-center">
                                        <input id="testDrive" name="testDrive" type="checkbox" value="1"
                                               class="h-5 w-5 rounded border-gray-300 text-nissan focus:ring-nissan">
                                    </div>
                                    <div class="leading-6">
                                        <label for="testDrive" class="">¿Requiere un test drive?</label>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    {{--                    <div class="border-b border-gray-900/10 pb-5">--}}
                    {{--                        <div class="sm:col-span-6">--}}
                    {{--                            <div--}}
                    {{--                                class="relative w-full max-w-screen-xl px-1 py-8 mx-auto lg:grid lg:grid-cols-1 lg:gap-16 xl:gap-24 lg:py-4 border-t-2 ">--}}
                    {{--                                <h2 class="mt-3 text-3xl tracking-tight text-gray-900 md:text-3xl ">¿CÓMO DESEA SER--}}
                    {{--                                    CONTACTADO? <span class="text-nissan">*</span></h2>--}}
                    {{--                                <div--}}
                    {{--                                    class="absolute bottom-0 left-[9%] w-[6%] h-1.5 bg-nissan transform -translate-x-[145%]"></div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}

                    {{--                        <div class="space-y-10 mb-5">--}}
                    {{--                            <fieldset>--}}
                    {{--                                <div class="mt-6 space-y-6">--}}
                    {{--                                    <div class="relative flex gap-x-3">--}}
                    {{--                                        <div class="flex h-6 items-center">--}}
                    {{--                                            <input id="whatsapp" name="whatsapp" type="checkbox"--}}
                    {{--                                                   class="h-5 w-5 rounded border-gray-300 text-nissan focus:ring-nissan">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="text-sm leading-6">--}}
                    {{--                                            <label for="whatsapp" class="">Whatsapp</label>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="relative flex gap-x-3">--}}
                    {{--                                        <div class="flex h-6 items-center">--}}
                    {{--                                            <input id="email2" name="email2" type="checkbox"--}}
                    {{--                                                   class="h-5 w-5 rounded border-gray-300 text-nissan focus:ring-nissan">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="text-sm leading-6">--}}
                    {{--                                            <label for="email2" class="">Correo electrónico</label>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="relative flex gap-x-3">--}}
                    {{--                                        <div class="flex h-6 items-center">--}}
                    {{--                                            <input id="call" name="call" type="checkbox"--}}
                    {{--                                                   class="h-5 w-5 rounded border-gray-300 text-nissan focus:ring-nissan">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="text-sm leading-6">--}}
                    {{--                                            <label for="call" class="">Llamada telefónica</label>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </fieldset>--}}
                    {{--                        </div>--}}

                    {{--                        <div class="mb-6">--}}
                    {{--                            <p class="text-nissan font-bold">* Campos obligatorios</p>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit"
                            class="flex border border-transparent focus:outline-none p-3  text-center text-white bg-nissan hover:opacity-50 text-md uppercase mx-auto"
                            style="width: 500px; display: block; width: 35% !important;">ver cotizacion online
                    </button>
                </div>
            </div>


            <!-- start previous / next buttons -->
            <div class="form-footer flex gap-3">
                <button type="button" id="prevBtn"
                        class="flex-1 py-2 px-5 mt-10 text-center text-gray-700 hover:underline text-md uppercase"
                        onclick="nextPrev(-1)">Volver
                </button>
                <button type="button" id="nextBtn"
                        class="flex border border-transparent focus:outline-none p-3  text-center text-white bg-nissan hover:opacity-50 text-md uppercase mx-auto"
                        style="width: 500px; display: block; width: 30% !important;" onclick="nextPrev(1)">Continuar >
                </button>
            </div>
            <!-- end previous / next buttons -->
        </form>

    </section>


</x-front-layout>
