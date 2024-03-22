"use strict";
var KTCustomersList = function () {
    var t, e, o, n, c = () => {
            n.querySelectorAll('[data-kt-customer-table-filter="delete_row"]').forEach((e => {
                e.addEventListener("click", (function (e) {
                    e.preventDefault();
                    var typeVehicleId = this.getAttribute('data-id');

                    // Replace the placeholder ':id' with the actual ID in the delete endpoint
                    var deleteEndpoint = window.Laravel.deleteEndpoint.replace(':id', typeVehicleId);

                    // Log the delete endpoint to the console
                    console.log('Delete endpoint:', deleteEndpoint);
                    const o = e.target.closest("tr"),
                        n = o.querySelectorAll("td")[1].innerText;
                    Swal.fire({
                        text: "¿Está seguro que desea borrar " + n + "?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Si, borrar!",
                        cancelButtonText: "No, cancelar",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((function (e) {
                        if (e.value) {

                            fetch(deleteEndpoint, {
                                method: "POST",
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                                },
                                body: JSON.stringify({ids: typeVehicleId})
                            })
                                .then(response => response.json())
                                .then(data => {
                                    console.log(data);
                                    Swal.fire({
                                        text: "Usted acaba de borrar " + n + "!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, lo tengo!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    }).then(function () {
                                        t.row($(o)).remove().draw();
                                    });
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        } else if (e.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                text: n + " no fueron borrados.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, lo tengo!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            })
                        }
                    }))
                }))
            }))
        },
        r = () => {
            const e = n.querySelectorAll('[type="checkbox"]'),
                o = document.querySelector('[data-kt-customer-table-select="delete_selected"]');
            const getCheckedIds = () => {
                let checkedIds = [];
                e.forEach((checkbox) => {
                    if (checkbox.checked && checkbox.value) {
                        checkedIds.push(checkbox.value);
                    }
                });
                return checkedIds;
            };
            e.forEach((t => {
                t.addEventListener("click", (function () {
                    setTimeout((function () {
                        let checkedIds = getCheckedIds();
                        console.log(checkedIds);
                        l()
                    }), 50)
                }))
            })), o.addEventListener("click", (function () {
                let checkedIds = getCheckedIds();


                Swal.fire({
                    text: "Esta seguro que desea borrar los datos seleccionados?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Si, borrar!",
                    cancelButtonText: "No, cancelar",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then((function (o) {
                    if (o.value) {
                        console.log(window.Laravel.deleteEndpoint)
                        fetch(window.Laravel.deleteEndpoint, {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': window.Laravel.csrfToken
                            },
                            body: JSON.stringify({ids: checkedIds})
                        })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                Swal.fire({
                                    text: "Usted borro todos los datos seleccionados!.",
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, lo tengo!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                }).then(function () {
                                    e.forEach((e) => {
                                        e.checked &&
                                        t
                                            .row($(e.closest("tbody tr")))
                                            .remove()
                                            .draw();
                                    });
                                    n.querySelectorAll('[type="checkbox"]')[0].checked = !1;
                                });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    } else if (e.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            text: "Los datos seleccionaos no fueron borrados.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, lo tengo!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        })
                    }
                }))

            }))
        };
    const l = () => {
        const t = document.querySelector('[data-kt-customer-table-toolbar="base"]'),
            e = document.querySelector('[data-kt-customer-table-toolbar="selected"]'),
            o = document.querySelector('[data-kt-customer-table-select="selected_count"]'),
            c = n.querySelectorAll('tbody [type="checkbox"]');
        let r = !1,
            l = 0;
        c.forEach((t => {
            t.checked && (r = !0, l++)
        })), r ? (o.innerHTML = l, t.classList.add("d-none"), e.classList.remove("d-none")) : (t.classList.remove("d-none"), e.classList.add("d-none"))
    };
    return {
        init: function () {
            (n = document.querySelector("#kt_customers_table")) && (n.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    o = moment(e[5].innerHTML, "DD MMM YYYY, LT").format();
                e[5].setAttribute("data-order", o)
            })), (t = $(n).DataTable({
                info: !1,
                order: [],
                columnDefs: [{
                    orderable: !1,
                    targets: 0
                }, {
                    orderable: !1,
                    targets: 6
                }]
            })).on("draw", (function () {
                r(), c(), l(), KTMenu.init()
            })), r(), document.querySelector('[data-kt-customer-table-filter="search"]').addEventListener("keyup", (function (e) {
                t.search(e.target.value).draw()
            })), e = $('[data-kt-customer-table-filter="month"]'), o = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]'), document.querySelector('[data-kt-customer-table-filter="filter"]').addEventListener("click", (function () {
                const n = e.val();
                let c = "";
                o.forEach((t => {
                    t.checked && (c = t.value),
                    "all" === c && (c = "")
                }));
                const r = n + " " + c;
                t.search(r).draw()
            })), c(), document.querySelector('[data-kt-customer-table-filter="reset"]').addEventListener("click", (function () {
                e.val(null).trigger("change"), o[0].checked = !0, t.search("").draw()
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTCustomersList.init()
}));
