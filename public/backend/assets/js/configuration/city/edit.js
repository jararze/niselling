"use strict";
var editType = {
    init: function() {
        let form, submitButton, validator;
        form = document.getElementById("kt_type_edit_form");
        submitButton = document.getElementById("kt_type_edit_submit");
        validator = FormValidation.formValidation(form, {
            fields: {
                type_name: {
                    validators: {
                        notEmpty: {
                            message: "El nombre del tipo de vehículo es requerido"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row",
                    eleInvalidClass: "",
                    eleValidClass: ""
                })
            }
        });

        submitButton.addEventListener("click", function(event) {
            event.preventDefault();
            validator && validator.validate().then(function(status) {
                // console.log("validated!");
                if (status === "Valid") {
                    submitButton.setAttribute("data-kt-indicator", "on");
                    submitButton.disabled = true;

                    // Create a FormData object from the form
                    var formData = new FormData(form);

                    console.log(formData.get('type_name'));
                    console.log(formData.get('status'));

                    // Send the form data using fetch to your server endpoint
                    fetch(window.Laravel.submitEndpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({
                            id: formData.get('id'),
                            name: formData.get('type_name'),
                            status: formData.get('status')
                        })
                        // body: formData
                    })
                        .then(response => response.json()) // Assuming the server responds with JSON
                        .then(data => {
                            // Handle the response data from the server
                            console.log(data)
                            submitButton.removeAttribute("data-kt-indicator");
                            if (data.success) {
                                // If the server indicates success, show a success message
                                Swal.fire({
                                    text: "Los datos fueron guardados satisfactoriamente",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, lo tengo!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function(result) {
                                    if (result.isConfirmed) {
                                        // Optionally redirect or perform another action
                                        window.location = form.getAttribute("data-kt-redirect");
                                    }
                                });
                            } else {
                                // If the server indicates an error, show an error message
                                Swal.fire({
                                    text: "Lo sentimos, hubo un problema al enviar el formulario. Inténtalo de nuevo.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, lo tengo!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        })
                        .catch(error => {
                            // Handle any network errors
                            submitButton.removeAttribute("data-kt-indicator");
                            Swal.fire({
                                text:"Lo sentimos, hubo un error de red. Inténtalo de nuevo.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, lo tengo!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        })
                        .finally(() => {
                            // Re-enable the submit button whether the request was successful or not
                            submitButton.disabled = false;
                        });
                } else {
                    Swal.fire({
                        text: "Lo sentimos, parece que se han detectado algunos errores. Inténtalo de nuevo.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, lo tengo!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });
    }
};
KTUtil.onDOMContentLoaded(function () {
    editType.init();
});
