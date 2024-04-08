"use strict";
var KTModalCustomersAdd = function () {
    var t, e, o, n, r, i;
    return {
        init: function () {
            i = new bootstrap.Modal(document.querySelector("#kt_modal_add_customer")), r = document.querySelector("#kt_modal_add_customer_form"), t = r.querySelector("#kt_modal_add_customer_submit"), e = r.querySelector("#kt_modal_add_customer_cancel"), o = r.querySelector("#kt_modal_add_customer_close"), n = FormValidation.formValidation(r, {
                fields: {
                    name: {validators: {notEmpty: {message: "El nombre  es requerido"}}},
                    phone: {validators: {notEmpty: {message: "El Telefono  es requerido"}}},
                    email: {validators: {notEmpty: {message: "El Telefono  es requerido"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), t.addEventListener("click", (function (e) {
                e.preventDefault(), n && n.validate().then((function (e) {
                    console.log("validated!"),
                        "Valid" == e ? (t.setAttribute("data-kt-indicator", "on"),
                                t.disabled = !0,
                                setTimeout((function () {
                                    t.removeAttribute("data-kt-indicator"),
                                        fetch(window.Laravel.submitEndpoint, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-Requested-With': 'XMLHttpRequest',
                                                'X-CSRF-TOKEN': window.Laravel.csrfToken
                                            },
                                            credentials: 'same-origin',
                                            body: JSON.stringify({
                                                name: document.querySelector("#name").value,
                                                phone: document.querySelector("#phone").value,
                                                email: document.querySelector("#email").value,
                                                showroom: document.querySelector("#showroom").value,
                                                available: document.querySelector("#available").checked
                                            })
                                        })
                                            .then(response => response.json())
                                            .then(data => {
                                                console.log(data);
                                                console.log("mensaje:", data.message);
                                                if(data.status != 'success'){
                                                    Swal.fire({
                                                        text: "Ok, ¡entendido! Lo sentimos, parece que se han detectado algunos errores, inténtalo de nuevo.",
                                                        icon: "error",
                                                        buttonsStyling: !1,
                                                        confirmButtonText: "Ok, lo tengo!",
                                                        customClass: {
                                                            confirmButton: "btn btn-primary"
                                                        }
                                                    })
                                                }else{
                                                    Swal.fire({
                                                        text: "Los datos fueron guardados satisfactoriamente.",
                                                        icon: "success",
                                                        buttonsStyling: !1,
                                                        confirmButtonText: "Ok, lo tengo!",
                                                        customClass: {
                                                            confirmButton: "btn btn-primary"
                                                        }
                                                    }).then((function (e) {
                                                        e.isConfirmed && (i.hide(), t.disabled = !1, window.location = r.getAttribute("data-kt-redirect"))
                                                    }))
                                                }

                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                                Swal.fire({
                                                    text: "Ok, ¡entendido! Lo sentimos, parece que se han detectado algunos errores, inténtalo de nuevo.",
                                                    icon: "error",
                                                    buttonsStyling: !1,
                                                    confirmButtonText: "Ok, lo tengo!",
                                                    customClass: {
                                                        confirmButton: "btn btn-primary"
                                                    }
                                                })
                                            });

                                }), 2)
                        ) : Swal.fire({
                            text: "Ok, ¡entendido! Lo sentimos, parece que se han detectado algunos errores, inténtalo de nuevo.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, lo tengo!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                }))
            })), e.addEventListener("click", (function (t) {
                t.preventDefault(), Swal.fire({
                    text: "¿Cancelamos la solicitud?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Si cancelar",
                    cancelButtonText: "No, regresar",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then((function (t) {
                    t.value ? (r.reset(), i.hide()) : "cancel" === t.dismiss && Swal.fire({
                        text: "¡Tu formulario no ha sido cancelado!.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, lo tengo!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }))
            })), o.addEventListener("click", (function (t) {
                t.preventDefault(), Swal.fire({
                    text: "¿Cancelamos la solicitud?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Si cancelar",
                    cancelButtonText: "No, regresar",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then((function (t) {
                    t.value ? (r.reset(), i.hide()) : "cancel" === t.dismiss && Swal.fire({
                        text: "¡Tu formulario no ha sido cancelado!.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }))
            }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalCustomersAdd.init()
}));
