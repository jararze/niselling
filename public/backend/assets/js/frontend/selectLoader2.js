document.addEventListener('DOMContentLoaded', function () {
    const modelSelect = document.getElementById('models');
    const grade = document.getElementById('grade');
    const spinner = document.getElementById('spinner');
    const city = document.getElementById('city');
    const showroom = document.getElementById('showroom');
    const cylindered_span = document.getElementById("cylindered_span");
    const transmission_span = document.getElementById("transmission_span");
    const traction_span = document.getElementById("traction_span");
    const commercial_date_span = document.getElementById("commercial_date_span");
    const price_span = document.getElementById("price_span");
    const discount_span = document.getElementById("discount_span");
    const aditional_costs_span = document.getElementById("aditional_costs_span");
    const final_price_span = document.getElementById("final_price_span");

    modelSelect.addEventListener('change', function () {
        const modelId = this.value;
        if (modelId == 0) {
            grade.innerHTML = '<option value="0">Seleccione un modelo primero.</option>';
        } else {
            spinner.style.display = 'flex'; // Show the spinner

            const EndPoint = window.Laravel.submitEndpoint.replace(':id', modelSelect.value);

            fetch(EndPoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    id: modelSelect.value,
                })
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("spinner").style.display = "none";

                    const select = document.getElementById("grade");
                    select.innerHTML = "<option selected>Seleccione un modelo primero.</option>";

                    Object.entries(data.grades).forEach(([key, value]) => {
                        const option = document.createElement("option");
                        option.value = key;
                        option.text = value;
                        select.appendChild(option);
                    });

                    var ModelName;
                    const imageElement = document.getElementById("carImage");
                    Object.entries(data.image).forEach(([key, value]) => {
                        ModelName = key;
                        imageElement.src = window.Laravel.imagePath + "/" + key +'/'+ value;

                    });

                    cylindered_span.innerHTML = "";
                    transmission_span.innerHTML = "";
                    traction_span.innerHTML = "";
                    commercial_date_span.innerHTML = "";
                    price_span.innerHTML = "";
                    discount_span.innerHTML = "";
                    aditional_costs_span.innerHTML = "";
                    final_price_span.innerHTML = "";


                    const colorContainer = document.getElementById("colorContainer");
                    colorContainer.innerHTML = "";
                    data.colors.forEach((color, index) => {
                        const colorDiv = document.createElement("div");
                        colorDiv.className = `flex flex-col items-center justify-center mt-8 relative`;

                        const colorSpan = document.createElement("span");
                        colorSpan.className = "absolute text-sm text-center mb-2 hidden title top-[-2rem]";
                        colorSpan.id = color.color_code;
                        colorSpan.innerText = color.name.trim().split(" ")[0];

                        const colorLink = document.createElement("a");
                        colorLink.className = "w-12 h-12 rounded-full focus:outline-none color-button"
                        colorLink.dataset.colorCode = color.color_code;

                        colorLink.dataset.imgUrl = window.Laravel.imagePath + "/" + ModelName + "/" +color.image;

                        colorLink.title = color.name;
                        colorLink.style.background = "linear-gradient(45deg, " + color.color_code + ", #333333)";

                        colorDiv.appendChild(colorSpan);
                        colorDiv.appendChild(colorLink);

                        colorContainer.appendChild(colorDiv);
                    });



                })
                .catch((error) => {
                    document.getElementById("spinner").style.display = "none";
                    console.error('Error:', error);
                });
        }
    });


    grade.addEventListener('change', function () {
        const modelId = this.value;

        if(modelId == 0){
            grade.innerHTML = '<option>Seleccione un modelo primero.</option>';
        } else{
            spinner.style.display = 'flex';

            const gradesEndPoint = window.Laravel.gradesEndpoint.replace(':id', grade.value);

            fetch(gradesEndPoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    id: grade.value,
                })
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("spinner").style.display = "none";


                    cylindered_span.innerHTML = "";
                    transmission_span.innerHTML = "";
                    traction_span.innerHTML = "";
                    commercial_date_span.innerHTML = "";
                    price_span.innerHTML = "";
                    discount_span.innerHTML = "";
                    aditional_costs_span.innerHTML = "";
                    final_price_span.innerHTML = "";

                    for(let grade of data){
                        cylindered_span.innerHTML = grade.cylindered;
                        transmission_span.innerHTML = grade.transmission;
                        traction_span.innerHTML = grade.traction;
                        commercial_date_span.innerHTML = grade.commercial_date;
                        price_span.innerHTML = parseFloat(grade.price).toLocaleString('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 });
                        discount_span.innerHTML = parseFloat(grade.discount).toLocaleString('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 });
                        aditional_costs_span.innerHTML = parseFloat(grade.discount).toLocaleString('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 });
                        final_price_span.innerHTML = parseFloat((grade.price + grade.discount - grade.discount)).toLocaleString('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 });

                        const data_sheet_span = document.getElementById("data_sheet_span");
                        data_sheet_span.href = grade.data_sheet;

                    }

                })
                .catch((error) => {
                    document.getElementById("spinner").style.display = "none";
                    console.error('Error:', error);
                });


        }


    });

    document.querySelector("#colorContainer").addEventListener('click', (e) => {
        if (!e.target.matches('.color-button')) {
            return;
        }

        e.preventDefault();

        const colorCode = e.target.getAttribute('data-color-code');
        const imgUrl = e.target.getAttribute('data-img-url');


        changeColor(colorCode, imgUrl);
        document.getElementById('selected_color').value = colorCode;
        const rgbColor = hexToRgb(colorCode);

        const darkerRgbColor = hexToRgb("#333333");

        e.target.style.background = `linear-gradient(45deg, ${rgbColor}, ${darkerRgbColor})`;
    });


    function changeColor(id, source) {
        const spinner = document.getElementById('spinner');
        const carImage = document.getElementById('carImage');
        const titleElements = document.querySelectorAll('.title');
        const idElement = document.getElementById(id);


        if (!spinner || !carImage || !titleElements.length || !idElement) {
            console.warn('One or more elements not found');
            return;
        }

        titleElements.forEach((node) => node.classList.add('hidden'));
        spinner.style.display = 'flex';
        idElement.classList.remove('hidden');
        spinner.classList.remove('hidden');

        let img = new Image();
        img.onload = function () {
            carImage.src = this.src;
            spinner.style.display = 'none';
            spinner.classList.add('hidden');
        }

        img.src = source;
    }


});




function darkenRgb(rgbColor, percent) {
    let rgbValues = rgbColor.replace(/[rgba()]/g, '').split(',').map(Number);
    let darkerRgbValues = rgbValues.map(value => Math.max(0, value - value * (percent / 100)));
    return `rgba(${darkerRgbValues.join(',')})`;
}

function hexToRgb(hex) {
    let result;
    if (hex.length === 4) {
        result = {
            r: parseInt(hex[1] + hex[1], 16),
            g: parseInt(hex[2] + hex[2], 16),
            b: parseInt(hex[3] + hex[3], 16)
        };
    } else if (hex.length === 7) {
        result = {
            r: parseInt(hex[1] + hex[2], 16),
            g: parseInt(hex[3] + hex[4], 16),
            b: parseInt(hex[5] + hex[6], 16)
        };
    }
    return result ? `rgba(${result.r}, ${result.g}, ${result.b})` : null;
}

