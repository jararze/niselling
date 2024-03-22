@push('styles')

@endpush
@push('script')
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            submitEndpoint: '{{ route("backend.configuration.agent.update") }}',
        };
    </script>
    <script src="{{ asset('backend/assets/js/configuration/agent/edit.js') }}"></script>
@endpush
<x-app-layout>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">

                    <div class="card mb-10">
                        <!--begin::Card body-->
                        <div class="card-body p-5 p-lg-10">
                            <!--begin::Title-->
                            <h1 class="fw-bold text-gray-900 ps-0">Editar Agente</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Card body-->
                    </div>

                    <form id="kt_type_edit_form" class="form d-flex flex-column flex-lg-row"
                          data-kt-redirect="{{ route('backend.configuration.agent.index') }}">
                        <!--begin::Aside column-->
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!--begin::Status-->
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Estado</h2>
                                    </div>
                                    @php
                                        $selectedType = $data->status; // Replace with your actual model and column
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

                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Showroom</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">

                                    <label for="showroom" class="required form-label">Seleccione un showroom</label>
                                    @php($selectedType = $data->showroom)
                                    <select class="form-select mb-2" data-control="select2"
                                            name="showroom"
                                            id="showroom"
                                            required
                                            data-placeholder="Seleccione una opcion" data-allow-clear="true">
                                        @foreach($showrooms as $showroom)
                                            <option value="{{ $showroom->id }}" {{ ($showroom->id == $selectedType) ? 'selected' : '' }}>{{ $showroom->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-muted fs-7">Se requiere y se recomienda que un seleccione un showroom.
                                    </div>

                                </div>
                            </div>


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
                                        <label for="name" class="required form-label">Nombre Agente</label>
                                        <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                                        <input id="name" type="text" name="name" class="form-control mb-2"
                                               placeholder="Nombre agente" value="{{ $data->name }}"/>
                                        <div class="text-muted fs-7">Se requiereel nombre del agente.
                                        </div>
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label for="phone" class="required form-label">Teléfono</label>
                                        <input id="phone" type="text" name="phone" class="form-control mb-2"
                                               placeholder="Nombre agente" value="{{ $data->phone }}"/>
                                        <div class="text-muted fs-7">Se requiere el telefono del agente.
                                        </div>
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label for="email" class="required form-label">Email</label>
                                        <input id="email" type="text" name="email" class="form-control mb-2"
                                               placeholder="Nombre agente" value="{{ $data->email }}"/>
                                        <div class="text-muted fs-7">Se requiere el email del agente.
                                        </div>
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
