@push('styles')
@endpush
@push('script')
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            submitEndpoint: '{{ route("backend.vehicle.model.update") }}',
        };
    </script>
    <script src="{{ asset('backend/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('backend/assets/js/model/edit.js') }}"></script>
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
                          data-kt-redirect="{{ route('backend.vehicle.model.index') }}">
                        {{--                        @csrf--}}
                        <!--begin::Aside column-->
                        <input type="hidden" id="id" name="id" value="{{ $data->id }}">
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!--begin::Thumbnail settings-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Imagen</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body text-center pt-0">
                                    <!--begin::Image input-->
                                    <!--begin::Image input placeholder-->

                                    @php $imageAvatar = ($data->image) ? asset('storage/vehicles/'.$data->slug.'/thumbnail/'.$data->image) : asset('backend/assets/media/svg/files/blank-image.svg')  @endphp
                                    <style>
                                        .image-input-placeholder {
                                            background-image: url('{{ $imageAvatar }}');
                                        }
                                    </style>
                                    <!--end::Image input placeholder-->
                                    <div
                                        class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                        data-kt-image-input="true">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-250px h-150px"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            title="Cambiar Imagen">
                                            <i class="ki-outline ki-pencil fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" id="avatar"
                                                   required/>
                                            <input type="hidden" name="avatar_remove"/>
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            title="Cancelar imagen">
															<i class="ki-outline ki-cross fs-2"></i>
														</span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            title="Retirar imagen">
															<i class="ki-outline ki-cross fs-2"></i>
														</span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Para un óptimo funcionamiento se recomienda que las
                                        imágenes tengan formato *.png, *.jpg and *.jpeg con transparencia y sus
                                        dimensiones sean 1062px x 550px
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Thumbnail settings-->
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
                                    @php
                                        $selectedStatus = $data->status; // Replace with your actual model and column
                                        $colorType = $selectedStatus == '1' ? 'success' : 'danger';
                                    @endphp
                                    <div class="card-toolbar">
                                        <div class="rounded-circle bg-{{$colorType}} w-15px h-15px"
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
                                        <option {{ $selectedStatus == '1' ? 'selected' : '' }} value="1">Habilitado
                                        </option>
                                        <option {{ $selectedStatus == '0' ? 'selected' : '' }} value="0">No habilitado
                                        </option>
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
                                    <label class="form-label required">Tipo</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    @php($selectedType = $data->type_id)
                                    <select class="form-select mb-2" data-control="select2"
                                            name="mode_type"
                                            id="mode_type"
                                            required
                                            data-placeholder="Seleccione una opcion" data-allow-clear="true">
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}" {{ ($type->id == $selectedType) ? 'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7 mb-7">Agrega el tipo de vehículo al modelo.</div>
                                    <!--end::Description-->
                                    <!--end::Input group-->
                                    <!--begin::Button-->
                                    <a href="{{ route('backend.vehicle.type.index') }}"
                                       class="btn btn-light-primary btn-sm mb-10">
                                        <i class="ki-outline ki-plus fs-2"></i>Agregar un nuevo tipo</a>
                                    <!--end::Button-->
                                    <!--begin::Input group-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Category & tags-->
                            <!--begin::Weekly sales-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Ventas del modelo</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <span class="text-muted">Datos no disponibles. Los datos de ventas comenzarán a capturarse una vez que se haya publicado el producto.</span>
                                </div>
                                <!--end::Card body-->
                            </div>
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
                                       href="#kt_ecommerce_add_product_general">General Modelo</a>
                                </li>
                                <!--end:::Tab item-->
                                <!--begin:::Tab item-->
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"--}}
                                {{--                                       href="#kt_ecommerce_add_product_advanced">Avanzado Grados</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"--}}
                                {{--                                       href="#kt_ecommerce_add_product_advanced_colors">Avanzado Colores</a>--}}
                                {{--                                </li>--}}
                                <!--end:::Tab item-->
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
                                                    <label for="model_name" class="required form-label">Nombre del
                                                        modelo</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="model_name" id="model_name"
                                                           class="form-control mb-2" placeholder="Nombre del modelo"
                                                           value="{{ $data->name }}"/>
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Se requiere un nombre de modelo y
                                                        recomendamos que sea un nombre único.
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label">Descripcion del producto</label>
                                                    <!--end::Label-->
                                                    <!--begin::Editor-->
                                                    <div id="kt_ecommerce_add_product_description"
                                                         name="kt_ecommerce_add_product_description"
                                                         class="min-h-200px mb-2">{{ $data->description }}</div>
                                                    <!--end::Editor-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Establezca una descripción del modelo
                                                        para una mejor visibilidad.
                                                    </div>
                                                    <!--end::Description-->
                                                </div>

                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">URL de Ficha Técnica</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control mb-2" name="data_sheet"
                                                           id="data_sheet"
                                                           placeholder="https://www.nissan-cdn.net/content/dam/Nissan/BO/brochures/NBO_Frontier4x2_NLAC_Single.pdf?download=1"
                                                           value="{{ $data->data_sheet }}"/>
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Ingrese la url de la ficha tecnica.
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Orden</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="d-flex gap-3">
                                                        <input type="number" name="order" class="form-control mb-2"
                                                               id="order"
                                                               placeholder="Orden" value="{{ $data->order }}"/>
                                                    </div>
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Orden en el que ira el modelo.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="form-label">¿Se permite reserva en línea?</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="form-check form-check-custom form-check-solid mb-2">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                               name="sale_online" id="sale_online" {{ ($data->online_reservation == 1) ? 'checked' : '' }}/>
                                                        <label class="form-check-label">Si</label>
                                                    </div>
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Se permite realizar la reserva en linea
                                                        del modelo.
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::General options-->

                                    </div>
                                </div>
                                <!--end::Tab pane-->
                                <!--begin::Tab pane-->
                                {{--                                <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">--}}
                                {{--                                    <div class="d-flex flex-column gap-7 gap-lg-10">--}}
                                {{--                                        <!--begin::Inventory-->--}}
                                {{--                                        <div class="card card-flush py-4">--}}
                                {{--                                            <!--begin::Card header-->--}}
                                {{--                                            <div class="card-header">--}}
                                {{--                                                <div class="card-title">--}}
                                {{--                                                    <h2>Inventory</h2>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                            <!--begin::Card body-->--}}
                                {{--                                            <div class="card-body pt-0">--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="mb-10 fv-row">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="required form-label">SKU</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Input-->--}}
                                {{--                                                    <input type="text" name="sku" class="form-control mb-2"--}}
                                {{--                                                           placeholder="SKU Number" value=""/>--}}
                                {{--                                                    <!--end::Input-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Enter the product SKU.</div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="mb-10 fv-row">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="required form-label">Barcode</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Input-->--}}
                                {{--                                                    <input type="text" name="barcode" class="form-control mb-2"--}}
                                {{--                                                           placeholder="Barcode Number" value=""/>--}}
                                {{--                                                    <!--end::Input-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Enter the product barcode number.</div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="mb-10 fv-row">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="required form-label">Quantity</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Input-->--}}
                                {{--                                                    <div class="d-flex gap-3">--}}
                                {{--                                                        <input type="number" name="shelf" class="form-control mb-2"--}}
                                {{--                                                               placeholder="On shelf" value=""/>--}}
                                {{--                                                        <input type="number" name="warehouse" class="form-control mb-2"--}}
                                {{--                                                               placeholder="In warehouse"/>--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Input-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Enter the product quantity.</div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="fv-row">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="form-label">Allow Backorders</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Input-->--}}
                                {{--                                                    <div class="form-check form-check-custom form-check-solid mb-2">--}}
                                {{--                                                        <input class="form-check-input" type="checkbox" value=""/>--}}
                                {{--                                                        <label class="form-check-label">Yes</label>--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Input-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Allow customers to purchase products--}}
                                {{--                                                        that are out of stock.--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                        </div>--}}
                                {{--                                        <!--end::Inventory-->--}}
                                {{--                                        <!--begin::Variations-->--}}
                                {{--                                        <div class="card card-flush py-4">--}}
                                {{--                                            <!--begin::Card header-->--}}
                                {{--                                            <div class="card-header">--}}
                                {{--                                                <div class="card-title">--}}
                                {{--                                                    <h2>Variations</h2>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                            <!--begin::Card body-->--}}
                                {{--                                            <div class="card-body pt-0">--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="" data-kt-ecommerce-catalog-add-product="auto-options">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="form-label">Add Product Variations</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Repeater-->--}}
                                {{--                                                    <div id="kt_ecommerce_add_product_options">--}}
                                {{--                                                        <!--begin::Form group-->--}}
                                {{--                                                        <div class="form-group">--}}
                                {{--                                                            <div data-repeater-list="kt_ecommerce_add_product_options"--}}
                                {{--                                                                 class="d-flex flex-column gap-3">--}}
                                {{--                                                                <div data-repeater-item=""--}}
                                {{--                                                                     class="form-group d-flex flex-wrap align-items-center gap-5">--}}
                                {{--                                                                    <!--begin::Select2-->--}}
                                {{--                                                                    <div class="w-100 w-md-200px">--}}
                                {{--                                                                        <select class="form-select"--}}
                                {{--                                                                                name="product_option"--}}
                                {{--                                                                                data-placeholder="Select a variation"--}}
                                {{--                                                                                data-kt-ecommerce-catalog-add-product="product_option">--}}
                                {{--                                                                            <option></option>--}}
                                {{--                                                                            <option value="color">Color</option>--}}
                                {{--                                                                            <option value="size">Size</option>--}}
                                {{--                                                                            <option value="material">Material</option>--}}
                                {{--                                                                            <option value="style">Style</option>--}}
                                {{--                                                                        </select>--}}
                                {{--                                                                    </div>--}}
                                {{--                                                                    <!--end::Select2-->--}}
                                {{--                                                                    <!--begin::Input-->--}}
                                {{--                                                                    <input type="text"--}}
                                {{--                                                                           class="form-control mw-100 w-200px"--}}
                                {{--                                                                           name="product_option_value"--}}
                                {{--                                                                           placeholder="Variation"/>--}}
                                {{--                                                                    <!--end::Input-->--}}
                                {{--                                                                    <button type="button" data-repeater-delete=""--}}
                                {{--                                                                            class="btn btn-sm btn-icon btn-light-danger">--}}
                                {{--                                                                        <i class="ki-outline ki-cross fs-1"></i>--}}
                                {{--                                                                    </button>--}}
                                {{--                                                                </div>--}}
                                {{--                                                            </div>--}}
                                {{--                                                        </div>--}}
                                {{--                                                        <!--end::Form group-->--}}
                                {{--                                                        <!--begin::Form group-->--}}
                                {{--                                                        <div class="form-group mt-5">--}}
                                {{--                                                            <button type="button" data-repeater-create=""--}}
                                {{--                                                                    class="btn btn-sm btn-light-primary">--}}
                                {{--                                                                <i class="ki-outline ki-plus fs-2"></i>Add another--}}
                                {{--                                                                variation--}}
                                {{--                                                            </button>--}}
                                {{--                                                        </div>--}}
                                {{--                                                        <!--end::Form group-->--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Repeater-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                        </div>--}}
                                {{--                                        <!--end::Variations-->--}}
                                {{--                                        <!--begin::Shipping-->--}}
                                {{--                                        <div class="card card-flush py-4">--}}
                                {{--                                            <!--begin::Card header-->--}}
                                {{--                                            <div class="card-header">--}}
                                {{--                                                <div class="card-title">--}}
                                {{--                                                    <h2>Shipping</h2>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                            <!--begin::Card body-->--}}
                                {{--                                            <div class="card-body pt-0">--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="fv-row">--}}
                                {{--                                                    <!--begin::Input-->--}}
                                {{--                                                    <div class="form-check form-check-custom form-check-solid mb-2">--}}
                                {{--                                                        <input class="form-check-input" type="checkbox"--}}
                                {{--                                                               id="kt_ecommerce_add_product_shipping_checkbox"--}}
                                {{--                                                               value="1"/>--}}
                                {{--                                                        <label class="form-check-label">This is a physical--}}
                                {{--                                                            product</label>--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Input-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Set if the product is a physical or--}}
                                {{--                                                        digital item. Physical products may require shipping.--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                                <!--begin::Shipping form-->--}}
                                {{--                                                <div id="kt_ecommerce_add_product_shipping" class="d-none mt-10">--}}
                                {{--                                                    <!--begin::Input group-->--}}
                                {{--                                                    <div class="mb-10 fv-row">--}}
                                {{--                                                        <!--begin::Label-->--}}
                                {{--                                                        <label class="form-label">Weight</label>--}}
                                {{--                                                        <!--end::Label-->--}}
                                {{--                                                        <!--begin::Editor-->--}}
                                {{--                                                        <input type="text" name="weight" class="form-control mb-2"--}}
                                {{--                                                               placeholder="Product weight" value=""/>--}}
                                {{--                                                        <!--end::Editor-->--}}
                                {{--                                                        <!--begin::Description-->--}}
                                {{--                                                        <div class="text-muted fs-7">Set a product weight in kilograms--}}
                                {{--                                                            (kg).--}}
                                {{--                                                        </div>--}}
                                {{--                                                        <!--end::Description-->--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Input group-->--}}
                                {{--                                                    <!--begin::Input group-->--}}
                                {{--                                                    <div class="fv-row">--}}
                                {{--                                                        <!--begin::Label-->--}}
                                {{--                                                        <label class="form-label">Dimension</label>--}}
                                {{--                                                        <!--end::Label-->--}}
                                {{--                                                        <!--begin::Input-->--}}
                                {{--                                                        <div class="d-flex flex-wrap flex-sm-nowrap gap-3">--}}
                                {{--                                                            <input type="number" name="width" class="form-control mb-2"--}}
                                {{--                                                                   placeholder="Width (w)" value=""/>--}}
                                {{--                                                            <input type="number" name="height" class="form-control mb-2"--}}
                                {{--                                                                   placeholder="Height (h)" value=""/>--}}
                                {{--                                                            <input type="number" name="length" class="form-control mb-2"--}}
                                {{--                                                                   placeholder="Lengtn (l)" value=""/>--}}
                                {{--                                                        </div>--}}
                                {{--                                                        <!--end::Input-->--}}
                                {{--                                                        <!--begin::Description-->--}}
                                {{--                                                        <div class="text-muted fs-7">Enter the product dimensions in--}}
                                {{--                                                            centimeters (cm).--}}
                                {{--                                                        </div>--}}
                                {{--                                                        <!--end::Description-->--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Input group-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Shipping form-->--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                        </div>--}}
                                {{--                                        <!--end::Shipping-->--}}
                                {{--                                        <!--begin::Meta options-->--}}
                                {{--                                        <div class="card card-flush py-4">--}}
                                {{--                                            <!--begin::Card header-->--}}
                                {{--                                            <div class="card-header">--}}
                                {{--                                                <div class="card-title">--}}
                                {{--                                                    <h2>Meta Options</h2>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                            <!--begin::Card body-->--}}
                                {{--                                            <div class="card-body pt-0">--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="mb-10">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="form-label">Meta Tag Title</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Input-->--}}
                                {{--                                                    <input type="text" class="form-control mb-2" name="meta_title"--}}
                                {{--                                                           placeholder="Meta tag name"/>--}}
                                {{--                                                    <!--end::Input-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Set a meta tag title. Recommended to be--}}
                                {{--                                                        simple and precise keywords.--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="mb-10">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="form-label">Meta Tag Description</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Editor-->--}}
                                {{--                                                    <div id="kt_ecommerce_add_product_meta_description"--}}
                                {{--                                                         name="kt_ecommerce_add_product_meta_description"--}}
                                {{--                                                         class="min-h-100px mb-2"></div>--}}
                                {{--                                                    <!--end::Editor-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Set a meta tag description to the--}}
                                {{--                                                        product for increased SEO ranking.--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div>--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="form-label">Meta Tag Keywords</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Editor-->--}}
                                {{--                                                    <input id="kt_ecommerce_add_product_meta_keywords"--}}
                                {{--                                                           name="kt_ecommerce_add_product_meta_keywords"--}}
                                {{--                                                           class="form-control mb-2"/>--}}
                                {{--                                                    <!--end::Editor-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Set a list of keywords that the product--}}
                                {{--                                                        is related to. Separate the keywords by adding a comma--}}
                                {{--                                                        <code>,</code>between each keyword.--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                        </div>--}}
                                {{--                                        <!--end::Meta options-->--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}


                                {{--                                <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced_colors"--}}
                                {{--                                     role="tab-panel">--}}
                                {{--                                    <div class="d-flex flex-column gap-7 gap-lg-10">--}}
                                {{--                                        <!--begin::Inventory-->--}}
                                {{--                                        <div class="card card-flush py-4">--}}
                                {{--                                            <!--begin::Card header-->--}}
                                {{--                                            <div class="card-header">--}}
                                {{--                                                <div class="card-title">--}}
                                {{--                                                    <h2>Inventory</h2>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                            <!--begin::Card body-->--}}
                                {{--                                            <div class="card-body pt-0">--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="mb-10 fv-row">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="required form-label">SKU</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Input-->--}}
                                {{--                                                    <input type="text" name="sku" class="form-control mb-2"--}}
                                {{--                                                           placeholder="SKU Number" value=""/>--}}
                                {{--                                                    <!--end::Input-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Enter the product SKU.</div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="mb-10 fv-row">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="required form-label">Barcode</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Input-->--}}
                                {{--                                                    <input type="text" name="barcode" class="form-control mb-2"--}}
                                {{--                                                           placeholder="Barcode Number" value=""/>--}}
                                {{--                                                    <!--end::Input-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Enter the product barcode number.</div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="mb-10 fv-row">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="required form-label">Quantity</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Input-->--}}
                                {{--                                                    <div class="d-flex gap-3">--}}
                                {{--                                                        <input type="number" name="shelf" class="form-control mb-2"--}}
                                {{--                                                               placeholder="On shelf" value=""/>--}}
                                {{--                                                        <input type="number" name="warehouse" class="form-control mb-2"--}}
                                {{--                                                               placeholder="In warehouse"/>--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Input-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Enter the product quantity.</div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="fv-row">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="form-label">Allow Backorders</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Input-->--}}
                                {{--                                                    <div class="form-check form-check-custom form-check-solid mb-2">--}}
                                {{--                                                        <input class="form-check-input" type="checkbox" value=""/>--}}
                                {{--                                                        <label class="form-check-label">Yes</label>--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Input-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Allow customers to purchase products--}}
                                {{--                                                        that are out of stock.--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                        </div>--}}
                                {{--                                        <!--end::Inventory-->--}}
                                {{--                                        <!--begin::Variations-->--}}
                                {{--                                        <div class="card card-flush py-4">--}}
                                {{--                                            <!--begin::Card header-->--}}
                                {{--                                            <div class="card-header">--}}
                                {{--                                                <div class="card-title">--}}
                                {{--                                                    <h2>Variations</h2>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                            <!--begin::Card body-->--}}
                                {{--                                            <div class="card-body pt-0">--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="" data-kt-ecommerce-catalog-add-product="auto-options">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="form-label">Add Product Variations</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Repeater-->--}}
                                {{--                                                    <div id="kt_ecommerce_add_product_options">--}}
                                {{--                                                        <!--begin::Form group-->--}}
                                {{--                                                        <div class="form-group">--}}
                                {{--                                                            <div data-repeater-list="kt_ecommerce_add_product_options"--}}
                                {{--                                                                 class="d-flex flex-column gap-3">--}}
                                {{--                                                                <div data-repeater-item=""--}}
                                {{--                                                                     class="form-group d-flex flex-wrap align-items-center gap-5">--}}
                                {{--                                                                    <!--begin::Select2-->--}}
                                {{--                                                                    <div class="w-100 w-md-200px">--}}
                                {{--                                                                        <select class="form-select"--}}
                                {{--                                                                                name="product_option"--}}
                                {{--                                                                                data-placeholder="Select a variation"--}}
                                {{--                                                                                data-kt-ecommerce-catalog-add-product="product_option">--}}
                                {{--                                                                            <option></option>--}}
                                {{--                                                                            <option value="color">Color</option>--}}
                                {{--                                                                            <option value="size">Size</option>--}}
                                {{--                                                                            <option value="material">Material</option>--}}
                                {{--                                                                            <option value="style">Style</option>--}}
                                {{--                                                                        </select>--}}
                                {{--                                                                    </div>--}}
                                {{--                                                                    <!--end::Select2-->--}}
                                {{--                                                                    <!--begin::Input-->--}}
                                {{--                                                                    <input type="text"--}}
                                {{--                                                                           class="form-control mw-100 w-200px"--}}
                                {{--                                                                           name="product_option_value"--}}
                                {{--                                                                           placeholder="Variation"/>--}}
                                {{--                                                                    <!--end::Input-->--}}
                                {{--                                                                    <button type="button" data-repeater-delete=""--}}
                                {{--                                                                            class="btn btn-sm btn-icon btn-light-danger">--}}
                                {{--                                                                        <i class="ki-outline ki-cross fs-1"></i>--}}
                                {{--                                                                    </button>--}}
                                {{--                                                                </div>--}}
                                {{--                                                            </div>--}}
                                {{--                                                        </div>--}}
                                {{--                                                        <!--end::Form group-->--}}
                                {{--                                                        <!--begin::Form group-->--}}
                                {{--                                                        <div class="form-group mt-5">--}}
                                {{--                                                            <button type="button" data-repeater-create=""--}}
                                {{--                                                                    class="btn btn-sm btn-light-primary">--}}
                                {{--                                                                <i class="ki-outline ki-plus fs-2"></i>Add another--}}
                                {{--                                                                variation--}}
                                {{--                                                            </button>--}}
                                {{--                                                        </div>--}}
                                {{--                                                        <!--end::Form group-->--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Repeater-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                        </div>--}}
                                {{--                                        <!--end::Variations-->--}}
                                {{--                                        <!--begin::Shipping-->--}}
                                {{--                                        <div class="card card-flush py-4">--}}
                                {{--                                            <!--begin::Card header-->--}}
                                {{--                                            <div class="card-header">--}}
                                {{--                                                <div class="card-title">--}}
                                {{--                                                    <h2>Shipping</h2>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                            <!--begin::Card body-->--}}
                                {{--                                            <div class="card-body pt-0">--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="fv-row">--}}
                                {{--                                                    <!--begin::Input-->--}}
                                {{--                                                    <div class="form-check form-check-custom form-check-solid mb-2">--}}
                                {{--                                                        <input class="form-check-input" type="checkbox"--}}
                                {{--                                                               id="kt_ecommerce_add_product_shipping_checkbox"--}}
                                {{--                                                               value="1"/>--}}
                                {{--                                                        <label class="form-check-label">This is a physical--}}
                                {{--                                                            product</label>--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Input-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Set if the product is a physical or--}}
                                {{--                                                        digital item. Physical products may require shipping.--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                                <!--begin::Shipping form-->--}}
                                {{--                                                <div id="kt_ecommerce_add_product_shipping" class="d-none mt-10">--}}
                                {{--                                                    <!--begin::Input group-->--}}
                                {{--                                                    <div class="mb-10 fv-row">--}}
                                {{--                                                        <!--begin::Label-->--}}
                                {{--                                                        <label class="form-label">Weight</label>--}}
                                {{--                                                        <!--end::Label-->--}}
                                {{--                                                        <!--begin::Editor-->--}}
                                {{--                                                        <input type="text" name="weight" class="form-control mb-2"--}}
                                {{--                                                               placeholder="Product weight" value=""/>--}}
                                {{--                                                        <!--end::Editor-->--}}
                                {{--                                                        <!--begin::Description-->--}}
                                {{--                                                        <div class="text-muted fs-7">Set a product weight in kilograms--}}
                                {{--                                                            (kg).--}}
                                {{--                                                        </div>--}}
                                {{--                                                        <!--end::Description-->--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Input group-->--}}
                                {{--                                                    <!--begin::Input group-->--}}
                                {{--                                                    <div class="fv-row">--}}
                                {{--                                                        <!--begin::Label-->--}}
                                {{--                                                        <label class="form-label">Dimension</label>--}}
                                {{--                                                        <!--end::Label-->--}}
                                {{--                                                        <!--begin::Input-->--}}
                                {{--                                                        <div class="d-flex flex-wrap flex-sm-nowrap gap-3">--}}
                                {{--                                                            <input type="number" name="width" class="form-control mb-2"--}}
                                {{--                                                                   placeholder="Width (w)" value=""/>--}}
                                {{--                                                            <input type="number" name="height" class="form-control mb-2"--}}
                                {{--                                                                   placeholder="Height (h)" value=""/>--}}
                                {{--                                                            <input type="number" name="length" class="form-control mb-2"--}}
                                {{--                                                                   placeholder="Lengtn (l)" value=""/>--}}
                                {{--                                                        </div>--}}
                                {{--                                                        <!--end::Input-->--}}
                                {{--                                                        <!--begin::Description-->--}}
                                {{--                                                        <div class="text-muted fs-7">Enter the product dimensions in--}}
                                {{--                                                            centimeters (cm).--}}
                                {{--                                                        </div>--}}
                                {{--                                                        <!--end::Description-->--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Input group-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Shipping form-->--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                        </div>--}}
                                {{--                                        <!--end::Shipping-->--}}
                                {{--                                        <!--begin::Meta options-->--}}
                                {{--                                        <div class="card card-flush py-4">--}}
                                {{--                                            <!--begin::Card header-->--}}
                                {{--                                            <div class="card-header">--}}
                                {{--                                                <div class="card-title">--}}
                                {{--                                                    <h2>Meta Options</h2>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                            <!--begin::Card body-->--}}
                                {{--                                            <div class="card-body pt-0">--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="mb-10">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="form-label">Meta Tag Title</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Input-->--}}
                                {{--                                                    <input type="text" class="form-control mb-2" name="meta_title"--}}
                                {{--                                                           placeholder="Meta tag name"/>--}}
                                {{--                                                    <!--end::Input-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Set a meta tag title. Recommended to be--}}
                                {{--                                                        simple and precise keywords.--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div class="mb-10">--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="form-label">Meta Tag Description</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Editor-->--}}
                                {{--                                                    <div id="kt_ecommerce_add_product_meta_description"--}}
                                {{--                                                         name="kt_ecommerce_add_product_meta_description"--}}
                                {{--                                                         class="min-h-100px mb-2"></div>--}}
                                {{--                                                    <!--end::Editor-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Set a meta tag description to the--}}
                                {{--                                                        product for increased SEO ranking.--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                                <!--begin::Input group-->--}}
                                {{--                                                <div>--}}
                                {{--                                                    <!--begin::Label-->--}}
                                {{--                                                    <label class="form-label">Meta Tag Keywords</label>--}}
                                {{--                                                    <!--end::Label-->--}}
                                {{--                                                    <!--begin::Editor-->--}}
                                {{--                                                    <input id="kt_ecommerce_add_product_meta_keywords"--}}
                                {{--                                                           name="kt_ecommerce_add_product_meta_keywords"--}}
                                {{--                                                           class="form-control mb-2"/>--}}
                                {{--                                                    <!--end::Editor-->--}}
                                {{--                                                    <!--begin::Description-->--}}
                                {{--                                                    <div class="text-muted fs-7">Set a list of keywords that the product--}}
                                {{--                                                        is related to. Separate the keywords by adding a comma--}}
                                {{--                                                        <code>,</code>between each keyword.--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <!--end::Description-->--}}
                                {{--                                                </div>--}}
                                {{--                                                <!--end::Input group-->--}}
                                {{--                                            </div>--}}
                                {{--                                            <!--end::Card header-->--}}
                                {{--                                        </div>--}}
                                {{--                                        <!--end::Meta options-->--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <!--end::Tab pane-->
                            </div>
                            <!--end::Tab content-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <a href="{{ route('backend.vehicle.model.index') }}"
                                   id="kt_ecommerce_add_product_cancel"
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
