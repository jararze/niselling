@push('styles')
@endpush
@push('script')
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            submitEndpoint: '{{ route("backend.vehicle.color.update") }}',
        };
    </script>
    <script src="{{ asset('backend/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('backend/assets/js/color/edit.js') }}"></script>
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
                          data-kt-redirect="{{ route('backend.vehicle.color.index') }}">
                        {{--                        @csrf--}}
                        <!--begin::Aside column-->
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
                                    @php $imageAvatar = ($data->image) ? asset('storage/vehicles/color/'.$data->modelOfCar->name.'/thumbnail/'.$data->image) : asset('backend/assets/media/svg/files/blank-image.svg')  @endphp
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
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" id="avatar" required />
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
                                    @php($selectedType = $data->model_of_cars_id)
                                    <select class="form-select mb-2" data-control="select2"
                                            name="mode_type"
                                            id="mode_type"
                                            required
                                            data-placeholder="Seleccione una opcion" data-allow-clear="true">
                                        @foreach($models as $model)
                                            <option value="{{ $model->id }}" {{ ($model->id == $selectedType) ? 'selected' : '' }}>{{ $model->name }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7 mb-7">Agrega el modelo de vehículo al modelo.</div>
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
                        </div>
                        <!--end::Aside column-->
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <!--begin:::Tabs-->
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                       href="#kt_ecommerce_add_product_general">General Color</a>
                                </li>
                                <!--end:::Tab item-->
                                <!--begin:::Tab item-->
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
                                                    <label for="name" class="required form-label">Nombre del color</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                                                    <input type="text" name="name" id="name"
                                                           class="form-control mb-2" placeholder="Nombre del color"
                                                           value="{{ $data->name }}"/>
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Se requiere un nombre de modelo y recomendamos que sea un nombre único.
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->

                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label for="color_code" class="required form-label">Código de color</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control mb-2" name="color_code" id="color_code"
                                                           placeholder="#c1c1c1" value="{{ $data->color_code }}"/>
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Ingrese el código hexadecimal del color sin el símbolo #</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label for="order" class="required form-label">Orden</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="d-flex gap-3">
                                                        <input type="number" name="order" class="form-control mb-2" id="order"
                                                               placeholder="Orden" value="{{ $data->order }}"/>
                                                    </div>
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Orden en el que ira el color.</div>
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
