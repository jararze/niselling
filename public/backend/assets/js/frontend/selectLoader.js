document.addEventListener('DOMContentLoaded', function () {
    const modelSelect = document.getElementById('models');
    const grade = document.getElementById('grade');
    const spinner = document.getElementById('spinner');
    const city = document.getElementById('city');
    const showroom = document.getElementById('showroom');

    modelSelect.addEventListener('change', function () {
        const modelId = this.value;
        if (modelId == 0) {
            grade.innerHTML = '<option value="">Seleccione un modelo primero.</option>';
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
                    select.innerHTML = "";

                    console.log(data)

                    Object.entries(data).forEach(([key, value]) => {
                        const option = document.createElement("option");
                        option.value = key;
                        option.text = value;
                        select.appendChild(option);
                    });
                })
                .catch((error) => {
                    document.getElementById("spinner").style.display = "none";
                    console.error('Error:', error);
                });
        }
    });

    city.addEventListener('change', function () {
        const cityId = this.value;
        if (cityId == 0) {
            showroom.innerHTML = '<option>Seleccione una ciudad primero.</option>';
        } else {
            spinner.style.display = 'flex'; // Show the spinner

            const EndPoint = window.Laravel.showroomEndpoint.replace(':id', cityId);

            fetch(EndPoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    id: cityId,
                })
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("spinner").style.display = "none";

                    const select = document.getElementById("showroom");
                    select.innerHTML = "";
                    if(Object.keys(data).length === 0) {
                        const option = document.createElement("option");
                        option.text = 'No hay datos encontrados, seleccione otra ciudad';
                        select.appendChild(option);
                    } else {
                        Object.entries(data).forEach(([key, value]) => {
                            const option = document.createElement("option");
                            option.value = key;
                            option.text = value;
                            select.appendChild(option);
                        });
                    }
                })
                .catch((error) => {
                    document.getElementById("spinner").style.display = "none";
                    console.error('Error:', error);
                });
        }
    });


});
