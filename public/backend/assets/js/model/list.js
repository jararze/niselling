"use strict";

function countSelectedCheckboxes(checkBoxes, isSelected) {

    let count = 0;
    checkBoxes.forEach((checkbox => {
        if (checkbox.checked) {
            isSelected = true;
            count++;
        }
    }));
    return [count, isSelected];
}

function clearTable(rowContainer, vehicleName, table) {
    console.log(table)
    Swal.fire({
        text: "Usted acaba de borrar " + vehicleName + "!",
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "Ok, lo tengo!",
        customClass: {
            confirmButton: "btn fw-bold btn-primary"
        }
    }).then(function () {
        table.row($(rowContainer)).remove().draw();
    });
}

function cancelDelete(vehicleName) {
    Swal.fire({
        text: vehicleName + " no fueron borrados.",
        icon: "error",
        buttonsStyling: false,
        confirmButtonText: "Ok, lo tengo!",
        customClass: {
            confirmButton: "btn fw-bold btn-primary"
        }
    });
}

var ModelList = function () {
    var table, e, o, dataTablePrin, c = () => {
            dataTablePrin.querySelectorAll('[data-kt-customer-table-filter="delete_row"]').forEach((delete_row => {
                delete_row.addEventListener("click", (function (vehicle) {
                    vehicle.preventDefault();

                    const vehicleId = delete_row.getAttribute('data-id');
                    // const deleteEndpoint = window.Laravel.deleteEndpoint.replace(':id', vehicleId);
                    const deleteEndpoint = window.Laravel.deleteEndpoint;

                    console.log('Delete endpoint:', deleteEndpoint);
                    const rowContainer = vehicle.target.closest("tr");
                    const vehicleName = rowContainer.querySelectorAll("td")[1].innerText;

                    console.log('vehicleNamet:', vehicleName);

                    const swalOptions = {
                        text: "¿Está seguro que desea borrar " + vehicleName + "?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Si, borrar!",
                        cancelButtonText: "No, cancelar",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    };

                    Swal.fire(swalOptions)
                        .then((e) => {
                            if (e.value) {
                                // deleteVehicle(deleteEndpoint, vehicleId)
                                fetch(deleteEndpoint, {
                                    method: "POST",
                                    headers: {
                                        'Content-type': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN': window.Laravel.csrfToken
                                    },
                                    body: JSON.stringify({ids: vehicleId})
                                })
                                    .then(response => response.json().then(data => {
                                        console.log(data)
                                        if (!response.ok || data.status === false) {
                                            Swal.fire({
                                                text: data.message || "No se pudo eliminar " + vehicleName + ".",
                                                icon: "error",
                                                buttonsStyling: false,
                                                confirmButtonText: "Ok, lo tengo!",
                                                customClass: {
                                                    confirmButton: "btn fw-bold btn-primary"
                                                }
                                            });
                                            return;
                                        }
                                        clearTable(rowContainer, vehicleName, table)
                                    }));
                            } else if (e.dismiss === Swal.DismissReason.cancel)
                                cancelDelete(vehicleName);
                        });
                }))
            }))
        },
        slBoxes = () => {
            const checkBoxes = dataTablePrin.querySelectorAll('[type="checkbox"]');
            const deleteButton = document.querySelector('[data-kt-customer-table-select="delete_selected"]');
            const getCheckedIds = () => {
                let checkedIds = [];
                checkBoxes.forEach((checkbox) => {
                    if (checkbox.checked && checkbox.value) {
                        checkedIds.push(checkbox.value);
                    }
                });
                return checkedIds;
            };

            const onCheckboxClick = () => {
                setTimeout(() => {
                    let checkedIds = getCheckedIds();
                    console.log(checkedIds);
                    updateToolbar();
                }, 50)
            };

            checkBoxes.forEach((checkbox) => {
                checkbox.addEventListener("click", onCheckboxClick);
            });

            const deleteManyWarningOptions = {
                text: "Esta seguro que desea borrar los datos seleccionados?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Si, borrar!",
                cancelButtonText: "No, cancelar",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            };

            const deleteSuccessOptions = {
                text: "Usted borro todos los datos seleccionados!.",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, lo tengo!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                }
            };

            const deleteCancelledOptions = {
                text: "Los datos seleccionados no fueron borrados.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, lo tengo!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                }
            };

            const deleteSelectedData = (checkedIds) => {
                fetch(window.Laravel.deleteEndpoint, {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': window.Laravel.csrfToken
                    },
                    body: JSON.stringify({ids: checkedIds})
                })
                    .then(response => response.json().then(data => {
                        console.log(data);
                        if (!response.ok || data.status === false) {
                            Swal.fire({
                                text: data.message || "No se pudieron eliminar los datos seleccionados.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, lo tengo!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            });
                            return;
                        }
                        Swal.fire(deleteSuccessOptions).then(function () {
                            checkBoxes.forEach((checkbox) => {
                                checkbox.checked && table.row($(checkbox.closest("tbody tr"))).remove().draw();
                            });
                            dataTablePrin.querySelectorAll('[type="checkbox"]')[0].checked = false;
                        });
                    }))
                    .catch(error => {
                        console.error('Error:', error);
                    });
            };

            deleteButton.addEventListener("click", () => {
                let checkedIds = getCheckedIds();


                Swal.fire(deleteManyWarningOptions)
                    .then((value) => {
                        if (value.isConfirmed) {
                            deleteSelectedData(checkedIds);
                        } else if (value.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire(deleteCancelledOptions);
                        }
                    });

            });

        };
    const updateToolbar = () => {
        const tableBase = document.querySelector('[data-kt-customer-table-toolbar="base"]');
        const tableSelected = document.querySelector('[data-kt-customer-table-toolbar="selected"]');
        const selectItemCount = document.querySelector('[data-kt-customer-table-select="selected_count"]');
        const checkboxes = document.querySelectorAll('tbody [type="checkbox"]');

        let isSelected = false;
        let [selectedCount = 0, isSelectedReturn] = countSelectedCheckboxes(checkboxes, isSelected);

        isSelectedReturn ? (selectItemCount.innerHTML = selectedCount,
            tableBase.classList.add("d-none"),
            tableSelected.classList.remove("d-none")) : (tableBase.classList.remove("d-none"),
            tableSelected.classList.add("d-none"))
    };

    // return {
    //     init: function () {
    //         const dataTablePrin = document.querySelector("#kt_customers_table");
    //
    //         if(dataTablePrin) {
    //             const tableRows = dataTablePrin.querySelectorAll("tbody tr");
    //
    //             tableRows.forEach(row => {
    //                 const cells = row.querySelectorAll("td");
    //
    //                 if(cells[4] && cells[9]){
    //                     const dateAttr = moment(cells[4].innerHTML, "DD MMM YYYY, LT").format();
    //                     cells[9].setAttribute("data-order", dateAttr);
    //                 }
    //
    //             });
    //
    //             const table = $(dataTablePrin).DataTable({
    //                 info: false,
    //                 order: [],
    //                 columnDefs: [
    //                     { orderable: false, targets: 0 },
    //                     { orderable: false, targets: 4 }
    //                 ]
    //             });
    //
    //             table.on("draw", () => {
    //                 slBoxes();
    //                 c();
    //                 updateToolbar();
    //                 KTMenu.init();
    //             });
    //             slBoxes()
    //             const emonth = $('[data-kt-customer-table-filter="month"]');
    //
    //             const otype = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]');
    //
    //             document.querySelector('[data-kt-customer-table-filter="search"]').addEventListener("keyup", e => {
    //                 table.search(e.target.value).draw();
    //             });
    //             c()
    //             document.querySelector('[data-kt-customer-table-filter="filter"]').addEventListener("click", () => {
    //                 const month = emonth.val();
    //                 let type = "";
    //                 otype.forEach(t => {
    //                     if(t.checked){
    //                         type = t.value;
    //                         if (type === "all") type = "";
    //                     }
    //                 });
    //
    //                 const query = `${month} ${type}`;
    //                 table.search(query).draw();
    //             });
    //
    //             document.querySelector('[data-kt-customer-table-filter="reset"]').addEventListener("click", () => {
    //                 e.val(null).trigger("change");
    //                 o[0].checked = true;
    //                 table.search("").draw();
    //             });
    //         }
    //     }
    // }


    return {
        init: function () {
            (dataTablePrin = document.querySelector("#kt_customers_table")) && (dataTablePrin.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    o = moment(e[4].innerHTML, "DD MMM YYYY, LT").format();
                e[9].setAttribute("data-order", o)
            })), (table = $(dataTablePrin).DataTable({
                info: !1,
                order: [],
                columnDefs: [{
                    orderable: !1,
                    targets: 0
                }, {
                    orderable: !1,
                    targets: 4
                }]
            })).on("draw", (function () {
                slBoxes(), c(), updateToolbar(), KTMenu.init()
            })), slBoxes(), document.querySelector('[data-kt-customer-table-filter="search"]').addEventListener("keyup", (function (e) {
                table.search(e.target.value).draw()
            })), e = $('[data-kt-customer-table-filter="month"]'), o = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]'), document.querySelector('[data-kt-customer-table-filter="filter"]').addEventListener("click", (function () {
                const n = e.val();
                let c = "";
                o.forEach((t => {
                    t.checked && (c = t.value),
                    "all" === c && (c = "")
                }));
                const r = n + " " + c;
                table.search(r).draw()
            })), c(), document.querySelector('[data-kt-customer-table-filter="reset"]').addEventListener("click", (function () {
                e.val(null).trigger("change"), o[0].checked = !0, table.search("").draw()
            })))
        }
    }



}();


KTUtil.onDOMContentLoaded((function () {
    ModelList.init()
}));
