@push('styles')
    <style>

        #signUpForm {
            max-width: 1000px;
        }

        #signUpForm .form-header .stepIndicator.active {
            font-weight: 600;
        }

        #signUpForm .form-header .stepIndicator.finish {
            font-weight: 600;
            color: #c3002f;
        }

        #signUpForm .form-header .stepIndicator::before {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            z-index: 9;
            width: 20px;
            height: 20px;
            background-color: #f5ced7;
            border-radius: 50%;
            border: 3px solid #f7dfe4;
        }

        #signUpForm .form-header .stepIndicator.active::before {
            background-color: #e02855;
            border: 3px solid #f5ced7;
        }

        #signUpForm .form-header .stepIndicator.finish::before {
            background-color: #c3002f;
            border: 3px solid #f5ced7;
        }

        #signUpForm .form-header .stepIndicator::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 8px;
            width: 100%;
            height: 3px;
            background-color: #f3f3f3;
        }

        #signUpForm .form-header .stepIndicator.active::after {
            background-color: #e02855;
        }

        #signUpForm .form-header .stepIndicator.finish::after {
            background-color: #c3002f;
        }

        #signUpForm .form-header .stepIndicator:last-child:after {
            display: none;
        }

        #signUpForm input.invalid {
            border: 2px solid #ffaba5;
        }

        #signUpForm .step {
            display: none;
        }
    </style>
@endpush
@push('script')
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("step");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").style.display = "none";
            } else {
                document.getElementById("nextBtn").style.display = "inline";
                document.getElementById("nextBtn").innerHTML = "<span style='float: left'>continuar</span> <span style='font-weight: bold; font-size: 20px; float: right;display: inline-block; margin-top: -3px'> > </span>";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("step");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("signUpForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("step");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("stepIndicator");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
    </script>
@endpush

<x-front-layout>


    <section class="bg-white mb-[100px] mt-[20px]">


        <form id="signUpForm" class="mx-auto mb-8" action="#!">
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
                <div class="mb-6">
                    <label for="models"
                           class="font-bold block mb-2 text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Modelo</label>
                    <select id="models"
                            name="models"
                            class="border border-black text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3 uppercase"
                            required>
                        <option value="">Selecciona un modelo</option>
                        <option>Kicks</option>
                        <option>Qashqai</option>
                        <option>X-trail</option>
                        <option>Murano</option>
                        <option>Patrol</option>
                        <option>Patrol V8</option>
                        <option>March</option>
                        <option>Versa</option>
                        <option>Sentra</option>
                        <option>Frontier Pro-4x</option>
                        <option>Frontier</option>
                        <option>Frontier Cs</option>
                        <option>Urvan</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="grade"
                           class="font-bold block mb-2 text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Modelo</label>
                    <select id="grade"
                            name="grade"
                            class="border border-black text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3 uppercase"
                            required>
                        <option value="">Selecciona un grado</option>
                        <option>Sense</option>
                        <option>Advance MT</option>
                        <option>Advance CVT</option>
                        <option>Exclusive</option>
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
                                        <option>United States</option>
                                        <option>Canada</option>
                                        <option>France</option>
                                        <option>Germany</option>
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
                                    <select id="city" name="city" id="city"
                                            class="border border-black text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3"
                                            required style="width: 25%; float: right">
                                        <option value="">EXT</option>
                                        <option>United States</option>
                                        <option>Canada</option>
                                        <option>France</option>
                                        <option>Germany</option>
                                    </select>
                                </div>
                            </div>



                            <div class="sm:col-span-3">
                                <label for="showroom"
                                       class="font-bold block mb-2 text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Showroom</label>
                                <div class="mt-2">
                                    <select id="showroom" name="showroom" id="showroom"
                                            class="border border-black text-gray-900 focus:ring-black focus:border-black block w-full px-2.5 py-3"
                                            required>
                                        <option>United States</option>
                                        <option>Canada</option>
                                        <option>France</option>
                                        <option>Germany</option>
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
                                        <input id="testDrive" name="testDrive" type="checkbox"
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
                    <button type="button"
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
