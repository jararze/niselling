@push('styles')
@endpush
@push('script')
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            totalLeads: {!! json_encode($arrayWithDates) !!},
            totalWithPayment: {!! json_encode($arrayWithPayment) !!},
            totalTypeContact: {!! json_encode($arrayTypeContact) !!},
            topSellingModels: {!! json_encode($topSellingModels) !!},
            topSellingGrades: {!! json_encode($topSellingGrades) !!},
            modelQuotesCount: {!! json_encode($modelQuotesCount) !!},
            typesMonth: {!! json_encode($typesMonth) !!},
        };
    </script>
    <script src="{{ asset('backend/assets/js/dashboard/index.js') }}"></script>
@endpush

<x-app-layout>
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Row-->
                    <div class="row gy-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-4 mb-xl-10">
                            <!--begin::Engage widget 1-->
                            <div class="card h-md-100" dir="ltr">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column flex-center">
                                    <!--begin::Heading-->
                                    <div class="mb-2">
                                        <!--begin::Title-->
                                        <h1 class="fw-semibold text-gray-800 text-center lh-lg">Enlace rapido a
                                            <br/>
                                            <span class="fw-bolder">Crear un nuevo grado</span></h1>
                                        <!--end::Title-->
                                        <!--begin::Illustration-->
                                        <div class="py-10 text-center">
                                            <img src="{{ asset('backend/assets/media/svg/illustrations/easy/3.svg') }}"
                                                 class="theme-light-show w-200px" alt=""/>
                                            <img
                                                src="{{ asset('backend/assets/media/svg/illustrations/easy/3-dark.svg') }}"
                                                class="theme-dark-show w-200px" alt=""/>
                                        </div>
                                        <!--end::Illustration-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Links-->
                                    <div class="text-center mb-1">
                                        <!--begin::Link-->
                                        <a class="btn btn-sm btn-primary me-2" data-bs-target="#kt_modal_bidding"
                                           data-bs-toggle="modal">Crear Grado</a>
                                        <!--end::Link-->
                                        <!--begin::Link-->
                                        <!--end::Link-->
                                    </div>
                                    <!--end::Links-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Engage widget 1-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-8 mb-5 mb-xl-10">
                            <!--begin::Row-->
                            <div class="row g-lg-5 g-xl-10">
                                <!--begin::Col-->
                                <div class="col-md-6 col-xl-6 mb-5 mb-xl-10">
                                    <!--begin::Card widget 12-->
                                    <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                            <!--begin::Statistics-->
                                            <div class="mb-4 px-9">
                                                <!--begin::Info-->
                                                <div class="d-flex align-items-center mb-2">
                                                    <!--begin::Value-->
                                                    <span
                                                        class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{ is_null($quotesPastMonth) ? '0' : $quotesPastMonth }}</span>
                                                    <!--end::Value-->
                                                    <!--begin::Label-->
                                                    <span class="d-flex align-items-end text-gray-500 fs-6 fw-semibold">Leads</span>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Description-->
                                                <span class="fs-6 fw-semibold text-gray-500">Leads en los últimos 15 días.</span>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Statistics-->
                                            <!--begin::Chart-->
                                            <div id="leadsCount" class="min-h-auto" style="height: 125px"></div>
                                            <!--end::Chart-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card widget 12-->
                                    <!--begin::Card widget 10-->
                                    <div class="card card-flush h-md-50 mb-lg-10">
                                        <!--begin::Header-->
                                        <div class="card-header pt-5">
                                            <!--begin::Title-->
                                            <div class="card-title d-flex flex-column">
                                                <!--begin::Amount-->
                                                <span
                                                    class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $totalQuotes }}</span>
                                                <!--end::Amount-->
                                                <!--begin::Subtitle-->
                                                <span
                                                    class="text-gray-500 pt-1 fw-semibold fs-6">Por tipo de contacto</span>
                                                <!--end::Subtitle-->
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex align-items-end pt-0">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex align-items-center flex-wrap">
                                                <!--begin::Chart-->
                                                <div class="d-flex me-7 me-xxl-10"
                                                     style="display: grid; place-items: center;">
                                                    <div id="typeOfContact" class="min-h-auto"
                                                         style="height: 78px; width: 78px" data-kt-size="80"
                                                         data-kt-line="11"></div>
                                                </div>
                                                <!--end::Chart-->
                                                <!--begin::Labels-->
                                                <div class="d-flex flex-column content-justify-center flex-grow-1"
                                                     style="margin-top: 10px">
                                                    <!--begin::Label-->
                                                    <div class="d-flex fs-6 fw-semibold align-items-center">
                                                        <!--begin::Bullet-->
                                                        <div class="bullet w-8px h-6px rounded-2 bg-success me-3"></div>
                                                        <!--end::Bullet-->
                                                        <!--begin::Label-->
                                                        <div class="fs-6 fw-semibold text-gray-500 flex-shrink-0">
                                                            Whatsapp porcentaje
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--begin::Separator-->
                                                        <div
                                                            class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                                                        <!--end::Separator-->
                                                        <!--begin::Stats-->
                                                        <div
                                                            class="ms-auto fw-bolder text-gray-700 text-end">{{ $arrayTypeContact['whatsapp'] * 100 }}
                                                            %
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Label-->
                                                    <!--begin::Label-->
                                                    <div class="d-flex fs-6 fw-semibold align-items-center my-1">
                                                        <!--begin::Bullet-->
                                                        <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                                        <!--end::Bullet-->
                                                        <!--begin::Label-->
                                                        <div class="fs-6 fw-semibold text-gray-500 flex-shrink-0">Pago
                                                            Online porcentaje
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--begin::Separator-->
                                                        <div
                                                            class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                                                        <!--end::Separator-->
                                                        <!--begin::Stats-->
                                                        <div
                                                            class="ms-auto fw-bolder text-gray-700 text-end">{{ $arrayTypeContact['online'] * 100 }}
                                                            %
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Label-->
                                                    <!--begin::Label-->
                                                    <div class="d-flex fs-6 fw-semibold align-items-center">
                                                        <!--begin::Bullet-->
                                                        <div class="bullet w-8px h-6px rounded-2 me-3"
                                                             style="background-color: #E4E6EF"></div>
                                                        <!--end::Bullet-->
                                                        <!--begin::Label-->
                                                        <div class="fs-6 fw-semibold text-gray-500 flex-shrink-0">
                                                            Telefono porcentaje
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--begin::Separator-->
                                                        <div
                                                            class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                                                        <!--end::Separator-->
                                                        <!--begin::Stats-->
                                                        <div
                                                            class="ms-auto fw-bolder text-gray-700 text-end">{{ $arrayTypeContact['phone'] * 100 }}
                                                            %
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <div class="d-flex fs-6 fw-semibold align-items-center">
                                                        <!--begin::Bullet-->
                                                        <div class="bullet w-8px h-6px rounded-2 me-3"
                                                             style="background-color: #869EA4"></div>
                                                        <!--end::Bullet-->
                                                        <!--begin::Label-->
                                                        <div class="fs-6 fw-semibold text-gray-500 flex-shrink-0">Sin
                                                            Informacion porcentaje
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--begin::Separator-->
                                                        <div
                                                            class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                                                        <!--end::Separator-->
                                                        <!--begin::Stats-->
                                                        <div
                                                            class="ms-auto fw-bolder text-gray-700 text-end">{{ $arrayTypeContact['null'] * 100 }}
                                                            %
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Labels-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card widget 10-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 col-xl-6 mb-md-5 mb-xl-10">
                                    <!--begin::Card widget 13-->
                                    <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                            <!--begin::Statistics-->
                                            <div class="mb-4 px-9">
                                                <!--begin::Statistics-->
                                                <div class="d-flex align-items-center mb-2">
                                                    <!--begin::Value-->
                                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{ $quotesWithPayment }} - ({{ $quotesWithPayment *200 }} $us)</span>
                                                    <!--end::Value-->
                                                    <!--begin::Label-->
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Statistics-->
                                                <!--begin::Description-->
                                                <span class="fs-6 fw-semibold text-gray-500">Leads con pago (transferencia o pago online)</span>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Statistics-->
                                            <!--begin::Chart-->
                                            <div id="quotesWithPayment" class="min-h-auto" style="height: 125px"></div>
                                            <!--end::Chart-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card widget 13-->
                                    <!--begin::Card widget 7-->
                                    <div class="card card-flush h-md-50 mb-lg-10">
                                        <!--begin::Header-->
                                        <div class="card-header pt-5">
                                            <!--begin::Title-->
                                            <div class="card-title d-flex flex-column">
                                                <!--begin::Amount-->
                                                <span
                                                    class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $totalColors }}</span>
                                                <!--end::Amount-->
                                                <!--begin::Subtitle-->
                                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Total de modelos cargados</span>
                                                <!--end::Subtitle-->
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex flex-column justify-content-end pe-0">
                                            <!--begin::Title-->
                                            <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">Último Héroes</span>
                                            <!--end::Title-->
                                            <!--begin::Users group-->
                                            <div class="symbol-group symbol-hover flex-nowrap">
                                                @foreach($lastThreeColors as $color)
                                                    <div class="symbol symbol-55px symbol-circle"
                                                         data-bs-toggle="tooltip"
                                                         title="{{ $color->modelOfCar->name }} - {{ $color->name }}">
                                                        <img
                                                            src="{{ asset('storage/vehicles/'.$color->modelOfCar->slug.'/thumbnail/'.$color->image) }}"
                                                            alt="{{ $color->name }}"/>
                                                    </div>
                                                @endforeach
                                                <a href="{{ route('backend.vehicle.color.index') }}"
                                                   class="symbol symbol-55px symbol-circle">
                                                    <span
                                                        class="symbol-label bg-light text-gray-400 fs-8 fw-bold">+{{ $totalColors }}</span>
                                                </a>
                                            </div>
                                            <!--end::Users group-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card widget 7-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-3">
                            <!--begin::Card widget 3-->
                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                 style="background-color: #F1416C;background-image:url('{{ asset('backend/assets/media/svg/shapes/wave-bg-red.svg') }}')">
                                <!--begin::Header-->
                                <div class="card-header pt-5 mb-3">
                                    <!--begin::Icon-->
                                    <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                         style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #F1416C">
                                        <img src="https://www.tecnom.cloud/wp-content/uploads/2021/11/logo.svg"
                                             class="h-80px w-80px" alt="">
                                    </div>
                                    <!--end::Icon-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-end mb-3">
                                    <!--begin::Info-->
                                    <div class="d-flex align-items-center">
                                        <span class="fs-4hx text-white fw-bold me-6">1.2k</span>
                                        <div class="fw-bold fs-6 text-white">
                                            <span class="d-block">Tecnom</span>
                                            <span class="">solicitudes</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->
                                <div class="card-footer"
                                     style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                                    <!--begin::Progress-->
                                    <div class="fw-bold text-white py-2">
                                        <span class="fs-1 d-block">935</span>
                                        <span class="opacity-50">Con errores. <a href="#">Reprocesar aqui</a></span>
                                    </div>
                                    <!--end::Progress-->
                                </div>
                                <!--end::Card footer-->
                            </div>
                            <!--end::Card widget 3-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-3">
                            <!--begin::Card widget 3-->
                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                 style="background-color: #7239EA;background-image:url('{{ asset('backend/assets/media/svg/shapes/wave-bg-purple.svg') }}')">
                                <!--begin::Header-->
                                <div class="card-header pt-5 mb-3">
                                    <!--begin::Icon-->
                                    <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                         style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #7239EA">
                                        {{--                                        <i class="ki-outline ki-call text-white fs-2qx lh-0"></i>--}}
                                        <img class="h-40px w-40px"
                                             src="https://wordpress-33973-0.cloudclusters.net/wp-content/uploads/2020/12/libelula_logo.png"
                                             alt="">
                                    </div>
                                    <!--end::Icon-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-end mb-3">
                                    <!--begin::Info-->
                                    <div class="d-flex align-items-center">
                                        <span class="fs-4hx text-white fw-bold me-6">427</span>
                                        <div class="fw-bold fs-6 text-white">
                                            <span class="d-block">Libelua</span>
                                            <span class="">Solicitudes</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->
                                <div class="card-footer"
                                     style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                                    <!--begin::Progress-->
                                    <div class="fw-bold text-white py-2">
                                        <span class="fs-1 d-block">386</span>
                                        <span class="opacity-50">Con errores. <a href="#">Reprocesar aqui</a></span>
                                    </div>
                                    <!--end::Progress-->
                                </div>
                                <!--end::Card footer-->
                            </div>
                            <!--end::Card widget 3-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-3">
                            <!--begin::Card widget 3-->
                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                 style="background-color: #50CD89;background-image:url('{{ asset('backend/assets/media/svg/shapes/wave-bg-dark.svg') }}')">
                                <!--begin::Header-->
                                <div class="card-header pt-5 mb-3">
                                    <!--begin::Icon-->
                                    <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                         style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #50CD89">
                                        <i class="ki-outline ki-call text-white fs-2qx lh-0"></i>
                                    </div>
                                    <!--end::Icon-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-end mb-3">
                                    <!--begin::Info-->
                                    <div class="d-flex align-items-center">
                                        <span class="fs-4hx text-white fw-bold me-6">1.2k</span>
                                        <div class="fw-bold fs-6 text-white">
                                            <span class="d-block">Transferencias</span>
                                            <span class="">Bancarias</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->
                                <div class="card-footer"
                                     style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                                    <!--begin::Progress-->
                                    <div class="fw-bold text-white py-2">
                                        <span class="fs-1 d-block">935</span>
                                        <span class="opacity-50">Total solicitudes</span>
                                    </div>
                                    <!--end::Progress-->
                                </div>
                                <!--end::Card footer-->
                            </div>
                            <!--end::Card widget 3-->
                        </div>

                        <div class="col-xl-3">
                            <!--begin::Card widget 3-->
                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                 style="background-color: #FFC700;background-image:url('{{ asset('backend/assets/media/svg/shapes/wave-bg-dark.svg') }}')">
                                <!--begin::Header-->
                                <div class="card-header pt-5 mb-3">
                                    <!--begin::Icon-->
                                    <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                         style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #FFC700">
                                        <i class="ki-outline ki-call text-white fs-2qx lh-0"></i>
                                    </div>
                                    <!--end::Icon-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-end mb-3">
                                    <!--begin::Info-->
                                    <div class="d-flex align-items-center">
                                        <span class="fs-4hx text-white fw-bold me-6">1.2k</span>
                                        <div class="fw-bold fs-6 text-white">
                                            <span class="d-block">Transferencias por</span>
                                            <span class="">Libelula</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->
                                <div class="card-footer"
                                     style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                                    <!--begin::Progress-->
                                    <div class="fw-bold text-white py-2">
                                        <span class="fs-1 d-block">935</span>
                                        <span class="opacity-50">Aprobadas</span>
                                    </div>
                                    <!--end::Progress-->
                                </div>
                                <!--end::Card footer-->
                            </div>
                            <!--end::Card widget 3-->
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row gy-5 g-xl-10 mb-5 mb-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <!--begin::List widget 11-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-7 mb-3">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span
                                            class="card-label fw-bold text-gray-800">Nuestros tipos de vehículos</span>
                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Total {{ $gradeCount }} grados por {{ $modelCount }} modelos </span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-4">
                                    @foreach($typeModelGradeQuote as $type)
{{--                                        @dd($type)--}}
                                        <div class="d-flex flex-stack">
                                            <div class="d-flex align-items-center me-5">
                                                <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label">
                                                    <i class="{{ $type['type_icon'] }} text-gray-600 fs-1" ></i>
                                                </span>
                                                </div>
                                                <div class="me-5">
                                                    <a href="#"
                                                       class="text-gray-800 fw-bold text-hover-primary fs-6">{{ $type['type_name'] }}</a>
                                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">{{ $type['model_of_cars_count'] }} Modelos - {{ $type['grades_count'] }} grados</span>
                                                </div>
                                            </div>
                                            <div class="text-gray-500 fw-bold fs-7 text-end">
                                                <span class="text-gray-800 fw-bold fs-6 d-block">{{ $type['quotes_count'] }}</span>
                                                Cotizaciones
                                            </div>
                                        </div>
                                        @if(!$loop->last)
                                            <div class="separator separator-dashed my-5"></div>
                                        @endif
                                    @endforeach

                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List widget 11-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-8">
                            <!--begin::Chart widget 17-->
                            <div class="card card-flush mb-xxl-10">
                                <!--begin::Header-->
                                <div class="card-header pt-7">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-800">Tipo por mes</span>
                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">{{ $totalQuotes }} cotizaciones</span>
                                    </h3>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-between px-0">
                                    <ul class="nav nav-pills nav-pills-custom mb-3 mx-9">

                                        @foreach($typesMonth as $typeName => $data)
                                            <li class="nav-item mb-3 me-3 me-lg-6">
                                                <a class="nav-link btn btn-outline btn-flex btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" id="kt_charts_widget_10_tab_{{ $loop->iteration }}" href="#kt_charts_widget_10_tab_content_{{ $loop->iteration }}">
                                                    <div class="nav-icon mb-3">
                                                        <i class="{{ $data['icon'] }} fs-1 p-0"></i>
                                                    </div>
                                                    <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{ $typeName }}</span>
                                                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                </a>
                                            </li>
                                        @endforeach
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Nav-->
                                    <!--begin::Tab Content-->
                                    <div class="tab-content ps-4 pe-6">
                                        @foreach($typesMonth as $typeName => $data)
                                            <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}" id="kt_charts_widget_10_tab_content_{{ $loop->iteration }}">
                                                <!--begin::Chart-->
                                                <div id="kt_charts_widget_10_chart_{{ $loop->iteration }}" class="min-h-auto" style="height: 227px"></div>
                                                <!--end::Chart-->
                                            </div>
                                        @endforeach
                                    </div>
                                    <!--end::Tab Content-->
                                </div>
                                <!--end: Card Body-->
                            </div>
                            <!--end::Chart widget 17-->
                        </div>
                        <!--end::Col-->
                    </div>


                    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                        <div class="col-xl-5">
                            <div class="card card-flush h-lg-100">
                                <!--begin::Header-->
                                <div class="card-header py-7 mb-3">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-800">Modelos más vendidos</span>
                                        {{--                                                <span class="text-gray-500 mt-1 fw-semibold fs-6">8k social visitors</span>--}}
                                    </h3>
                                    <!--end::Title-->
                                    <!--begin::Toolbar-->
                                    <div class="card-toolbar">
                                        <a href="{{ route('backend.vehicle.model.index') }}"
                                           class="btn btn-sm btn-light">Ver todos los modelos</a>
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-0 ps-6 mt-n12">
                                    <div id="topModelSell"></div>
                                </div>
                                <!--end::Body-->
                            </div>
                        </div>

                        <div class="col-xl-7">
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-7">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-900">Grados mas vendidos</span>
                                        <span
                                            class="text-gray-500 pt-2 fw-semibold fs-6">Para el modelo {{ $topSellingModels[0]->modelOfCar->name }} </span>
                                    </h3>
                                    <!--end::Title-->
                                    <!--begin::Toolbar-->
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-5">
                                    <!--begin::Chart container-->
                                    <div id="kt_charts_widget_17_chart" class="w-300 h-400px"></div>
                                    <!--end::Chart container-->
                                </div>
                                <!--end::Body-->
                            </div>
                        </div>

                    </div>


                    <div class="row gy-5 g-xl-10">
{{--                        <div class="col-xl-6">--}}
{{--                            <div class="card card-flush mb-xxl-10">--}}
{{--                                <!--begin::Header-->--}}
{{--                                <div class="card-header pt-5">--}}
{{--                                    <!--begin::Title-->--}}
{{--                                    <h3 class="card-title align-items-start flex-column">--}}
{{--                                        <span class="card-label fw-bold text-gray-900">Featured Campaigns</span>--}}
{{--                                        <span class="text-gray-500 pt-2 fw-semibold fs-6">75% activity growth</span>--}}
{{--                                    </h3>--}}
{{--                                    <!--end::Title-->--}}
{{--                                    <!--begin::Toolbar-->--}}
{{--                                    <div class="card-toolbar">--}}
{{--                                        <!--begin::Menu-->--}}
{{--                                        <button--}}
{{--                                            class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"--}}
{{--                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"--}}
{{--                                            data-kt-menu-overflow="true">--}}
{{--                                            <i class="ki-outline ki-dots-square fs-1 text-gray-500 me-n1"></i>--}}
{{--                                        </button>--}}
{{--                                        <!--begin::Menu 2-->--}}
{{--                                        <div--}}
{{--                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"--}}
{{--                                            data-kt-menu="true">--}}
{{--                                            <!--begin::Menu item-->--}}
{{--                                            <div class="menu-item px-3">--}}
{{--                                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick--}}
{{--                                                    Actions--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <!--end::Menu item-->--}}
{{--                                            <!--begin::Menu separator-->--}}
{{--                                            <div class="separator mb-3 opacity-75"></div>--}}
{{--                                            <!--end::Menu separator-->--}}
{{--                                            <!--begin::Menu item-->--}}
{{--                                            <div class="menu-item px-3">--}}
{{--                                                <a href="#" class="menu-link px-3">New Ticket</a>--}}
{{--                                            </div>--}}
{{--                                            <!--end::Menu item-->--}}
{{--                                            <!--begin::Menu item-->--}}
{{--                                            <div class="menu-item px-3">--}}
{{--                                                <a href="#" class="menu-link px-3">New Customer</a>--}}
{{--                                            </div>--}}
{{--                                            <!--end::Menu item-->--}}
{{--                                            <!--begin::Menu item-->--}}
{{--                                            <div class="menu-item px-3" data-kt-menu-trigger="hover"--}}
{{--                                                 data-kt-menu-placement="right-start">--}}
{{--                                                <!--begin::Menu item-->--}}
{{--                                                <a href="#" class="menu-link px-3">--}}
{{--                                                    <span class="menu-title">New Group</span>--}}
{{--                                                    <span class="menu-arrow"></span>--}}
{{--                                                </a>--}}
{{--                                                <!--end::Menu item-->--}}
{{--                                                <!--begin::Menu sub-->--}}
{{--                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">--}}
{{--                                                    <!--begin::Menu item-->--}}
{{--                                                    <div class="menu-item px-3">--}}
{{--                                                        <a href="#" class="menu-link px-3">Admin Group</a>--}}
{{--                                                    </div>--}}
{{--                                                    <!--end::Menu item-->--}}
{{--                                                    <!--begin::Menu item-->--}}
{{--                                                    <div class="menu-item px-3">--}}
{{--                                                        <a href="#" class="menu-link px-3">Staff Group</a>--}}
{{--                                                    </div>--}}
{{--                                                    <!--end::Menu item-->--}}
{{--                                                    <!--begin::Menu item-->--}}
{{--                                                    <div class="menu-item px-3">--}}
{{--                                                        <a href="#" class="menu-link px-3">Member Group</a>--}}
{{--                                                    </div>--}}
{{--                                                    <!--end::Menu item-->--}}
{{--                                                </div>--}}
{{--                                                <!--end::Menu sub-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Menu item-->--}}
{{--                                            <!--begin::Menu item-->--}}
{{--                                            <div class="menu-item px-3">--}}
{{--                                                <a href="#" class="menu-link px-3">New Contact</a>--}}
{{--                                            </div>--}}
{{--                                            <!--end::Menu item-->--}}
{{--                                            <!--begin::Menu separator-->--}}
{{--                                            <div class="separator mt-3 opacity-75"></div>--}}
{{--                                            <!--end::Menu separator-->--}}
{{--                                            <!--begin::Menu item-->--}}
{{--                                            <div class="menu-item px-3">--}}
{{--                                                <div class="menu-content px-3 py-3">--}}
{{--                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <!--end::Menu item-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Menu 2-->--}}
{{--                                        <!--end::Menu-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Toolbar-->--}}
{{--                                </div>--}}
{{--                                <!--end::Header-->--}}
{{--                                <!--begin::Body-->--}}
{{--                                <div class="card-body">--}}
{{--                                    <!--begin::Nav-->--}}
{{--                                    <ul class="nav nav-pills nav-pills-custom mb-3">--}}
{{--                                        <!--begin::Item-->--}}
{{--                                        <li class="nav-item mb-3 me-3 me-lg-6">--}}
{{--                                            <!--begin::Link-->--}}
{{--                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden active w-80px h-85px py-4"--}}
{{--                                               data-bs-toggle="pill" href="#kt_stats_widget_1_tab_1">--}}
{{--                                                <!--begin::Icon-->--}}
{{--                                                <div class="nav-icon">--}}
{{--                                                    <img alt="" src="assets/media/svg/brand-logos/beats-electronics.svg"--}}
{{--                                                         class=""/>--}}
{{--                                                </div>--}}
{{--                                                <!--end::Icon-->--}}
{{--                                                <!--begin::Subtitle-->--}}
{{--                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">Beats</span>--}}
{{--                                                <!--end::Subtitle-->--}}
{{--                                                <!--begin::Bullet-->--}}
{{--                                                <span--}}
{{--                                                    class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>--}}
{{--                                                <!--end::Bullet-->--}}
{{--                                            </a>--}}
{{--                                            <!--end::Link-->--}}
{{--                                        </li>--}}
{{--                                        <!--end::Item-->--}}
{{--                                        <!--begin::Item-->--}}
{{--                                        <li class="nav-item mb-3 me-3 me-lg-6">--}}
{{--                                            <!--begin::Link-->--}}
{{--                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4"--}}
{{--                                               data-bs-toggle="pill" href="#kt_stats_widget_1_tab_2">--}}
{{--                                                <!--begin::Icon-->--}}
{{--                                                <div class="nav-icon">--}}
{{--                                                    <img alt="Logo" src="assets/media/svg/brand-logos/amazon.svg"--}}
{{--                                                         class="theme-light-show"/>--}}
{{--                                                    <img alt="Logo" src="assets/media/svg/brand-logos/amazon-dark.svg"--}}
{{--                                                         class="theme-dark-show"/>--}}
{{--                                                </div>--}}
{{--                                                <!--end::Icon-->--}}
{{--                                                <!--begin::Subtitle-->--}}
{{--                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">Amazon</span>--}}
{{--                                                <!--end::Subtitle-->--}}
{{--                                                <!--begin::Bullet-->--}}
{{--                                                <span--}}
{{--                                                    class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>--}}
{{--                                                <!--end::Bullet-->--}}
{{--                                            </a>--}}
{{--                                            <!--end::Link-->--}}
{{--                                        </li>--}}
{{--                                        <!--end::Item-->--}}
{{--                                        <!--begin::Item-->--}}
{{--                                        <li class="nav-item mb-3 me-3 me-lg-6">--}}
{{--                                            <!--begin::Link-->--}}
{{--                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4"--}}
{{--                                               data-bs-toggle="pill" href="#kt_stats_widget_1_tab_3">--}}
{{--                                                <!--begin::Icon-->--}}
{{--                                                <div class="nav-icon">--}}
{{--                                                    <img alt="" src="assets/media/svg/brand-logos/bp-2.svg" class=""/>--}}
{{--                                                </div>--}}
{{--                                                <!--end::Icon-->--}}
{{--                                                <!--begin::Subtitle-->--}}
{{--                                                <span class="nav-text text-gray-600 fw-bold fs-6 lh-1">BP</span>--}}
{{--                                                <!--end::Subtitle-->--}}
{{--                                                <!--begin::Bullet-->--}}
{{--                                                <span--}}
{{--                                                    class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>--}}
{{--                                                <!--end::Bullet-->--}}
{{--                                            </a>--}}
{{--                                            <!--end::Link-->--}}
{{--                                        </li>--}}
{{--                                        <!--end::Item-->--}}
{{--                                        <!--begin::Item-->--}}
{{--                                        <li class="nav-item mb-3 me-3 me-lg-6">--}}
{{--                                            <!--begin::Link-->--}}
{{--                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4"--}}
{{--                                               data-bs-toggle="pill" href="#kt_stats_widget_1_tab_4">--}}
{{--                                                <!--begin::Icon-->--}}
{{--                                                <div class="nav-icon">--}}
{{--                                                    <img alt="" src="assets/media/svg/brand-logos/slack-icon.svg"--}}
{{--                                                         class="nav-icon"/>--}}
{{--                                                </div>--}}
{{--                                                <!--end::Icon-->--}}
{{--                                                <!--begin::Subtitle-->--}}
{{--                                                <span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Slack</span>--}}
{{--                                                <!--end::Subtitle-->--}}
{{--                                                <!--begin::Bullet-->--}}
{{--                                                <span--}}
{{--                                                    class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>--}}
{{--                                                <!--end::Bullet-->--}}
{{--                                            </a>--}}
{{--                                            <!--end::Link-->--}}
{{--                                        </li>--}}
{{--                                        <!--end::Item-->--}}
{{--                                        <!--begin::Item-->--}}
{{--                                        <li class="nav-item mb-3">--}}
{{--                                            <!--begin::Link-->--}}
{{--                                            <a class="nav-link d-flex flex-center overflow-hidden w-80px h-85px"--}}
{{--                                               data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign"--}}
{{--                                               href="#">--}}
{{--                                                <!--begin::Icon-->--}}
{{--                                                <div class="nav-icon">--}}
{{--                                                    <i class="ki-outline ki-plus-square fs-2hx text-gray-500"></i>--}}
{{--                                                </div>--}}
{{--                                                <!--end::Icon-->--}}
{{--                                                <!--begin::Bullet-->--}}
{{--                                                <span--}}
{{--                                                    class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>--}}
{{--                                                <!--end::Bullet-->--}}
{{--                                            </a>--}}
{{--                                            <!--end::Link-->--}}
{{--                                        </li>--}}
{{--                                        <!--end::Item-->--}}
{{--                                    </ul>--}}
{{--                                    <!--end::Nav-->--}}
{{--                                    <!--begin::Tab Content-->--}}
{{--                                    <div class="tab-content">--}}
{{--                                        <!--begin::Tap pane-->--}}
{{--                                        <div class="tab-pane fade show active" id="kt_stats_widget_1_tab_1">--}}
{{--                                            <!--begin::Table container-->--}}
{{--                                            <div class="table-responsive">--}}
{{--                                                <!--begin::Table-->--}}
{{--                                                <table class="table align-middle gs-0 gy-4 my-0">--}}
{{--                                                    <!--begin::Table head-->--}}
{{--                                                    <thead>--}}
{{--                                                    <tr class="fs-7 fw-bold text-gray-500">--}}
{{--                                                        <th class="p-0 min-w-150px d-block pt-3">EMAIL TITLE</th>--}}
{{--                                                        <th class="text-end min-w-140px pt-3">STATUS</th>--}}
{{--                                                        <th class="pe-0 text-end min-w-120px pt-3">CONVERSION</th>--}}
{{--                                                    </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    <!--end::Table head-->--}}
{{--                                                    <!--begin::Table body-->--}}
{{--                                                    <tbody>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best--}}
{{--                                                                Rated Headsets of 2022</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="badge badge-light-success fs-7 fw-bold">Sent</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">18%(6.4k)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">New--}}
{{--                                                                Model BS 2000 X</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span class="badge badge-light-primary fs-7 fw-bold">In Draft</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">0.01%(1)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">2022--}}
{{--                                                                Spring Conference by Beats</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="badge badge-light-success fs-7 fw-bold">Sent</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">37%(247)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best--}}
{{--                                                                Headsets Giveaway</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span class="badge badge-light-warning fs-7 fw-bold">In Queue</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">0%(0)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    </tbody>--}}
{{--                                                    <!--end::Table body-->--}}
{{--                                                </table>--}}
{{--                                                <!--end::Table-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Table container-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Tap pane-->--}}
{{--                                        <!--begin::Tap pane-->--}}
{{--                                        <div class="tab-pane fade" id="kt_stats_widget_1_tab_2">--}}
{{--                                            <!--begin::Table container-->--}}
{{--                                            <div class="table-responsive">--}}
{{--                                                <!--begin::Table-->--}}
{{--                                                <table class="table align-middle gs-0 gy-4 my-0">--}}
{{--                                                    <!--begin::Table head-->--}}
{{--                                                    <thead>--}}
{{--                                                    <tr class="fs-7 fw-bold text-gray-500">--}}
{{--                                                        <th class="p-0 min-w-150px d-block pt-3">EMAIL TITLE</th>--}}
{{--                                                        <th class="text-end min-w-140px pt-3">STATUS</th>--}}
{{--                                                        <th class="pe-0 text-end min-w-120px pt-3">CONVERSION</th>--}}
{{--                                                    </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    <!--end::Table head-->--}}
{{--                                                    <!--begin::Table body-->--}}
{{--                                                    <tbody>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">2022--}}
{{--                                                                Spring Conference by Beats</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="badge badge-light-success fs-7 fw-bold">Sent</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">37%(247)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best--}}
{{--                                                                Headsets Giveaway</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span class="badge badge-light-warning fs-7 fw-bold">In Queue</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">0%(0)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best--}}
{{--                                                                Rated Headsets of 2022</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="badge badge-light-success fs-7 fw-bold">Sent</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">18%(6.4k)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">New--}}
{{--                                                                Model BS 2000 X</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span class="badge badge-light-primary fs-7 fw-bold">In Draft</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">0.01%(1)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    </tbody>--}}
{{--                                                    <!--end::Table body-->--}}
{{--                                                </table>--}}
{{--                                                <!--end::Table-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Table container-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Tap pane-->--}}
{{--                                        <!--begin::Tap pane-->--}}
{{--                                        <div class="tab-pane fade" id="kt_stats_widget_1_tab_3">--}}
{{--                                            <!--begin::Table container-->--}}
{{--                                            <div class="table-responsive">--}}
{{--                                                <!--begin::Table-->--}}
{{--                                                <table class="table align-middle gs-0 gy-4 my-0">--}}
{{--                                                    <!--begin::Table head-->--}}
{{--                                                    <thead>--}}
{{--                                                    <tr class="fs-7 fw-bold text-gray-500">--}}
{{--                                                        <th class="p-0 min-w-150px d-block pt-3">EMAIL TITLE</th>--}}
{{--                                                        <th class="text-end min-w-140px pt-3">STATUS</th>--}}
{{--                                                        <th class="pe-0 text-end min-w-120px pt-3">CONVERSION</th>--}}
{{--                                                    </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    <!--end::Table head-->--}}
{{--                                                    <!--begin::Table body-->--}}
{{--                                                    <tbody>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">New--}}
{{--                                                                Model BS 2000 X</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span class="badge badge-light-primary fs-7 fw-bold">In Draft</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">0.01%(1)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best--}}
{{--                                                                Rated Headsets of 2022</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="badge badge-light-success fs-7 fw-bold">Sent</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">18%(6.4k)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">2022--}}
{{--                                                                Spring Conference by Beats</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="badge badge-light-success fs-7 fw-bold">Sent</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">37%(247)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best--}}
{{--                                                                Headsets Giveaway</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span class="badge badge-light-warning fs-7 fw-bold">In Queue</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">0%(0)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    </tbody>--}}
{{--                                                    <!--end::Table body-->--}}
{{--                                                </table>--}}
{{--                                                <!--end::Table-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Table container-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Tap pane-->--}}
{{--                                        <!--begin::Tap pane-->--}}
{{--                                        <div class="tab-pane fade" id="kt_stats_widget_1_tab_4">--}}
{{--                                            <!--begin::Table container-->--}}
{{--                                            <div class="table-responsive">--}}
{{--                                                <!--begin::Table-->--}}
{{--                                                <table class="table align-middle gs-0 gy-4 my-0">--}}
{{--                                                    <!--begin::Table head-->--}}
{{--                                                    <thead>--}}
{{--                                                    <tr class="fs-7 fw-bold text-gray-500">--}}
{{--                                                        <th class="p-0 min-w-150px d-block pt-3">EMAIL TITLE</th>--}}
{{--                                                        <th class="text-end min-w-140px pt-3">STATUS</th>--}}
{{--                                                        <th class="pe-0 text-end min-w-120px pt-3">CONVERSION</th>--}}
{{--                                                    </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    <!--end::Table head-->--}}
{{--                                                    <!--begin::Table body-->--}}
{{--                                                    <tbody>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best--}}
{{--                                                                Headsets Giveaway</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span class="badge badge-light-warning fs-7 fw-bold">In Queue</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">0%(0)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best--}}
{{--                                                                Headsets Giveaway</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="badge badge-light-success fs-7 fw-bold">Sent</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">37%(247)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best--}}
{{--                                                                Rated Headsets of 2022</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="badge badge-light-success fs-7 fw-bold">Sent</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">18%(6.4k)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">New--}}
{{--                                                                Model BS 2000 X</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span class="badge badge-light-primary fs-7 fw-bold">In Draft</span>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-end">--}}
{{--                                                            <span--}}
{{--                                                                class="text-gray-800 fw-bold d-block fs-6">0.01%(1)</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    </tbody>--}}
{{--                                                    <!--end::Table body-->--}}
{{--                                                </table>--}}
{{--                                                <!--end::Table-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Table container-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Tap pane-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Tab Content-->--}}
{{--                                </div>--}}
{{--                                <!--end: Card Body-->--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="col-xl-12">
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-7">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-900">Vehículos más cotizados</span>
                                        <span class="text-gray-500 pt-2 fw-semibold fs-6">Vehíuclos más solicitados</span>
                                    </h3>
                                </div>
                                <div class="card-body pt-5">
                                    <div id="vehiclesMoreView" class="w-100 h-350px"></div>
                                </div>
                                <!--end::Body-->
                            </div>

                        </div>

                    </div>


                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>

</x-app-layout>
