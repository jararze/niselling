"use strict";
// da
var KTCustomersList = function () {
    var table,
        deleteRowButtons,
        deleteSelectedButton,
        selectedCountDisplay,
        checkboxes,
        toolbarBase,
        toolbarSelected;

    var deleteRow = function (row) {
        var id = row.querySelector('td:nth-child(2)').innerText;
        Swal.fire({
            text: '¿Está seguro que desea borrar ' + id + '?',
            icon: 'warning',
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: 'Si, borrar!',
            cancelButtonText: 'No, cancelar',
            customClass: {
                confirmButton: 'btn fw-bold btn-danger',
                cancelButton: 'btn fw-bold btn-active-light-primary'
            }
        }).then(function (result) {
            if (result.value) {
                fetch(window.Laravel.submitEndpoint, {
                    method: 'POST',
                    body: JSON.stringify({ id: id }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(function (response) {
                    if (response.ok) {
                        Swal.fire({
                            text: 'Usted acaba de borrar ' + id + '!',
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok, lo tengo!',
                            customClass: {
                                confirmButton: 'btn fw-bold btn-primary'
                            }
                        }).then(function () {
                            table.row($(row)).remove().draw();
                        });
                    } else {
                        Swal.fire({
                            text: id + ' no fueron borrados.',
                            icon: 'error',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok, lo tengo!',
                            customClass: {
                                confirmButton: 'btn fw-bold btn-primary'
                            }
                        });
                    }
                });
            }
        });
    };

    var deleteSelectedRows = function () {
        var selectedIds = [];
        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                selectedIds.push(checkbox.closest('tr').querySelector('td:nth-child(2)').innerText);
            }
        });

        if (selectedIds.length === 0) {
            return;
        }

        Swal.fire({
            text: 'Esta seguro que desea borrar los datos seleccionados?',
            icon: 'warning',
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: 'Si, borrar!',
            cancelButtonText: 'No, cancelar',
            customClass: {
                confirmButton: 'btn fw-bold btn-danger',
                cancelButton: 'btn fw-bold btn-active-light-primary'
            }
        }).then(function (result) {
            if (result.value) {
                fetch(window.Laravel.submitEndpoint, {
                    method: 'POST',
                    body: JSON.stringify({ ids: selectedIds }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(function (response) {
                    if (response.ok) {
                        Swal.fire({
                            text: 'Usted borro todos los datos seleccionados!',
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok, lo tengo!',
                            customClass: {
                                confirmButton: 'btn fw-bold btn-primary'
                            }
                        }).then(function () {
                            checkboxes.forEach(function (checkbox) {
                                if (checkbox.checked) {
                                    table.row($(checkbox.closest('tbody tr'))).remove().draw();
                                }
                            });
                            checkboxes[0].checked = false;
                            updateToolbar();
                        });
                    } else {
                        Swal.fire({
                            text: 'Los datos seleccionaos no fueron borrados.',
                            icon: 'error',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok, lo tengo!',
                            customClass: {
                                confirmButton: 'btn fw-bold btn-primary'
                            }
                        });
                    }
                });
            }
        });
    };

    var updateToolbar = function () {
        var selectedCount = 0;
        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                selectedCount++;
            }
        });

        if (selectedCount > 0) {
            selectedCountDisplay.innerHTML = selectedCount;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    };

    return {
        init: function () {
            table = $('#kt_customers_table').DataTable({
                info: false,
                order: [],
                columnDefs: [
                    { orderable: false, targets: 0 },
                    { orderable: false, targets: 4 }
                ]
            });

            deleteRowButtons = document.querySelectorAll('[data-kt-customer-table-filter="delete_row"]');
            deleteSelectedButton = document.querySelector('[data-kt-customer-table-select="delete_selected"]');
            selectedCountDisplay = document.querySelector('[data-kt-customer-table-select="selected_count"]');
            checkboxes = document.querySelectorAll('[type="checkbox"]');
            toolbarBase = document.querySelector('[data-kt-customer-table-toolbar="base"]');
            toolbarSelected = document.querySelector('[data-kt-customer-table-toolbar="selected"]');

            table.on('draw', function () {
                checkboxes.forEach(function (checkbox) {
                    checkbox.addEventListener('click', function () {
                        setTimeout(function () {
                            updateToolbar();
                        }, 50);
                    });
                });

                deleteRowButtons.forEach(function (button) {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        deleteRow(button.closest('tr'));
                    });
                });

                deleteSelectedButton.addEventListener('click', deleteSelectedRows);
            });

            updateToolbar();

            document.querySelector('[data-kt-customer-table-filter="search"]').addEventListener('keyup', function (e) {
                table.search(e.target.value).draw();
            });

            var monthFilter = $('[data-kt-customer-table-filter="month"]');
            var paymentTypeFilters = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]');

            document.querySelector('[data-kt-customer-table-filter="filter"]').addEventListener('click', function () {
                var selectedMonth = monthFilter.val();
                var selectedPaymentType = Array.from(paymentTypeFilters).find(function (filter) {
                    return filter.checked;
                });

                var filterValue = selectedMonth + ' ' + (selectedPaymentType ? selectedPaymentType.value : '');

                alert(filterValue);

                table.search(filterValue).draw();
            });

            document.querySelector('[data-kt-customer-table-filter="reset"]').addEventListener('click', function () {
                monthFilter.val(null).trigger('change');
                paymentTypeFilters[0].checked = true;
                table.search('').draw();
            });
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTCustomersList.init();
});
