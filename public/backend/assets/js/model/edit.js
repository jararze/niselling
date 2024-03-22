"use strict";
const Save = {
    init: function () {
        this.initQuill();
        this.initStatus();
        this.initFormValidation();
    },

    initQuill: function () {
        const quillElements = ["#kt_ecommerce_add_product_description", "#kt_ecommerce_add_product_meta_description"];

        quillElements.forEach((element) => {
            const quillInstance = document.querySelector(element);

            if (quillInstance) {
                new Quill(element, {
                    modules: {
                        toolbar: [[{header: [1, 2, false]}], ["bold", "italic", "underline"], ["image", "code-block"],],
                    }, placeholder: "Ingrese su texto aquí...", theme: "snow",
                });
            }
        });
    },

    initStatus: function () {
        const statusElement = document.getElementById("kt_ecommerce_add_product_status");
        const statusSelectElement = document.getElementById("kt_ecommerce_add_product_status_select");
        const statusClasses = ["bg-success", "bg-warning", "bg-danger"];

        $(statusSelectElement).on("change", function (event) {
            switch (event.target.value) {
                case "1":
                    statusElement.classList.remove(...statusClasses);
                    statusElement.classList.add("bg-success");
                    break;
                case "0":
                    statusElement.classList.remove(...statusClasses);
                    statusElement.classList.add("bg-danger");
                    break;
            }
        }.bind(this));

    },

    initFormValidation: function () {
        const form = document.getElementById("kt_ecommerce_add_product_form");
        const submitButton = document.getElementById("kt_ecommerce_add_product_submit");



        const formValidation = FormValidation.formValidation(form, {

            fields: {
                model_name: {
                    validators: {
                        notEmpty: {
                            message: "Nombre de modelo requerido"
                        }
                    }
                },
                data_sheet: {
                    validators: {
                        notEmpty: {
                            message: "Llene la ficha técnica"
                        }
                    }
                }, order: {
                    validators: {
                        notEmpty: {
                            message: "Ingrese la posición"
                        }
                    }
                },
            },

            plugins: {
                trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "",
                }),
            },
        });

        submitButton.addEventListener("click", (event) => {
            event.preventDefault();

            const formData = new FormData(document.getElementById("kt_ecommerce_add_product_form"));
            const file = document.getElementById('avatar').files[0];
            if (file) {
                formData.append('avatar', file);
            }
            // Prevent multiple clicks on the submit button
            if (submitButton.hasAttribute("data-kt-indicator")) {
                return;
            }

            formValidation.validate().then((validationResult) => {
                // console.log("validated!");

                if (validationResult === "Valid") {
                    submitButton.setAttribute("data-kt-indicator", "on");
                    submitButton.disabled = true;
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;

                    const quillDescriptionEditor = document.querySelector("#kt_ecommerce_add_product_description .ql-editor");
                    const quillDescriptionContent = quillDescriptionEditor.children[0].innerHTML;
                    formData.append("description", quillDescriptionContent);
                    const formDataObject = Object.fromEntries(formData.entries());
                    const jsonFormData = JSON.stringify(formDataObject);


                    for (const [key, value] of Object.entries(formDataObject)) {
                        console.log(`${key}: ${value}`);
                    }



                    fetch(window.Laravel.submitEndpoint, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        credentials: 'same-origin',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data.success);
                            if (data.success != true) {
                                Swal.fire({
                                    text: "Ok, ¡entendido! Lo sentimos, parece que se han detectado algunos errores, inténtalo de nuevo.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, lo tengo!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                })
                            } else {
                                Swal.fire({
                                    title: "Datos guardados",
                                    text: "Datos guardados satisfactoriamente!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, lo tengo!",
                                    customClass: {confirmButton: "btn btn-primary"},
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = form.getAttribute("data-kt-redirect");
                                    }
                                });

                            }

                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                text: "Ok, ¡entendido! Lo sentimos, parece que se han detectado algunos errores, inténtalo de nuevo.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, lo tengo!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            })
                        });


                } else {
                    Swal.fire({
                        title: "Error al validar el formulario",
                        html: "Lo sentimos, parece que existen algunos problemas en el formulario, trate nuevamente. <br/><br/>Los errores fueron marcados <strong>rojos</strong> o <strong>con una leyenda</strong> en la página",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, lo tengo!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                }
            });
        });
    },
};
KTUtil.onDOMContentLoaded(function () {
    Save.init();
});
