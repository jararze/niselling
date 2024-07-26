@push('styles')
@endpush
@push('script')
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            deleteEndpoint: '{{ route("backend.quote.delete") }}'
        };
    </script>
    <script src="{{ asset('backend/assets/js/quotes/list.js') }}"></script>
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Leads
        </h2>
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header border-0 pt-6">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                    <input type="text" data-kt-customer-table-filter="search"
                                           class="form-control form-control-solid w-250px ps-12"
                                           placeholder="Buscar..."/>
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--begin::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                    <!--begin::Filter-->
                                    <button type="button" class="btn btn-light-primary me-3"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-outline ki-filter fs-2"></i>Filtro
                                    </button>
                                    <!--begin::Menu 1-->
                                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
                                         id="kt-toolbar-filter">
                                        <!--begin::Header-->
                                        <div class="px-7 py-5">
                                            <div class="fs-4 text-gray-900 fw-bold">Opciones del filtro</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Separator-->
                                        <div class="separator border-gray-200"></div>
                                        <!--end::Separator-->
                                        <!--begin::Content-->
                                        <div class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fs-5 fw-semibold mb-3">Mes creado:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select class="form-select form-select-solid fw-bold"
                                                        data-kt-select2="true" data-placeholder="Seleccione un mes"
                                                        data-allow-clear="true" data-kt-customer-table-filter="month"
                                                        data-dropdown-parent="#kt-toolbar-filter">
                                                    <option></option>
                                                    <option value="jan">Enero</option>
                                                    <option value="feb">Febrero</option>
                                                    <option value="mar">Marzo</option>
                                                    <option value="apr">Abril</option>
                                                    <option value="may">Mayo</option>
                                                    <option value="jun">Junio</option>
                                                    <option value="jul">Julio</option>
                                                    <option value="ago">Agosto</option>
                                                    <option value="sep">Septiembre</option>
                                                    <option value="oct">Octubre</option>
                                                    <option value="nov">Noviembre</option>
                                                    <option value="dec">Diciembre</option>
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fs-5 fw-semibold mb-3">¿Habilitado?:</label>
                                                <!--end::Label-->
                                                <!--begin::Options-->
                                                <div class="d-flex flex-column flex-wrap fw-semibold"
                                                     data-kt-customer-table-filter="payment_type">
                                                    <!--begin::Option-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                        <input class="form-check-input" type="radio" name="payment_type"
                                                               value="all" checked="checked"/>
                                                        <span class="form-check-label text-gray-600">Todo</span>
                                                    </label>
                                                    <!--end::Option-->
                                                    <!--begin::Option-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                        <input class="form-check-input" type="radio" name="payment_type"
                                                               value="habilitado"/>
                                                        <span class="form-check-label text-gray-600">Habilitado</span>
                                                    </label>
                                                    <!--end::Option-->
                                                    <!--begin::Option-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                                        <input class="form-check-input" type="radio" name="payment_type"
                                                               value="no_habilitado"/>
                                                        <span
                                                            class="form-check-label text-gray-600">No habilitado</span>
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                                        data-kt-menu-dismiss="true"
                                                        data-kt-customer-table-filter="reset">Blanquear
                                                </button>
                                                <button type="submit" class="btn btn-primary"
                                                        data-kt-menu-dismiss="true"
                                                        data-kt-customer-table-filter="filter">Aplicar
                                                </button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Menu 1-->
                                    <!--end::Filter-->
                                    <!--begin::Export-->
                                    <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                                            data-bs-target="#kt_customers_export_modal">
                                        <i class="ki-outline ki-exit-up fs-2"></i>Export
                                    </button>
                                    <!--end::Export-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Group actions-->
                                <div class="d-flex justify-content-end align-items-center d-none"
                                     data-kt-customer-table-toolbar="selected">
                                    <div class="fw-bold me-5">
                                        <span class="me-2" data-kt-customer-table-select="selected_count"></span>Seleccionado
                                    </div>
                                    <button type="button" class="btn btn-danger"
                                            data-kt-customer-table-select="delete_selected">Borrar seleccionados
                                    </button>
                                </div>
                                <!--end::Group actions-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                   data-kt-check-target="#kt_customers_table .form-check-input"
                                                   value="1"/>
                                        </div>
                                    </th>
                                    <th class="min-w-70px">Nombre</th>
                                    <th class="min-w-70px">Celular</th>
                                    <th class="min-w-70px">Email</th>
                                    <th class="min-w-70px">ShowRoom</th>
                                    <th class="min-w-70px">Modelo</th>
                                    <th class="min-w-70px">Agente</th>
                                    <th class="min-w-70px">Tecnom</th>
                                    <th class="min-w-80px">Fecha</th>
                                    <th class="text-end min-w-60px"></th>
                                </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                @foreach($values as $quote)
                                    <tr style="@if(!empty($quote->error_libelula) || !empty($quote->error_tecnom)) background-color: #FCA5A5; color: black @endif">
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox"
                                                       value="{{ $quote->id }}"/>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-gray-800 text-hover-primary mb-1">{{ $quote->name }} {{ $quote->last_name }}</p>
                                        </td>
                                        <td>{{ $quote->phone  }}</td>
                                        <td>{{ $quote->email  }}</td>
                                        <td>{{ $quote->showroomOfCar->name }}, {{ $quote->cityOfCar->name }}</td>
                                        <td>{{ $quote->modelOfCar->name ?? 'ERROR'  }}, {{ $quote->gradeOfCar->name ?? 'ERROR'  }}</td>
                                        <td>{{ $quote->agentOfCar->name ?? 'Sin agente' }} </td>
                                        <td><span class="badge badge-lg badge-light-primary fw-bold my-2 fs-8">{{ $quote->tecnom_id }}</span></td>
                                        <td>{{ $quote->created_at->format('d M Y, h:i a') }}</td>
                                        <td class="text-end">
                                            <a href="#"
                                               class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                               data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Acciones
                                                <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                            <!--begin::Menu-->
                                            <div
                                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('backend.quote.edit', $quote->id) }}"
                                                       class="menu-link px-3">Ver</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" data-id="{{ $quote->id }}" class="menu-link px-3"
                                                       data-kt-customer-table-filter="delete_row">Borrar</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Modals-->
                    <!--begin::Modal - Customers - Add-->
                    <!--end::Modal - Customers - Add-->
                    <!--begin::Modal - Adjust Balance-->
                    <div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Exportar información.</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div id="kt_customers_export_close"
                                         class="btn btn-icon btn-sm btn-active-icon-primary">
                                        <i class="ki-outline ki-cross fs-1"></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                    <!--begin::Form-->
                                    <form id="kt_customers_export_form" class="form" action="#">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold form-label mb-5">Select Export
                                                Format:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select data-control="select2" data-placeholder="Select a format"
                                                    data-hide-search="true" name="format"
                                                    class="form-select form-select-solid">
                                                <option value="excell">Excel</option>
                                                <option value="pdf">PDF</option>
                                                <option value="cvs">CVS</option>
                                                <option value="zip">ZIP</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold form-label mb-5">Select Date Range:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder="Pick a date"
                                                   name="date"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Row-->
                                        <div class="row fv-row mb-15">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold form-label mb-5">Payment Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Radio group-->
                                            <div class="d-flex flex-column">
                                                <!--begin::Radio button-->
                                                <label
                                                    class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                           checked="checked" name="payment_type"/>
                                                    <span class="form-check-label text-gray-600 fw-semibold">All</span>
                                                </label>
                                                <!--end::Radio button-->
                                                <!--begin::Radio button-->
                                                <label
                                                    class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                    <input class="form-check-input" type="checkbox" value="2"
                                                           checked="checked" name="payment_type"/>
                                                    <span class="form-check-label text-gray-600 fw-semibold">Visa</span>
                                                </label>
                                                <!--end::Radio button-->
                                                <!--begin::Radio button-->
                                                <label
                                                    class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                    <input class="form-check-input" type="checkbox" value="3"
                                                           name="payment_type"/>
                                                    <span
                                                        class="form-check-label text-gray-600 fw-semibold">Mastercard</span>
                                                </label>
                                                <!--end::Radio button-->
                                                <!--begin::Radio button-->
                                                <label
                                                    class="form-check form-check-custom form-check-sm form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="4"
                                                           name="payment_type"/>
                                                    <span class="form-check-label text-gray-600 fw-semibold">American Express</span>
                                                </label>
                                                <!--end::Radio button-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Actions-->
                                        <div class="text-center">
                                            <button type="reset" id="kt_customers_export_cancel"
                                                    class="btn btn-light me-3">Discard
                                            </button>
                                            <button type="submit" id="kt_customers_export_submit"
                                                    class="btn btn-primary">
                                                <span class="indicator-label">Submit</span>
                                                <span class="indicator-progress">Please wait...
																<span
                                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                    </div>
                    <!--end::Modal - New Card-->
                    <!--end::Modals-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
</x-app-layout>
