@push('styles')

@endpush
@push('script')
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            submitEndpoint: '{{ route("backend.vehicle.type.update") }}',
        };
    </script>
    <script src="{{ asset('backend/assets/js/types/edit.js') }}"></script>
@endpush
<x-app-layout>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <form id="kt_type_edit_form" class="form d-flex flex-column flex-lg-row"
                          data-kt-redirect="{{ route('backend.vehicle.type.index') }}">
                        <!--begin::Aside column-->
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!--begin::Status-->
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Estado</h2>
                                    </div>
                                    @php
                                        $selectedType = $data->available; // Replace with your actual model and column
                                        $colorType = $selectedType == '1' ? 'success' : 'danger';
                                    @endphp
                                    <div class="card-toolbar">
                                        <div class="rounded-circle bg-{{$colorType}} w-15px h-15px"
                                             id="kt_ecommerce_add_category_status"></div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                            data-placeholder="Seleccione una opcion"
                                            name="status"
                                            id="kt_ecommerce_add_category_status_select">
                                        <option></option>
                                        <option {{ $selectedType == '1' ? 'selected' : '' }} value="1">Habilitado
                                        </option>
                                        <option {{ $selectedType == '0' ? 'selected' : '' }} value="0">No habilitado
                                        </option>
                                    </select>
                                    <div class="text-muted fs-7">Establece el estado del tipod e vehículo.</div>
                                </div>
                            </div>
                            <!--end::Status-->
                        </div>
                        <!--end::Aside column-->
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Información general</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label for="type_name" class="required form-label">Tipo de vehículo</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                                        <input id="type_name" type="text" name="type_name" class="form-control mb-2"
                                               placeholder="Tipo de vehículo" value="{{ $data->name }}"/>
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Se requiere y se recomienda que un nombre de
                                            categoría sea único.
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::General options-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <a href="{{ route('backend.vehicle.type.index') }}" id="kt_ecommerce_add_product_cancel"
                                   class="btn btn-light me-5">Cancelar</a>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" id="kt_type_edit_submit" class="btn btn-primary">
                                    <span class="indicator-label">Grabar cambios</span>
                                    <span class="indicator-progress">Por favor espere...
													<span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--end::Main column-->
                    </form>
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>

</x-app-layout>
