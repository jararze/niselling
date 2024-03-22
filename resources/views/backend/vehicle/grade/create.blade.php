@push('styles')
@endpush
@push('script')
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            submitEndpoint: '{{ route("backend.vehicle.grade.store") }}',
        };
    </script>
    <script src="{{ asset('backend/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('backend/assets/js/grade/save.js') }}"></script>
@endpush

<x-app-layout>
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Form-->
                    <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row"
                          {{--                          action="{{ route('backend.vehicle.model.store') }}" method="POST" enctype="multipart/form-data">--}}
                          data-kt-redirect="{{ route('backend.vehicle.grade.index') }}">
                        {{--                        @csrf--}}
                        <!--begin::Aside column-->
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!--begin::Status-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="required">Estatus</h2>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <div class="rounded-circle bg-success w-15px h-15px"
                                             id="kt_ecommerce_add_product_status"></div>
                                    </div>
                                    <!--begin::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                            data-placeholder="Seleccione una opción"
                                            name="status_available"
                                            required
                                            id="kt_ecommerce_add_product_status_select">
                                        <option value="1" selected="selected">Habilitado</option>
                                        <option value="0">No Habilitado</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Establece el estado del modelo.</div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Status-->
                            <!--begin::Category & tags-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Detalles del modelo</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <!--begin::Label-->
                                    <label for="model" class="form-label required">Modelo</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" data-control="select2"
                                            name="model"
                                            id="model"
                                            required
                                            data-placeholder="Seleccione una opcion" data-allow-clear="true">
                                        @foreach($models as $model)
                                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7 mb-7">Agrega el tipo de vehículo al modelo.</div>
                                    <!--end::Description-->
                                    <!--end::Input group-->
                                    <!--begin::Button-->
                                    <a href="{{ route('backend.vehicle.model.create') }}"
                                       class="btn btn-light-primary btn-sm mb-10">
                                        <i class="ki-outline ki-plus fs-2"></i>Agregar un nuevo modelo</a>
                                    <!--end::Button-->
                                    <!--begin::Input group-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Category & tags-->
                            <!--begin::Weekly sales-->
                            <!--end::Weekly sales-->
                        </div>
                        <!--end::Aside column-->
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <!--begin:::Tabs-->
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                       href="#kt_ecommerce_add_product_general">General Grado</a>
                                </li>
                            </ul>
                            <!--end:::Tabs-->
                            <!--begin::Tab content-->
                            <div class="tab-content">
                                <!--begin::Tab pane-->
                                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general"
                                     role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                        <!--begin::General options-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>General</h2>
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label for="model_name" class="required form-label">Nombre del Grado</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="model_name" id="model_name"
                                                           class="form-control mb-2" placeholder="Nombre del grado"
                                                           value=""/>
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Se requiere un nombre del grado y recomendamos que sea un nombre único.
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->

                                                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="engine" class="required form-label">
                                                                Motor
                                                            </label>
                                                            <input type="text" class="form-control mb-2" name="engine" id="engine" value="" placeholder="Motor">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="cylindered" class="required form-label">
                                                                    Cilindrada
                                                                </label>
                                                                <input type="text" class="form-control mb-2" name="cylindered" id="cylindered" value="" placeholder="Cilindrada">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="transmission" class="required form-label">
                                                                Transmisión
                                                            </label>
                                                            <input type="text" class="form-control mb-2" name="transmission" id="transmission" value="" placeholder="Transmisión">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="traction" class="required form-label">
                                                                    Tracción
                                                                </label>
                                                                <input type="text" class="form-control mb-2" name="traction" id="traction" value="" placeholder="Tracción">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="commercial_date" class="required form-label">
                                                                Año comercial
                                                            </label>
                                                            <input type="number" class="form-control mb-2" name="commercial_date" id="commercial_date" value="" placeholder="Año comercial">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="origin" class="required form-label">
                                                                    Origen
                                                                </label>
                                                                <input type="text" class="form-control mb-2" name="origin" id="origin" value="" placeholder="Origen">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="factory" class="required form-label">
                                                                Fabrica
                                                            </label>
                                                            <input type="text" class="form-control mb-2" name="factory" id="factory" value="" placeholder="Fabrica">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="delivery" class="required form-label">
                                                                    Entrega
                                                                </label>
                                                                <input type="text" class="form-control mb-2" name="delivery" id="delivery" value="" placeholder="Entrega">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row row-cols-1 row-cols-sm-3 rol-cols-md-1 row-cols-lg-3">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="price" class="required form-label">
                                                                Precio
                                                            </label>
                                                            <input type="number" class="form-control mb-2" name="price" id="price" value="" placeholder="Precio">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="discount" class="form-label">
                                                                    Descuento
                                                                </label>
                                                                <input type="number" class="form-control mb-2" name="discount" id="discount" value="0" placeholder="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="order" class="form-label">
                                                                    Orden
                                                                </label>
                                                                <input type="number" class="form-control mb-2" name="order" id="order" value="" placeholder="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::General options-->

                                    </div>
                                </div>
                                <!--end::Tab pane-->
                                <!--begin::Tab pane-->
                            </div>
                            <!--end::Tab content-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <a href="{{ route('backend.vehicle.model.index') }}" id="kt_ecommerce_add_product_cancel"
                                   class="btn btn-light me-5">Cancelar</a>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                    <span class="indicator-label">Guardar cambios</span>
                                    <span class="indicator-progress">por favor espere...
													<span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--end::Main column-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
</x-app-layout>
