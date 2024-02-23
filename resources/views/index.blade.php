@push('styles')
    <style>
        #signUpForm {
            max-width: 500px;
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
                document.getElementById("nextBtn").innerHTML = "Quiero ser contactado";
            } else {
                document.getElementById("nextBtn").innerHTML = "continuar";
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

        <div class="relative w-full max-w-screen-xl px-4 py-8 mx-auto lg:grid lg:grid-cols-1 lg:gap-16 xl:gap-24 lg:py-4 lg:px-6 border-t-2 mb-[70px]">
            <h2 class="mt-3 text-3xl tracking-tight text-gray-900 md:text-3xl ">SOLICITUD DE CONTACTO / RESERVA DE VEHÍCULO</h2>
            <div class="absolute bottom-0 left-[10.6%] w-[6%] h-1.5 bg-nissan transform -translate-x-[145%]"></div>
        </div>


        <form id="signUpForm" class="mx-auto mb-8" action="#!">
            <!-- start step indicators -->
            <div class="form-header flex gap-3 text-xs text-center mb-[50px]">
                <span class="stepIndicator flex-1 pb-8 relative">1</span>
                <span class="stepIndicator flex-1 pb-8 relative">2</span>
            </div>
            <!-- end step indicators -->

            <!-- step one -->
            <div class="step">
                <div class="mb-6">
                    <label for="countries" class="font-bold block mb-2 text-sm font-medium text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Modelo</label>
                    <select id="countries" class="bg-[#efefef] border border-[#efefef] text-gray-900 text-sm focus:ring-black focus:border-black block w-full px-2.5 py-4">
                        <option>United States</option>
                        <option>Canada</option>
                        <option>France</option>
                        <option>Germany</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="countries" class="font-bold block mb-2 text-sm font-medium text-gray-900  after:content-['*'] after:ml-0.5 after:text-nissan ">Grado</label>
                    <select id="countries" class="bg-[#efefef] border border-[#efefef] text-gray-900 text-sm focus:ring-black focus:border-black block w-full px-2.5 py-4">
                        <option>United States</option>
                        <option>Canada</option>
                        <option>France</option>
                        <option>Germany</option>
                    </select>
                </div>
                <div class="mb-6">
                    <p class="text-nissan font-bold">* Campos obligatorios</p>
                </div>
            </div>

            <!-- step two -->
            <div class="step">
                <p class="text-md text-gray-700 leading-tight text-center mt-8 mb-5">Your presence on the social network</p>
                <div class="mb-6">
                    <input type="text" placeholder="Linked In" name="linkedin"
                           class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'" />
                </div>
                <div class="mb-6">
                    <input type="text" placeholder="Twitter" name="twitter"
                           class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'" />
                </div>
                <div class="mb-6">
                    <input type="text" placeholder="Facebook" name="facebook"
                           class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'" />
                </div>
            </div>


            <!-- start previous / next buttons -->
            <div class="form-footer flex gap-3">
                <button type="button" id="prevBtn" class="flex-1 focus:outline-none border border-gray-300 py-2 px-5 shadow-sm text-center text-gray-700 bg-white hover:bg-gray-100 text-md uppercase" onclick="nextPrev(-1)">Volver</button>
                <button type="button" id="nextBtn" class="flex-1 border border-transparent focus:outline-none p-3  text-center text-white bg-nissan hover:opacity-50 text-md uppercase" onclick="nextPrev(1)">Continuar</button>
            </div>
            <!-- end previous / next buttons -->
        </form>

    </section>













</x-front-layout>
