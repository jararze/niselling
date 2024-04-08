@push('styles')
@endpush
@push('script')
{{--    <script type="text/javascript">--}}
{{--        window.Laravel = {--}}
{{--            csrfToken: '{{ csrf_token() }}',--}}
{{--            submitEndpoint: '{{ route("backend.vehicle.grade.update") }}',--}}
{{--        };--}}
{{--    </script>--}}
{{--    <script src="{{ asset('backend/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>--}}
{{--    <script src="{{ asset('backend/assets/js/grade/edit.js') }}"></script>--}}
    {{--    <script src="{{ asset('backend/assets/js/contact/contact.js') }}"></script>--}}
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
                    <div class="form d-flex flex-column flex-lg-row">
                          {{--                          action="{{ route('backend.vehicle.model.store') }}" method="POST" enctype="multipart/form-data">--}}
                        {{--                        @csrf--}}
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Estatus {{ is_null($data->tecnom_id) ? 'pendiente' : 'procesado' }}</h2>
                                    </div>
                                    @php
                                        $selectedStatus = is_null($data->tecnom_id);
                                        $colorType = $selectedStatus ? 'danger' : 'success';
                                    @endphp
                                    <div class="card-toolbar">
                                        <div class="rounded-circle bg-{{$colorType}} w-15px h-15px"
                                             id="kt_ecommerce_add_product_status"></div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    @if($selectedStatus != true)
                                        <div class="text fs-12">Tecnom devolvió un status correcto, por lo que la
                                            solicitud quedo guardada en el CRM
                                        </div>
                                    @else
                                        <div class="text fs-12">No hay confirmación de que Tecnom recibiió la
                                            información, o existio un fallo en el medio. Presione el boton para enviar
                                            nuevamente la información a TECNOM
                                        </div>

                                        <a href="{{ route('backend.whatsapp.resend.information', $data->id) }}"
                                           class="btn me-5 mt-4"
                                           style="background-color: #c3002f; color: white; transition: opacity .2s;"
                                           onmouseover="this.style.opacity='0.5';"
                                           onmouseout="this.style.opacity='1.0';">Reprocesar la información</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                       href="#kt_ecommerce_add_product_general">Contacto</a>
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
                                                    <h2>Infomración del contacto</h2>
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label for="name" class="form-label">Nombre del contacto</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                                                    <input type="text"
                                                           name="name"
                                                           id="name"
                                                           readonly
                                                           class="form-control mb-2 bg-gray-300 hover:bg-gray-300"
                                                           value="{{ $data->name }}"/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->

                                                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="email" class="form-label">
                                                                Email
                                                            </label>
                                                            <input type="text" class="form-control mb-2 bg-gray-300"
                                                                   name="email" id="email"
                                                                   value="{{ $data->email }}"
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="cellphone" class="form-label">
                                                                    Telefono
                                                                </label>
                                                                <input type="text" class="form-control mb-2 bg-gray-300"
                                                                       name="cellphone" id="cellphone"
                                                                       value="{{ $data->cellphone }}"
                                                                       readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <label for="pageUrl" class="form-label">
                                                        Pagina de donde nos escribe
                                                    </label>
                                                    <input type="text" class="form-control mb-2 bg-gray-300"
                                                           name="pageUrl" id="pageUrl"
                                                           value="{{ $data->pageUrl }}"
                                                           readonly>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="tecnom_id" class="form-label">
                                                                Tecnom ID respuesta
                                                            </label>
                                                            <input type="text" class="form-control mb-2 bg-gray-300"
                                                                   name="tecnom_id" id="tecnom_id"
                                                                   value="{{ is_null($data->tecnom_id) ? "Sin informacion" : $data->tecnom_id }}"
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="error" class="form-label">
                                                                    Error
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control mb-2 bg-gray-300"
                                                                    name="error"
                                                                    id="error"
                                                                    value="{{ is_null($data->error_tecnom) ? "Sin informacion" : $data->error_tecnom }}"
                                                                    readonly>
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
                                <a href="{{ route('backend.whatsapp.index') }}"
                                   id="kt_ecommerce_add_product_cancel"
                                   class="btn btn-light me-5">Cancelar</a>
                                <!--end::Button-->
                                <!--begin::Button-->

                                <!--end::Button-->
                            </div>
                        </div>
                        <!--end::Main column-->
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
</x-app-layout>
