@push('styles')
@endpush
@push('script')
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            submitEndpoint: '{{ route("backend.vehicle.grade.update") }}',
        };
    </script>
    <script src="{{ asset('backend/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('backend/assets/js/grade/edit.js') }}"></script>
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
                    <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row"
                          {{--                          action="{{ route('backend.vehicle.model.store') }}" method="POST" enctype="multipart/form-data">--}}
                          data-kt-redirect="{{ route('backend.vehicle.grade.index') }}">
                        {{--                        @csrf--}}
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Imagen</h2>
                                    </div>
                                </div>
                                <div class="card-body text-center pt-0">
{{--                                    @dd($quote)--}}
                                    @php $imageAvatar = ($quote->colorOfCar->image) ? asset('storage/vehicles/'.$quote->colorOfCar->modelOfCar->slug .'/thumbnail/'.$quote->colorOfCar->image) : asset('backend/assets/media/svg/files/blank-image.svg')  @endphp
                                    <style>
                                        .image-input-placeholder {
                                            background-image: url('{{ $imageAvatar }}');
                                            /*background-size: 90%;*/
                                            background-repeat: no-repeat;
                                            background-position: center;
                                        }
                                    </style>
                                    <div
                                        class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                        data-kt-image-input="true">
                                        <div class="image-input-wrapper w-250px h-150px"></div>
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            title="Cancelar imagen">
															<i class="ki-outline ki-cross fs-2"></i>
														</span>
                                    </div>
                                </div>
                            </div>

                            @if($quote->way_to_pay)
                                @if($quote->way_to_pay == 'online_libelula')
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>
                                                    Pago {{ is_null($quote->libelula_id_response) ? 'pendiente' : 'procesado' }}</h2>
                                            </div>
                                            @php
                                                $selectedStatus = is_null($quote->libelula_id_response);
                                                $colorType = $selectedStatus ? 'danger' : 'success';
                                            @endphp
                                            <div class="card-toolbar">
                                                <div class="rounded-circle bg-{{$colorType}} w-15px h-15px"
                                                     id="kt_ecommerce_add_product_status"></div>
                                            </div>

                                        </div>
                                        <div class="card-body text-center pt-0">
                                            @if($selectedStatus)
                                                <div class="text fs-12">No hay confirmación automatica de pago de parte de Libelula, por favor realizar la verificacion manual pulsando el boton.
                                                </div>

                                                <a href="{{ route('backend.quote.verify.payment', $quote->codigo_recaudacion) }}"
                                                   class="btn me-5 mt-4"
                                                   style="background-color: #c3002f; color: white; transition: opacity .2s;"
                                                   onmouseover="this.style.opacity='0.5';"
                                                   onmouseout="this.style.opacity='1.0';">Verificar Pago</a>
                                            @else
                                                <div class="text fs-12">Pago realizado. Id de transaccion: <strong>{{ $quote->libelula_id_response }}</strong>
                                                </div>

                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Comprobante</h2>
                                            </div>
                                        </div>
                                        <div class="card-body text-center pt-0">

                                            @php
                                                $isPdf = false;
                                                $filePath = ($quote->way_to_pay_image) ? 'storage/vaucher/' . $quote->id .'/' . $quote->way_to_pay_image : 'backend/assets/media/svg/files/blank-image.svg';
                                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                if(strtolower($fileExtension) == 'pdf') {
                                                    $isPdf = true;
                                                    $pdfFile = asset($filePath);
                                                } else {
                                                    $image = asset($filePath);
                                                }
                                            @endphp

                                            @if($isPdf)
                                                <embed src="{{$pdfFile}}" type="application/pdf" width="250"
                                                       height="200"/>
                                                <p><a href="{{$pdfFile}}" download>Descarga el comprobante</a></p>
                                            @else
                                                <style>
                                                    .image-input-placeholder2 {
                                                        background-image: url('{{ $image }}');
                                                        background-repeat: no-repeat;
                                                        background-position: center;
                                                    }
                                                </style>
                                                <div
                                                    class="image-input image-input-empty image-input-outline image-input-placeholder2 mb-3"
                                                    data-kt-image-input="true">
                                                    <div class="image-input-wrapper w-250px h-450px"></div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            @endif

                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Estatus {{ ($quote->status == 'crm') ? 'procesado' : 'pendiente' }}</h2>
                                    </div>
                                    @php
                                        $selectedStatus = $quote->status;
                                        $colorType = $selectedStatus == 'crm' ? 'success' : 'danger';
                                    @endphp
                                    <div class="card-toolbar">
                                        <div class="rounded-circle bg-{{$colorType}} w-15px h-15px"
                                             id="kt_ecommerce_add_product_status"></div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    @if($selectedStatus == 'crm')
                                        <div class="text fs-12">Tecnom devolvió un status correcto, por lo que la
                                            solicitud quedo guardada en el CRM
                                        </div>
                                    @else
                                        <div class="text fs-12">No hay confirmación de que Tecnom recibiió la
                                            información, o existio un fallo en el medio. Presione el boton para enviar
                                            nuevamente la información a TECNOM
                                        </div>

                                        <a href="{{ route('backend.quote.resend.information', $quote->id) }}"
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
                                       href="#kt_ecommerce_add_product_general">Cotización</a>
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
                                                    <h2>Infomración de la cotización</h2>
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label for="model_name" class="form-label">Nombre de la
                                                        cotizacion</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="hidden" name="id" id="id" value="{{ $quote->id }}">
                                                    <input type="text"
                                                           name="model_name"
                                                           id="model_name"
                                                           readonly
                                                           class="form-control mb-2 bg-gray-300 hover:bg-gray-300"
                                                           value="{{ $quote->name }} {{ $quote->last_name }}"/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->

                                                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="engine" class="form-label">
                                                                Modelo
                                                            </label>
                                                            <input type="text" class="form-control mb-2 bg-gray-300"
                                                                   name="engine" id="engine"
                                                                   value="{{ $quote->modelOfCar->name }}"
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="cylindered" class="form-label">
                                                                    Grado
                                                                </label>
                                                                <input type="text" class="form-control mb-2 bg-gray-300"
                                                                       name="cylindered" id="cylindered"
                                                                       value="{{ $quote->gradeOfCar->name }}"
                                                                       readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="transmission" class="form-label">
                                                                Teléfono
                                                            </label>
                                                            <input type="text" class="form-control mb-2 bg-gray-300"
                                                                   name="transmission" id="transmission"
                                                                   value="{{ $quote->phone }}"
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="traction" class="form-label">
                                                                    Email
                                                                </label>
                                                                <input type="text" class="form-control mb-2 bg-gray-300"
                                                                       name="traction" id="traction"
                                                                       value="{{ $quote->email }}"
                                                                       readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="commercial_date" class="form-label">
                                                                Ciudad
                                                            </label>
                                                            <input type="text" class="form-control mb-2 bg-gray-300"
                                                                   name="commercial_date" id="commercial_date"
                                                                   value="{{ $quote->cityOfCar->name }}"
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="origin" class="form-label">
                                                                    Showroom
                                                                </label>
                                                                <input type="text" class="form-control mb-2 bg-gray-300"
                                                                       name="origin" id="origin"
                                                                       value="{{ $quote->showroomOfCar->name }}"
                                                                       readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="factory" class="form-label">
                                                                Carnet de identidad
                                                            </label>
                                                            <input type="text" class="form-control mb-2 bg-gray-300"
                                                                   name="factory" id="factory"
                                                                   value="{{ $quote->dni }} {{ $quote->ext }}"
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="delivery" class="form-label">
                                                                    Color
                                                                </label>
                                                                <input type="text" class="form-control mb-2 bg-gray-300"
                                                                       name="delivery" id="delivery"
                                                                       value="{{ $quote->colorOfCar->name }}"
                                                                       readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row row-cols-1 row-cols-sm-3 rol-cols-md-1 row-cols-lg-3">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="price" class="form-label">
                                                                Tecnom ID respuesta
                                                            </label>
                                                            <input type="text" class="form-control mb-2 bg-gray-300"
                                                                   name="price" id="price"
                                                                   value="{{ $quote->tecnom_id }}"
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="discount" class="form-label">
                                                                    Requiere test drive
                                                                </label>

                                                                <input
                                                                    type="text"
                                                                    class="form-control mb-2 bg-gray-300"
                                                                    name="discount"
                                                                    id="discount"
                                                                    value="{{ ($quote->test_drive == 1) ? 'Si' : 'No' }}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="order" class="form-label">
                                                                    Agente
                                                                </label>
                                                                <input type="text" class="form-control mb-2 bg-gray-300"
                                                                       name="order" id="order"
                                                                       value="{{ $quote->agentOfCar->name ?? 'Sin Informacion' }}"
                                                                       readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-cols-1 row-cols-sm-3 rol-cols-md-1 row-cols-lg-3">
                                                    <div class="col">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <label for="price" class="form-label">
                                                                Lead / Contacto
                                                            </label>
                                                            <input
                                                                type="text"
                                                                class="form-control mb-2 bg-gray-300"
                                                                name="lead"
                                                                id="lead"
                                                                value="{{ ($quote->type_contact == 'whatsapp') ? 'Whatsapp' : (($quote->type_contact == 'phone') ? 'Teléfono' : (($quote->type_contact == 'online') ? 'Pago Online' : 'Sin contacto')) }}"
                                                                placeholder=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="discount" class="form-label">
                                                                    Tipo de pago
                                                                </label>

                                                                <input
                                                                    type="text"
                                                                    class="form-control mb-2 bg-gray-300"
                                                                    name="discount"
                                                                    id="discount"
                                                                    value="{{ ($quote->way_to_pay == "online_libelula") ? 'Mediante Libelula' : (($quote->way_to_pay == "transferencia_bancaria") ? 'Transferencia Bancaria' : 'Lead sin procesar') }}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fv-row mb-7">
                                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                <label for="order" class="form-label">
                                                                    Solicitud
                                                                </label>
                                                                @php
                                                                    \Carbon\Carbon::setLocale('es');
                                                                @endphp
                                                                <input type="text" class="form-control mb-2 bg-gray-300"
                                                                       name="order" id="order"
                                                                       value="{{ $quote->created_at->translatedFormat('j \d\e F \d\e\l Y \a \l\a\s H:i \h\o\r\a\s') }}"
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

                                <a href="{{ route('frontend.quote.pdf', $quote->id) }}"
                                   class="btn mr-5"
                                   style="background-color: #c3002f; color: white; transition: opacity .2s; margin-right: 10px"
                                   onmouseover="this.style.opacity='0.5';" onmouseout="this.style.opacity='1.0';">Descargar
                                    cotizacion en PDF</a>

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
