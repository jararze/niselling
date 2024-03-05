<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>


    {{--                <div class="d-flex flex-column flex-column-fluid">--}}
    {{--                    <!--begin::Content-->--}}
    {{--                    <div id="kt_app_content" class="app-content flex-column-fluid">--}}
    {{--                        <!--begin::Content container-->--}}
    {{--                        <div id="kt_app_content_container" class="app-container container-fluid">--}}
    {{--                            <!--begin::Row-->--}}
    {{--                            <div class="row g-5 g-xl-10">--}}
    {{--                                <!--begin::Col-->--}}
    {{--                                <div class="col-xl-8 mb-xl-10">--}}
    {{--                                    <!--begin::Row-->--}}
    {{--                                    <div class="row g-5 g-xl-10">--}}
    {{--                                        <!--begin::Col-->--}}
    {{--                                        <div class="col-lg-6 mb-xl-10">--}}
    {{--                                            <!--begin::Chart Widget 47-->--}}
    {{--                                            <div class="card card-flush" style="background: linear-gradient(180deg, #1858FD 0%, #1652EA 100%); box-shadow: 0px 14px 40px 0px rgba(24, 85, 243, 0.20);">--}}
    {{--                                                <!--begin::Header-->--}}
    {{--                                                <div class="card-header align-items-center pt-6">--}}
    {{--                                                    <!--begin::Symbol-->--}}
    {{--                                                    <div class="symbol symbol-50px me-4">--}}
    {{--                                                        <div class="symbol-label bg-transparent rounded-lg" style="border: 1px dashed rgba(255, 255, 255, 0.20)">--}}
    {{--                                                            <i class="ki-outline ki-handcart text-white fs-1"></i>--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Symbol-->--}}
    {{--                                                    <!--begin::Info-->--}}
    {{--                                                    <div class="card-title flex-column flex-grow-1">--}}
    {{--                                                        <span class="card-label fw-bold fs-3 text-white">New Orders</span>--}}
    {{--                                                        <span class="text-white opacity-50 fw-semibold fs-base">Recent customer purchase trends</span>--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Info-->--}}
    {{--                                                    <!--begin::Toolbar-->--}}
    {{--                                                    <div class="card-toolbar">--}}
    {{--                                                        <a href="#" class="btn btn-sm btn-text-white bg-white bg-opacity-10" style="border: 1px solid rgba(255, 255, 255, 0.20)">Today</a>--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Toolbar-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Header-->--}}
    {{--                                                <!--begin::Card body-->--}}
    {{--                                                <div class="card-body d-flex align-items-end pb-0">--}}
    {{--                                                    <!--begin::Wrapper-->--}}
    {{--                                                    <div class="d-flex flex-stack flex-row-fluid">--}}
    {{--                                                        <!--begin::Block-->--}}
    {{--                                                        <div class="d-flex flex-column">--}}
    {{--                                                            <!--begin::Stats-->--}}
    {{--                                                            <div class="d-flex align-items-center mb-1">--}}
    {{--                                                                <!--begin::Amount-->--}}
    {{--                                                                <span class="fs-2hx fw-bold text-white me-2">$1,934</span>--}}
    {{--                                                                <!--end::Amount-->--}}
    {{--                                                                <!--begin::Label-->--}}
    {{--                                                                <span class="fw-semibold text-success fs-6">+6.83%</span>--}}
    {{--                                                                <!--end::Label-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Stats-->--}}
    {{--                                                            <!--begin::Total-->--}}
    {{--                                                            <span class="fw-semibold text-white opacity-50">For past 24 hours</span>--}}
    {{--                                                            <!--end::Total-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Block-->--}}
    {{--                                                        <!--begin::Chart-->--}}
    {{--                                                        <div id="kt_charts_widget_47" class="h-125px w-200px min-h-auto"></div>--}}
    {{--                                                        <!--end::Chart-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Wrapper-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Card body-->--}}
    {{--                                            </div>--}}
    {{--                                            <!--end::Chart Widget 47-->--}}
    {{--                                        </div>--}}
    {{--                                        <!--end::Col-->--}}
    {{--                                        <!--begin::Col-->--}}
    {{--                                        <div class="col-lg-6 mb-5 mb-xl-10">--}}
    {{--                                            <!--begin::Chart Widget 47-->--}}
    {{--                                            <!--begin::Chart Widget 48-->--}}
    {{--                                            <div class="card card-flush">--}}
    {{--                                                <!--begin::Header-->--}}
    {{--                                                <div class="card-header justify-content-start align-items-center pt-6">--}}
    {{--                                                    <!--begin::Symbol-->--}}
    {{--                                                    <div class="symbol symbol-50px me-4">--}}
    {{--                                                        <div class="symbol-label border border-dashed border-gray-300">--}}
    {{--                                                            <i class="ki-outline ki-handcart text-info fs-1"></i>--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Symbol-->--}}
    {{--                                                    <!--begin::Info-->--}}
    {{--                                                    <div class="card-title flex-column flex-grow-1">--}}
    {{--                                                        <span class="card-label fw-bold fs-3 text-gray-800">New Orders</span>--}}
    {{--                                                        <span class="text-gray-500 fw-semibold fs-base">Recent customer purchase trends</span>--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Info-->--}}
    {{--                                                    <!--begin::Toolbar-->--}}
    {{--                                                    <div class="card-toolbar">--}}
    {{--                                                        <a href="#" class="btn btn-sm btn-secondary">Month</a>--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Toolbar-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Header-->--}}
    {{--                                                <!--begin::Card body-->--}}
    {{--                                                <div class="card-body d-flex align-items-end pb-0">--}}
    {{--                                                    <!--begin::Wrapper-->--}}
    {{--                                                    <div class="d-flex flex-stack flex-row-fluid">--}}
    {{--                                                        <!--begin::Block-->--}}
    {{--                                                        <div class="d-flex flex-column">--}}
    {{--                                                            <!--begin::Stats-->--}}
    {{--                                                            <div class="d-flex align-items-center mb-1">--}}
    {{--                                                                <!--begin::Amount-->--}}
    {{--                                                                <span class="fs-2hx fw-bold text-gray-800 me-2">16%</span>--}}
    {{--                                                                <!--end::Amount-->--}}
    {{--                                                                <!--begin::Label-->--}}
    {{--                                                                <span class="fw-semibold text-success fs-6">+4,245$</span>--}}
    {{--                                                                <!--end::Label-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Stats-->--}}
    {{--                                                            <!--begin::Total-->--}}
    {{--                                                            <span class="fw-semibold text-gray-500">For past 30 days</span>--}}
    {{--                                                            <!--end::Total-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Wrapper-->--}}
    {{--                                                        <!--begin::Chart-->--}}
    {{--                                                        <div id="kt_charts_widget_48" class="h-125px w-200px min-h-auto"></div>--}}
    {{--                                                        <!--end::Chart-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Wrapper-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Card body-->--}}
    {{--                                            </div>--}}
    {{--                                            <!--end::Chart Widget 48-->--}}
    {{--                                        </div>--}}
    {{--                                        <!--end::Col-->--}}
    {{--                                    </div>--}}
    {{--                                    <!--end::Row-->--}}
    {{--                                    <!--begin::Row-->--}}
    {{--                                    <div class="row gx-5 gx-xl-10">--}}
    {{--                                        <!--begin::Col-->--}}
    {{--                                        <div class="col-xl-6 mb-5 mb-xl-10">--}}
    {{--                                            <!--begin::Table widget 9-->--}}
    {{--                                            <div class="card card-flush h-xl-100">--}}
    {{--                                                <!--begin::Header-->--}}
    {{--                                                <div class="card-header pt-5">--}}
    {{--                                                    <!--begin::Title-->--}}
    {{--                                                    <h3 class="card-title align-items-start flex-column">--}}
    {{--                                                        <span class="card-label fw-bold text-gray-800">Top Referral Sources</span>--}}
    {{--                                                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Counted in Millions</span>--}}
    {{--                                                    </h3>--}}
    {{--                                                    <!--end::Title-->--}}
    {{--                                                    <!--begin::Toolbar-->--}}
    {{--                                                    <div class="card-toolbar">--}}
    {{--                                                        <a href="#" class="btn btn-sm btn-light">PDF Report</a>--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Toolbar-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Header-->--}}
    {{--                                                <!--begin::Body-->--}}
    {{--                                                <div class="card-body py-3">--}}
    {{--                                                    <!--begin::Table container-->--}}
    {{--                                                    <div class="table-responsive">--}}
    {{--                                                        <!--begin::Table-->--}}
    {{--                                                        <table class="table table-row-dashed align-middle gs-0 gy-4">--}}
    {{--                                                            <!--begin::Table head-->--}}
    {{--                                                            <thead>--}}
    {{--                                                            <tr class="fs-7 fw-bold border-0 text-gray-500">--}}
    {{--                                                                <th class="min-w-150px" colspan="2">CAMPAIGN</th>--}}
    {{--                                                                <th class="min-w-150px text-end pe-0" colspan="2">SESSIONS</th>--}}
    {{--                                                                <th class="text-end min-w-150px" colspan="2">CONVERSION RATE</th>--}}
    {{--                                                            </tr>--}}
    {{--                                                            </thead>--}}
    {{--                                                            <!--end::Table head-->--}}
    {{--                                                            <!--begin::Table body-->--}}
    {{--                                                            <tbody>--}}
    {{--                                                            <tr>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Google</a>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="pe-0" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-800 fw-bold fs-6 me-1">1,256</span>--}}
    {{--                                                                        <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-935</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-900 fw-bold fs-6 me-3">23.63%</span>--}}
    {{--                                                                        <span class="text-danger min-w-60px d-block text-end fw-bold fs-6">-9.35%</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                            <tr>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Facebook</a>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="pe-0" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-800 fw-bold fs-6 me-1">446</span>--}}
    {{--                                                                        <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-576</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-900 fw-bold fs-6 me-3">12.45%</span>--}}
    {{--                                                                        <span class="text-danger min-w-60px d-block text-end fw-bold fs-6">-57.02%</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                            <tr>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Bol.com</a>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="pe-0" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-800 fw-bold fs-6 me-1">67</span>--}}
    {{--                                                                        <span class="text-success min-w-50px d-block text-end fw-bold fs-6">+24</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-900 fw-bold fs-6 me-3">73.63%</span>--}}
    {{--                                                                        <span class="text-success min-w-60px d-block text-end fw-bold fs-6">+28.73%</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                            <tr>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Dutchnews.nl</a>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="pe-0" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-800 fw-bold fs-6 me-1">2,136</span>--}}
    {{--                                                                        <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-1,229</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-900 fw-bold fs-6 me-3">3.67%</span>--}}
    {{--                                                                        <span class="text-danger min-w-60px d-block text-end fw-bold fs-6">-12.29%</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                            <tr>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Stackoverflow</a>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="pe-0" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-800 fw-bold fs-6 me-1">945</span>--}}
    {{--                                                                        <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-634</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-900 fw-bold fs-6 me-3">25.03%</span>--}}
    {{--                                                                        <span class="text-danger min-w-60px d-block text-end fw-bold fs-6">-9.35%</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                            <tr>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Themeforest</a>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="pe-0" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-800 fw-bold fs-6 me-1">237</span>--}}
    {{--                                                                        <span class="text-success min-w-50px d-block text-end fw-bold fs-6">106</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-900 fw-bold fs-6 me-3">36.52%</span>--}}
    {{--                                                                        <span class="text-success min-w-60px d-block text-end fw-bold fs-6">+3.06%</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                            </tbody>--}}
    {{--                                                            <!--end::Table body-->--}}
    {{--                                                        </table>--}}
    {{--                                                        <!--end::Table-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Table container-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Body-->--}}
    {{--                                            </div>--}}
    {{--                                            <!--end::Table Widget 9-->--}}
    {{--                                        </div>--}}
    {{--                                        <!--end::Col-->--}}
    {{--                                        <!--begin::Col-->--}}
    {{--                                        <div class="col-xl-6 mb-5 mb-xl-10">--}}
    {{--                                            <!--begin::Table widget 10-->--}}
    {{--                                            <div class="card card-flush h-xl-100">--}}
    {{--                                                <!--begin::Header-->--}}
    {{--                                                <div class="card-header pt-5">--}}
    {{--                                                    <!--begin::Title-->--}}
    {{--                                                    <h3 class="card-title align-items-start flex-column">--}}
    {{--                                                        <span class="card-label fw-bold text-gray-800">Top Performing Pages</span>--}}
    {{--                                                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Counted in Millions</span>--}}
    {{--                                                    </h3>--}}
    {{--                                                    <!--end::Title-->--}}
    {{--                                                    <!--begin::Toolbar-->--}}
    {{--                                                    <div class="card-toolbar">--}}
    {{--                                                        <a href="#" class="btn btn-sm btn-light">PDF Report</a>--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Toolbar-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Header-->--}}
    {{--                                                <!--begin::Body-->--}}
    {{--                                                <div class="card-body py-3">--}}
    {{--                                                    <!--begin::Table container-->--}}
    {{--                                                    <div class="table-responsive">--}}
    {{--                                                        <!--begin::Table-->--}}
    {{--                                                        <table class="table table-row-dashed align-middle gs-0 gy-4">--}}
    {{--                                                            <!--begin::Table head-->--}}
    {{--                                                            <thead>--}}
    {{--                                                            <tr class="fs-7 fw-bold border-0 text-gray-500">--}}
    {{--                                                                <th class="min-w-200px" colspan="2">LANDING PAGE</th>--}}
    {{--                                                                <th class="min-w-100px text-end pe-0" colspan="2">CLICKS</th>--}}
    {{--                                                                <th class="text-end min-w-100px" colspan="2">AVG. POSITION</th>--}}
    {{--                                                            </tr>--}}
    {{--                                                            </thead>--}}
    {{--                                                            <!--end::Table head-->--}}
    {{--                                                            <!--begin::Table body-->--}}
    {{--                                                            <tbody>--}}
    {{--                                                            <tr>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Index</a>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="pe-0" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-800 fw-bold fs-6">1,256</span>--}}
    {{--                                                                        <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-935</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-900 fw-bold fs-6">2.63</span>--}}
    {{--                                                                        <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-1.35</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                            <tr>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Products</a>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="pe-0" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-800 fw-bold fs-6">446</span>--}}
    {{--                                                                        <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-576</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-900 fw-bold fs-6">1.45</span>--}}
    {{--                                                                        <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">0.32</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                            <tr>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">devs.keenthemes.com</a>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="pe-0" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-800 fw-bold fs-6">67</span>--}}
    {{--                                                                        <span class="text-success min-w-50px d-block text-end fw-bold fs-6">+24</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-900 fw-bold fs-6">7.63</span>--}}
    {{--                                                                        <span class="text-success min-w-50px d-block text-end fw-bold fs-6">+8.73</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                            <tr>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">studio.keenthemes.com</a>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="pe-0" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-800 fw-bold fs-6">2,136</span>--}}
    {{--                                                                        <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-1,229</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-900 fw-bold fs-6">3.67</span>--}}
    {{--                                                                        <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-2.29</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                            <tr>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">graphics.keenthemes.com</a>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="pe-0" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-800 fw-bold fs-6">945</span>--}}
    {{--                                                                        <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-634</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-900 fw-bold fs-6">5.03</span>--}}
    {{--                                                                        <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-0.35</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                            <tr>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Licenses</a>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="pe-0" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-800 fw-bold fs-6">237</span>--}}
    {{--                                                                        <span class="text-success min-w-50px d-block text-end fw-bold fs-6">106</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                                <td class="" colspan="2">--}}
    {{--                                                                    <div class="d-flex justify-content-end">--}}
    {{--                                                                        <span class="text-gray-900 fw-bold fs-6">3.52</span>--}}
    {{--                                                                        <span class="text-success min-w-50px d-block text-end fw-bold fs-6">+3.06</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                            </tbody>--}}
    {{--                                                            <!--end::Table body-->--}}
    {{--                                                        </table>--}}
    {{--                                                        <!--end::Table-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Table container-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Body-->--}}
    {{--                                            </div>--}}
    {{--                                            <!--end::Table Widget 10-->--}}
    {{--                                        </div>--}}
    {{--                                        <!--end::Col-->--}}
    {{--                                    </div>--}}
    {{--                                    <!--end::Row-->--}}
    {{--                                    <!--begin::Table widget 15-->--}}
    {{--                                    <div class="card card-flush mb-5 mb-xl-10">--}}
    {{--                                        <!--begin::Header-->--}}
    {{--                                        <div class="card-header pt-7">--}}
    {{--                                            <!--begin::Title-->--}}
    {{--                                            <h3 class="card-title align-items-start flex-column">--}}
    {{--                                                <span class="card-label fw-bold text-gray-800">Projects Stats</span>--}}
    {{--                                                <span class="text-gray-500 mt-1 fw-semibold fs-6">Updated 37 minutes ago</span>--}}
    {{--                                            </h3>--}}
    {{--                                            <!--end::Title-->--}}
    {{--                                            <!--begin::Toolbar-->--}}
    {{--                                            <div class="card-toolbar">--}}
    {{--                                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->--}}
    {{--                                                <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4">--}}
    {{--                                                    <!--begin::Display range-->--}}
    {{--                                                    <div class="text-gray-600 fw-bold">Loading date range...</div>--}}
    {{--                                                    <!--end::Display range-->--}}
    {{--                                                    <i class="ki-outline ki-calendar-8 fs-1 ms-2 me-0"></i>--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Daterangepicker-->--}}
    {{--                                            </div>--}}
    {{--                                            <!--end::Toolbar-->--}}
    {{--                                        </div>--}}
    {{--                                        <!--end::Header-->--}}
    {{--                                        <!--begin::Body-->--}}
    {{--                                        <div class="card-body pt-6">--}}
    {{--                                            <!--begin::Table container-->--}}
    {{--                                            <div class="table-responsive">--}}
    {{--                                                <!--begin::Table-->--}}
    {{--                                                <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">--}}
    {{--                                                    <!--begin::Table head-->--}}
    {{--                                                    <thead>--}}
    {{--                                                    <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">--}}
    {{--                                                        <th class="p-0 pb-3 min-w-175px text-start">ITEM</th>--}}
    {{--                                                        <th class="p-0 pb-3 min-w-100px text-end">CALLS</th>--}}
    {{--                                                        <th class="p-0 pb-3 min-w-100px text-end">CRP RANK</th>--}}
    {{--                                                        <th class="p-0 pb-3 min-w-150px text-end pe-12">PROGRESS</th>--}}
    {{--                                                        <th class="p-0 pb-3 w-125px text-end pe-7">CHART</th>--}}
    {{--                                                        <th class="p-0 pb-3 w-50px text-end">VIEW</th>--}}
    {{--                                                    </tr>--}}
    {{--                                                    </thead>--}}
    {{--                                                    <!--end::Table head-->--}}
    {{--                                                    <!--begin::Table body-->--}}
    {{--                                                    <tbody>--}}
    {{--                                                    <tr>--}}
    {{--                                                        <td>--}}
    {{--                                                            <div class="d-flex align-items-center">--}}
    {{--                                                                <div class="symbol symbol-50px me-3">--}}
    {{--                                                                    <img src="assets/media/avatars/300-3.jpg" class="" alt="" />--}}
    {{--                                                                </div>--}}
    {{--                                                                <div class="d-flex justify-content-start flex-column">--}}
    {{--                                                                    <a href="apps/projects/users.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Guy Hawkins</a>--}}
    {{--                                                                    <span class="text-gray-500 fw-semibold d-block fs-7">Haiti</span>--}}
    {{--                                                                </div>--}}
    {{--                                                            </div>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <span class="text-gray-600 fw-bold fs-6">245</span>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <span class="text-gray-600 fw-bold fs-6">$78.34%</span>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-12">--}}
    {{--                                                            <!--begin::Label-->--}}
    {{--                                                            <span class="badge badge-light-success fs-base">--}}
    {{--																		<i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>9.2%</span>--}}
    {{--                                                            <!--end::Label-->--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <div id="kt_table_widget_15_chart_1" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end">--}}
    {{--                                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">--}}
    {{--                                                                <i class="ki-outline ki-black-right fs-2 text-gray-500"></i>--}}
    {{--                                                            </a>--}}
    {{--                                                        </td>--}}
    {{--                                                    </tr>--}}
    {{--                                                    <tr>--}}
    {{--                                                        <td>--}}
    {{--                                                            <div class="d-flex align-items-center">--}}
    {{--                                                                <div class="symbol symbol-50px me-3">--}}
    {{--                                                                    <img src="assets/media/avatars/300-10.jpg" class="" alt="" />--}}
    {{--                                                                </div>--}}
    {{--                                                                <div class="d-flex justify-content-start flex-column">--}}
    {{--                                                                    <a href="apps/projects/users.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Jane Cooper</a>--}}
    {{--                                                                    <span class="text-gray-500 fw-semibold d-block fs-7">Monaco</span>--}}
    {{--                                                                </div>--}}
    {{--                                                            </div>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <span class="text-gray-600 fw-bold fs-6">725</span>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <span class="text-gray-600 fw-bold fs-6">$63.83%</span>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-12">--}}
    {{--                                                            <!--begin::Label-->--}}
    {{--                                                            <span class="badge badge-light-danger fs-base">--}}
    {{--																		<i class="ki-outline ki-arrow-down fs-5 text-danger ms-n1"></i>0.4%</span>--}}
    {{--                                                            <!--end::Label-->--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <div id="kt_table_widget_15_chart_2" class="h-50px mt-n8 pe-7" data-kt-chart-color="danger"></div>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end">--}}
    {{--                                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">--}}
    {{--                                                                <i class="ki-outline ki-black-right fs-2 text-gray-500"></i>--}}
    {{--                                                            </a>--}}
    {{--                                                        </td>--}}
    {{--                                                    </tr>--}}
    {{--                                                    <tr>--}}
    {{--                                                        <td>--}}
    {{--                                                            <div class="d-flex align-items-center">--}}
    {{--                                                                <div class="symbol symbol-50px me-3">--}}
    {{--                                                                    <img src="assets/media/avatars/300-9.jpg" class="" alt="" />--}}
    {{--                                                                </div>--}}
    {{--                                                                <div class="d-flex justify-content-start flex-column">--}}
    {{--                                                                    <a href="apps/projects/users.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Jacob Jones</a>--}}
    {{--                                                                    <span class="text-gray-500 fw-semibold d-block fs-7">Poland</span>--}}
    {{--                                                                </div>--}}
    {{--                                                            </div>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <span class="text-gray-600 fw-bold fs-6">173</span>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <span class="text-gray-600 fw-bold fs-6">$92.56%</span>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-12">--}}
    {{--                                                            <!--begin::Label-->--}}
    {{--                                                            <span class="badge badge-light-success fs-base">--}}
    {{--																		<i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>9.2%</span>--}}
    {{--                                                            <!--end::Label-->--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <div id="kt_table_widget_15_chart_3" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end">--}}
    {{--                                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">--}}
    {{--                                                                <i class="ki-outline ki-black-right fs-2 text-gray-500"></i>--}}
    {{--                                                            </a>--}}
    {{--                                                        </td>--}}
    {{--                                                    </tr>--}}
    {{--                                                    <tr>--}}
    {{--                                                        <td>--}}
    {{--                                                            <div class="d-flex align-items-center">--}}
    {{--                                                                <div class="symbol symbol-50px me-3">--}}
    {{--                                                                    <img src="assets/media/avatars/300-2.jpg" class="" alt="" />--}}
    {{--                                                                </div>--}}
    {{--                                                                <div class="d-flex justify-content-start flex-column">--}}
    {{--                                                                    <a href="apps/projects/users.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Esther Howard</a>--}}
    {{--                                                                    <span class="text-gray-500 fw-semibold d-block fs-7">Kiribatir</span>--}}
    {{--                                                                </div>--}}
    {{--                                                            </div>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <span class="text-gray-600 fw-bold fs-6">642</span>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <span class="text-gray-600 fw-bold fs-6">$64.02%</span>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-12">--}}
    {{--                                                            <!--begin::Label-->--}}
    {{--                                                            <span class="badge badge-light-success fs-base">--}}
    {{--																		<i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>9.2%</span>--}}
    {{--                                                            <!--end::Label-->--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <div id="kt_table_widget_15_chart_4" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end">--}}
    {{--                                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">--}}
    {{--                                                                <i class="ki-outline ki-black-right fs-2 text-gray-500"></i>--}}
    {{--                                                            </a>--}}
    {{--                                                        </td>--}}
    {{--                                                    </tr>--}}
    {{--                                                    <tr>--}}
    {{--                                                        <td>--}}
    {{--                                                            <div class="d-flex align-items-center">--}}
    {{--                                                                <div class="symbol symbol-50px me-3">--}}
    {{--                                                                    <img src="assets/media/avatars/300-1.jpg" class="" alt="" />--}}
    {{--                                                                </div>--}}
    {{--                                                                <div class="d-flex justify-content-start flex-column">--}}
    {{--                                                                    <a href="apps/projects/users.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Ralph Edwards</a>--}}
    {{--                                                                    <span class="text-gray-500 fw-semibold d-block fs-7">Iceland</span>--}}
    {{--                                                                </div>--}}
    {{--                                                            </div>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <span class="text-gray-600 fw-bold fs-6">329</span>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <span class="text-gray-600 fw-bold fs-6">$89.31%</span>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-12">--}}
    {{--                                                            <!--begin::Label-->--}}
    {{--                                                            <span class="badge badge-light-danger fs-base">--}}
    {{--																		<i class="ki-outline ki-arrow-down fs-5 text-danger ms-n1"></i>0.4%</span>--}}
    {{--                                                            <!--end::Label-->--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end pe-0">--}}
    {{--                                                            <div id="kt_table_widget_15_chart_5" class="h-50px mt-n8 pe-7" data-kt-chart-color="danger"></div>--}}
    {{--                                                        </td>--}}
    {{--                                                        <td class="text-end">--}}
    {{--                                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">--}}
    {{--                                                                <i class="ki-outline ki-black-right fs-2 text-gray-500"></i>--}}
    {{--                                                            </a>--}}
    {{--                                                        </td>--}}
    {{--                                                    </tr>--}}
    {{--                                                    </tbody>--}}
    {{--                                                    <!--end::Table body-->--}}
    {{--                                                </table>--}}
    {{--                                            </div>--}}
    {{--                                            <!--end::Table-->--}}
    {{--                                        </div>--}}
    {{--                                        <!--end: Card Body-->--}}
    {{--                                    </div>--}}
    {{--                                    <!--end::Table widget 15-->--}}
    {{--                                    <!--begin::Row-->--}}
    {{--                                    <div class="row gx-5 gx-xl-10">--}}
    {{--                                        <!--begin::Col-->--}}
    {{--                                        <div class="col-sm-6 mb-5 mb-sm-0">--}}
    {{--                                            <!--begin::List widget 1-->--}}
    {{--                                            <div class="card card-flush">--}}
    {{--                                                <!--begin::Header-->--}}
    {{--                                                <div class="card-header pt-5">--}}
    {{--                                                    <!--begin::Title-->--}}
    {{--                                                    <h3 class="card-title align-items-start flex-column">--}}
    {{--                                                        <span class="card-label fw-bold text-gray-900">Highlights</span>--}}
    {{--                                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Latest social statistics</span>--}}
    {{--                                                    </h3>--}}
    {{--                                                    <!--end::Title-->--}}
    {{--                                                    <!--begin::Toolbar-->--}}
    {{--                                                    <div class="card-toolbar">--}}
    {{--                                                        <!--begin::Menu-->--}}
    {{--                                                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">--}}
    {{--                                                            <i class="ki-outline ki-dots-square fs-1"></i>--}}
    {{--                                                        </button>--}}
    {{--                                                        <!--begin::Menu 2-->--}}
    {{--                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">--}}
    {{--                                                            <!--begin::Menu item-->--}}
    {{--                                                            <div class="menu-item px-3">--}}
    {{--                                                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Menu item-->--}}
    {{--                                                            <!--begin::Menu separator-->--}}
    {{--                                                            <div class="separator mb-3 opacity-75"></div>--}}
    {{--                                                            <!--end::Menu separator-->--}}
    {{--                                                            <!--begin::Menu item-->--}}
    {{--                                                            <div class="menu-item px-3">--}}
    {{--                                                                <a href="#" class="menu-link px-3">New Ticket</a>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Menu item-->--}}
    {{--                                                            <!--begin::Menu item-->--}}
    {{--                                                            <div class="menu-item px-3">--}}
    {{--                                                                <a href="#" class="menu-link px-3">New Customer</a>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Menu item-->--}}
    {{--                                                            <!--begin::Menu item-->--}}
    {{--                                                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">--}}
    {{--                                                                <!--begin::Menu item-->--}}
    {{--                                                                <a href="#" class="menu-link px-3">--}}
    {{--                                                                    <span class="menu-title">New Group</span>--}}
    {{--                                                                    <span class="menu-arrow"></span>--}}
    {{--                                                                </a>--}}
    {{--                                                                <!--end::Menu item-->--}}
    {{--                                                                <!--begin::Menu sub-->--}}
    {{--                                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">--}}
    {{--                                                                    <!--begin::Menu item-->--}}
    {{--                                                                    <div class="menu-item px-3">--}}
    {{--                                                                        <a href="#" class="menu-link px-3">Admin Group</a>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Menu item-->--}}
    {{--                                                                    <!--begin::Menu item-->--}}
    {{--                                                                    <div class="menu-item px-3">--}}
    {{--                                                                        <a href="#" class="menu-link px-3">Staff Group</a>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Menu item-->--}}
    {{--                                                                    <!--begin::Menu item-->--}}
    {{--                                                                    <div class="menu-item px-3">--}}
    {{--                                                                        <a href="#" class="menu-link px-3">Member Group</a>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Menu item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Menu sub-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Menu item-->--}}
    {{--                                                            <!--begin::Menu item-->--}}
    {{--                                                            <div class="menu-item px-3">--}}
    {{--                                                                <a href="#" class="menu-link px-3">New Contact</a>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Menu item-->--}}
    {{--                                                            <!--begin::Menu separator-->--}}
    {{--                                                            <div class="separator mt-3 opacity-75"></div>--}}
    {{--                                                            <!--end::Menu separator-->--}}
    {{--                                                            <!--begin::Menu item-->--}}
    {{--                                                            <div class="menu-item px-3">--}}
    {{--                                                                <div class="menu-content px-3 py-3">--}}
    {{--                                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>--}}
    {{--                                                                </div>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Menu item-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Menu 2-->--}}
    {{--                                                        <!--end::Menu-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Toolbar-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Header-->--}}
    {{--                                                <!--begin::Body-->--}}
    {{--                                                <div class="card-body pt-5">--}}
    {{--                                                    <!--begin::Item-->--}}
    {{--                                                    <div class="d-flex flex-stack">--}}
    {{--                                                        <!--begin::Section-->--}}
    {{--                                                        <div class="text-gray-700 fw-semibold fs-6 me-2">Avg. Client Rating</div>--}}
    {{--                                                        <!--end::Section-->--}}
    {{--                                                        <!--begin::Statistics-->--}}
    {{--                                                        <div class="d-flex align-items-senter">--}}
    {{--                                                            <i class="ki-outline ki-arrow-up-right fs-2 text-success me-2"></i>--}}
    {{--                                                            <!--begin::Number-->--}}
    {{--                                                            <span class="text-gray-900 fw-bolder fs-6">7.8</span>--}}
    {{--                                                            <!--end::Number-->--}}
    {{--                                                            <span class="text-gray-500 fw-bold fs-6">/10</span>--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Statistics-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Item-->--}}
    {{--                                                    <!--begin::Separator-->--}}
    {{--                                                    <div class="separator separator-dashed my-3"></div>--}}
    {{--                                                    <!--end::Separator-->--}}
    {{--                                                    <!--begin::Item-->--}}
    {{--                                                    <div class="d-flex flex-stack">--}}
    {{--                                                        <!--begin::Section-->--}}
    {{--                                                        <div class="text-gray-700 fw-semibold fs-6 me-2">Instagram Followers</div>--}}
    {{--                                                        <!--end::Section-->--}}
    {{--                                                        <!--begin::Statistics-->--}}
    {{--                                                        <div class="d-flex align-items-senter">--}}
    {{--                                                            <i class="ki-outline ki-arrow-down-right fs-2 text-danger me-2"></i>--}}
    {{--                                                            <!--begin::Number-->--}}
    {{--                                                            <span class="text-gray-900 fw-bolder fs-6">730k</span>--}}
    {{--                                                            <!--end::Number-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Statistics-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Item-->--}}
    {{--                                                    <!--begin::Separator-->--}}
    {{--                                                    <div class="separator separator-dashed my-3"></div>--}}
    {{--                                                    <!--end::Separator-->--}}
    {{--                                                    <!--begin::Item-->--}}
    {{--                                                    <div class="d-flex flex-stack">--}}
    {{--                                                        <!--begin::Section-->--}}
    {{--                                                        <div class="text-gray-700 fw-semibold fs-6 me-2">Google Ads CPC</div>--}}
    {{--                                                        <!--end::Section-->--}}
    {{--                                                        <!--begin::Statistics-->--}}
    {{--                                                        <div class="d-flex align-items-senter">--}}
    {{--                                                            <i class="ki-outline ki-arrow-up-right fs-2 text-success me-2"></i>--}}
    {{--                                                            <!--begin::Number-->--}}
    {{--                                                            <span class="text-gray-900 fw-bolder fs-6">$2.09</span>--}}
    {{--                                                            <!--end::Number-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Statistics-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Item-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Body-->--}}
    {{--                                            </div>--}}
    {{--                                            <!--end::LIst widget 1-->--}}
    {{--                                        </div>--}}
    {{--                                        <!--end::Col-->--}}
    {{--                                        <!--begin::Col-->--}}
    {{--                                        <div class="col-sm-6">--}}
    {{--                                            <!--begin::List widget 2-->--}}
    {{--                                            <div class="card card-flush">--}}
    {{--                                                <!--begin::Header-->--}}
    {{--                                                <div class="card-header pt-5">--}}
    {{--                                                    <!--begin::Title-->--}}
    {{--                                                    <h3 class="card-title align-items-start flex-column">--}}
    {{--                                                        <span class="card-label fw-bold text-gray-900">External Links</span>--}}
    {{--                                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Most used resources</span>--}}
    {{--                                                    </h3>--}}
    {{--                                                    <!--end::Title-->--}}
    {{--                                                    <!--begin::Toolbar-->--}}
    {{--                                                    <div class="card-toolbar">--}}
    {{--                                                        <!--begin::Menu-->--}}
    {{--                                                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">--}}
    {{--                                                            <i class="ki-outline ki-dots-square fs-1"></i>--}}
    {{--                                                        </button>--}}
    {{--                                                        <!--begin::Menu 3-->--}}
    {{--                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">--}}
    {{--                                                            <!--begin::Heading-->--}}
    {{--                                                            <div class="menu-item px-3">--}}
    {{--                                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Heading-->--}}
    {{--                                                            <!--begin::Menu item-->--}}
    {{--                                                            <div class="menu-item px-3">--}}
    {{--                                                                <a href="#" class="menu-link px-3">Create Invoice</a>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Menu item-->--}}
    {{--                                                            <!--begin::Menu item-->--}}
    {{--                                                            <div class="menu-item px-3">--}}
    {{--                                                                <a href="#" class="menu-link flex-stack px-3">Create Payment--}}
    {{--                                                                    <span class="ms-2" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">--}}
    {{--																			<i class="ki-outline ki-information fs-6"></i>--}}
    {{--																		</span></a>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Menu item-->--}}
    {{--                                                            <!--begin::Menu item-->--}}
    {{--                                                            <div class="menu-item px-3">--}}
    {{--                                                                <a href="#" class="menu-link px-3">Generate Bill</a>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Menu item-->--}}
    {{--                                                            <!--begin::Menu item-->--}}
    {{--                                                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">--}}
    {{--                                                                <a href="#" class="menu-link px-3">--}}
    {{--                                                                    <span class="menu-title">Subscription</span>--}}
    {{--                                                                    <span class="menu-arrow"></span>--}}
    {{--                                                                </a>--}}
    {{--                                                                <!--begin::Menu sub-->--}}
    {{--                                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">--}}
    {{--                                                                    <!--begin::Menu item-->--}}
    {{--                                                                    <div class="menu-item px-3">--}}
    {{--                                                                        <a href="#" class="menu-link px-3">Plans</a>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Menu item-->--}}
    {{--                                                                    <!--begin::Menu item-->--}}
    {{--                                                                    <div class="menu-item px-3">--}}
    {{--                                                                        <a href="#" class="menu-link px-3">Billing</a>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Menu item-->--}}
    {{--                                                                    <!--begin::Menu item-->--}}
    {{--                                                                    <div class="menu-item px-3">--}}
    {{--                                                                        <a href="#" class="menu-link px-3">Statements</a>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Menu item-->--}}
    {{--                                                                    <!--begin::Menu separator-->--}}
    {{--                                                                    <div class="separator my-2"></div>--}}
    {{--                                                                    <!--end::Menu separator-->--}}
    {{--                                                                    <!--begin::Menu item-->--}}
    {{--                                                                    <div class="menu-item px-3">--}}
    {{--                                                                        <div class="menu-content px-3">--}}
    {{--                                                                            <!--begin::Switch-->--}}
    {{--                                                                            <label class="form-check form-switch form-check-custom form-check-solid">--}}
    {{--                                                                                <!--begin::Input-->--}}
    {{--                                                                                <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />--}}
    {{--                                                                                <!--end::Input-->--}}
    {{--                                                                                <!--end::Label-->--}}
    {{--                                                                                <span class="form-check-label text-muted fs-6">Recuring</span>--}}
    {{--                                                                                <!--end::Label-->--}}
    {{--                                                                            </label>--}}
    {{--                                                                            <!--end::Switch-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Menu item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Menu sub-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Menu item-->--}}
    {{--                                                            <!--begin::Menu item-->--}}
    {{--                                                            <div class="menu-item px-3 my-1">--}}
    {{--                                                                <a href="#" class="menu-link px-3">Settings</a>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Menu item-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Menu 3-->--}}
    {{--                                                        <!--end::Menu-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Toolbar-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Header-->--}}
    {{--                                                <!--begin::Body-->--}}
    {{--                                                <div class="card-body pt-5">--}}
    {{--                                                    <!--begin::Item-->--}}
    {{--                                                    <div class="d-flex flex-stack">--}}
    {{--                                                        <!--begin::Title-->--}}
    {{--                                                        <a href="#" class="text-primary opacity-75-hover fs-6 fw-semibold">Google Analytics</a>--}}
    {{--                                                        <!--end::Title-->--}}
    {{--                                                        <!--begin::Action-->--}}
    {{--                                                        <button type="button" class="btn btn-icon btn-sm h-auto btn-color-gray-500 btn-active-color-primary justify-content-end">--}}
    {{--                                                            <i class="ki-outline ki-exit-right-corner fs-2"></i>--}}
    {{--                                                        </button>--}}
    {{--                                                        <!--end::Action-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Item-->--}}
    {{--                                                    <!--begin::Separator-->--}}
    {{--                                                    <div class="separator separator-dashed my-3"></div>--}}
    {{--                                                    <!--end::Separator-->--}}
    {{--                                                    <!--begin::Item-->--}}
    {{--                                                    <div class="d-flex flex-stack">--}}
    {{--                                                        <!--begin::Title-->--}}
    {{--                                                        <a href="#" class="text-primary opacity-75-hover fs-6 fw-semibold">Facebook Ads</a>--}}
    {{--                                                        <!--end::Title-->--}}
    {{--                                                        <!--begin::Action-->--}}
    {{--                                                        <button type="button" class="btn btn-icon btn-sm h-auto btn-color-gray-500 btn-active-color-primary justify-content-end">--}}
    {{--                                                            <i class="ki-outline ki-exit-right-corner fs-2"></i>--}}
    {{--                                                        </button>--}}
    {{--                                                        <!--end::Action-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Item-->--}}
    {{--                                                    <!--begin::Separator-->--}}
    {{--                                                    <div class="separator separator-dashed my-3"></div>--}}
    {{--                                                    <!--end::Separator-->--}}
    {{--                                                    <!--begin::Item-->--}}
    {{--                                                    <div class="d-flex flex-stack">--}}
    {{--                                                        <!--begin::Title-->--}}
    {{--                                                        <a href="#" class="text-primary opacity-75-hover fs-6 fw-semibold">Seranking</a>--}}
    {{--                                                        <!--end::Title-->--}}
    {{--                                                        <!--begin::Action-->--}}
    {{--                                                        <button type="button" class="btn btn-icon btn-sm h-auto btn-color-gray-500 btn-active-color-primary justify-content-end">--}}
    {{--                                                            <i class="ki-outline ki-exit-right-corner fs-2"></i>--}}
    {{--                                                        </button>--}}
    {{--                                                        <!--end::Action-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Item-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Body-->--}}
    {{--                                            </div>--}}
    {{--                                            <!--end::List widget 2-->--}}
    {{--                                        </div>--}}
    {{--                                        <!--end::Col-->--}}
    {{--                                    </div>--}}
    {{--                                    <!--end::Row-->--}}
    {{--                                </div>--}}
    {{--                                <!--end::Col-->--}}
    {{--                                <!--begin::Col-->--}}
    {{--                                <div class="col-xl-4">--}}
    {{--                                    <!--begin::Row-->--}}
    {{--                                    <div class="row gx-5 gx-xl-10">--}}
    {{--                                        <!--begin::Col-->--}}
    {{--                                        <div class="col-sm-6 col-xl-12 mb-5 mb-xl-10">--}}
    {{--                                            <!--begin::List widget 10-->--}}
    {{--                                            <div class="card card-flush">--}}
    {{--                                                <!--begin::Header-->--}}
    {{--                                                <div class="card-header pt-7">--}}
    {{--                                                    <!--begin::Title-->--}}
    {{--                                                    <h3 class="card-title align-items-start flex-column">--}}
    {{--                                                        <span class="card-label fw-bold text-gray-800">Shipment History</span>--}}
    {{--                                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">59 Active Shipments</span>--}}
    {{--                                                    </h3>--}}
    {{--                                                    <!--end::Title-->--}}
    {{--                                                    <!--begin::Toolbar-->--}}
    {{--                                                    <div class="card-toolbar">--}}
    {{--                                                        <a href="#" class="btn btn-sm btn-light" data-bs-toggle='tooltip' data-bs-dismiss='click' data-bs-custom-class="tooltip-inverse" title="Logistics App is coming soon">View All</a>--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Toolbar-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Header-->--}}
    {{--                                                <!--begin::Body-->--}}
    {{--                                                <div class="card-body">--}}
    {{--                                                    <!--begin::Nav-->--}}
    {{--                                                    <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-9">--}}
    {{--                                                        <!--begin::Item-->--}}
    {{--                                                        <li class="nav-item col-4 mx-0 p-0">--}}
    {{--                                                            <!--begin::Link-->--}}
    {{--                                                            <a class="nav-link active d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#kt_list_widget_10_tab_1">--}}
    {{--                                                                <!--begin::Subtitle-->--}}
    {{--                                                                <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Notable</span>--}}
    {{--                                                                <!--end::Subtitle-->--}}
    {{--                                                                <!--begin::Bullet-->--}}
    {{--                                                                <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>--}}
    {{--                                                                <!--end::Bullet-->--}}
    {{--                                                            </a>--}}
    {{--                                                            <!--end::Link-->--}}
    {{--                                                        </li>--}}
    {{--                                                        <!--end::Item-->--}}
    {{--                                                        <!--begin::Item-->--}}
    {{--                                                        <li class="nav-item col-4 mx-0 px-0">--}}
    {{--                                                            <!--begin::Link-->--}}
    {{--                                                            <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#kt_list_widget_10_tab_2">--}}
    {{--                                                                <!--begin::Subtitle-->--}}
    {{--                                                                <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Delivered</span>--}}
    {{--                                                                <!--end::Subtitle-->--}}
    {{--                                                                <!--begin::Bullet-->--}}
    {{--                                                                <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>--}}
    {{--                                                                <!--end::Bullet-->--}}
    {{--                                                            </a>--}}
    {{--                                                            <!--end::Link-->--}}
    {{--                                                        </li>--}}
    {{--                                                        <!--end::Item-->--}}
    {{--                                                        <!--begin::Item-->--}}
    {{--                                                        <li class="nav-item col-4 mx-0 px-0">--}}
    {{--                                                            <!--begin::Link-->--}}
    {{--                                                            <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#kt_list_widget_10_tab_3">--}}
    {{--                                                                <!--begin::Subtitle-->--}}
    {{--                                                                <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Shipping</span>--}}
    {{--                                                                <!--end::Subtitle-->--}}
    {{--                                                                <!--begin::Bullet-->--}}
    {{--                                                                <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>--}}
    {{--                                                                <!--end::Bullet-->--}}
    {{--                                                            </a>--}}
    {{--                                                            <!--end::Link-->--}}
    {{--                                                        </li>--}}
    {{--                                                        <!--end::Item-->--}}
    {{--                                                        <!--begin::Bullet-->--}}
    {{--                                                        <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>--}}
    {{--                                                        <!--end::Bullet-->--}}
    {{--                                                    </ul>--}}
    {{--                                                    <!--end::Nav-->--}}
    {{--                                                    <!--begin::Tab Content-->--}}
    {{--                                                    <div class="tab-content">--}}
    {{--                                                        <!--begin::Tap pane-->--}}
    {{--                                                        <div class="tab-pane fade show active" id="kt_list_widget_10_tab_1">--}}
    {{--                                                            <!--begin::Item-->--}}
    {{--                                                            <div class="m-0">--}}
    {{--                                                                <!--begin::Wrapper-->--}}
    {{--                                                                <div class="d-flex align-items-sm-center mb-5">--}}
    {{--                                                                    <!--begin::Symbol-->--}}
    {{--                                                                    <div class="symbol symbol-45px me-4">--}}
    {{--																				<span class="symbol-label bg-primary">--}}
    {{--																					<i class="ki-outline ki-ship text-inverse-primary fs-1"></i>--}}
    {{--																				</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Symbol-->--}}
    {{--                                                                    <!--begin::Section-->--}}
    {{--                                                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">--}}
    {{--                                                                        <div class="flex-grow-1 me-2">--}}
    {{--                                                                            <a href="#" class="text-gray-500 fs-6 fw-semibold">Ship Freight</a>--}}
    {{--                                                                            <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <span class="badge badge-lg badge-light-success fw-bold my-2 fs-8">Delivered</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Section-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Wrapper-->--}}
    {{--                                                                <!--begin::Timeline-->--}}
    {{--                                                                <div class="timeline">--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center mb-7">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line mt-1 mb-n6 mb-sm-n7"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-cd fs-2 text-danger"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Messina Harbor</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Sicily, Italy</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Hektor Container Hotel</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Tallin, EST</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Timeline-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Item-->--}}
    {{--                                                            <!--begin::Separator-->--}}
    {{--                                                            <div class="separator separator-dashed my-6"></div>--}}
    {{--                                                            <!--end::Separator-->--}}
    {{--                                                            <!--begin::Item-->--}}
    {{--                                                            <div class="m-0">--}}
    {{--                                                                <!--begin::Wrapper-->--}}
    {{--                                                                <div class="d-flex align-items-sm-center mb-5">--}}
    {{--                                                                    <!--begin::Symbol-->--}}
    {{--                                                                    <div class="symbol symbol-45px me-4">--}}
    {{--																				<span class="symbol-label bg-primary">--}}
    {{--																					<i class="ki-outline ki-truck text-inverse-primary fs-1"></i>--}}
    {{--																				</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Symbol-->--}}
    {{--                                                                    <!--begin::Section-->--}}
    {{--                                                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">--}}
    {{--                                                                        <div class="flex-grow-1 me-2">--}}
    {{--                                                                            <a href="#" class="text-gray-500 fs-6 fw-semibold">Truck Freight</a>--}}
    {{--                                                                            <span class="text-gray-800 fw-bold d-block fs-4">#0066-954784</span>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <span class="badge badge-lg badge-light-primary fw-bold my-2 fs-8">Shipping</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Section-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Wrapper-->--}}
    {{--                                                                <!--begin::Timeline-->--}}
    {{--                                                                <div class="timeline">--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center mb-7">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line mt-1 mb-n6 mb-sm-n7"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-cd fs-2 text-danger"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Haven van Rotterdam</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Rotterdam, Netherlands</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Forest-Midi</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Brussels, Belgium</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Timeline-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Item-->--}}
    {{--                                                            <!--begin::Separator-->--}}
    {{--                                                            <div class="separator separator-dashed my-6"></div>--}}
    {{--                                                            <!--end::Separator-->--}}
    {{--                                                            <!--begin::Item-->--}}
    {{--                                                            <div class="m-0">--}}
    {{--                                                                <!--begin::Wrapper-->--}}
    {{--                                                                <div class="d-flex align-items-sm-center mb-5">--}}
    {{--                                                                    <!--begin::Symbol-->--}}
    {{--                                                                    <div class="symbol symbol-45px me-4">--}}
    {{--																				<span class="symbol-label bg-primary">--}}
    {{--																					<i class="ki-outline ki-delivery text-inverse-primary fs-1"></i>--}}
    {{--																				</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Symbol-->--}}
    {{--                                                                    <!--begin::Section-->--}}
    {{--                                                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">--}}
    {{--                                                                        <div class="flex-grow-1 me-2">--}}
    {{--                                                                            <a href="#" class="text-gray-500 fs-6 fw-semibold">Delivery Freight</a>--}}
    {{--                                                                            <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <span class="badge badge-lg badge-light-success fw-bold my-2 fs-8">Delivered</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Section-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Wrapper-->--}}
    {{--                                                                <!--begin::Timeline-->--}}
    {{--                                                                <div class="timeline">--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center mb-7">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line mt-1 mb-n6 mb-sm-n7"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-cd fs-2 text-danger"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Mina St - Zayed Port</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Abu Dhabi, UAE</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">27 Drydock Boston</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Boston, USA</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Timeline-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Item-->--}}
    {{--                                                            <!--begin::Separator-->--}}
    {{--                                                            <div class="separator separator-dashed my-6"></div>--}}
    {{--                                                            <!--end::Separator-->--}}
    {{--                                                            <!--begin::Item-->--}}
    {{--                                                            <div class="m-0">--}}
    {{--                                                                <!--begin::Wrapper-->--}}
    {{--                                                                <div class="d-flex align-items-sm-center mb-5">--}}
    {{--                                                                    <!--begin::Symbol-->--}}
    {{--                                                                    <div class="symbol symbol-45px me-4">--}}
    {{--																				<span class="symbol-label bg-primary">--}}
    {{--																					<i class="ki-outline ki-airplane-square text-inverse-primary fs-1"></i>--}}
    {{--																				</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Symbol-->--}}
    {{--                                                                    <!--begin::Section-->--}}
    {{--                                                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">--}}
    {{--                                                                        <div class="flex-grow-1 me-2">--}}
    {{--                                                                            <a href="#" class="text-gray-500 fs-6 fw-semibold">Plane Freight</a>--}}
    {{--                                                                            <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <span class="badge badge-lg badge-light-danger fw-bold my-2 fs-8">Delayed</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Section-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Wrapper-->--}}
    {{--                                                                <!--begin::Timeline-->--}}
    {{--                                                                <div class="timeline">--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center mb-7">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line mt-1 mb-n6 mb-sm-n7"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-cd fs-2 text-danger"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">KLM Cargo</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Schipol Airport, Amsterdam</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Singapore Cargo</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Changi Airport, Singapore</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Timeline-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Item-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Tap pane-->--}}
    {{--                                                        <!--begin::Tap pane-->--}}
    {{--                                                        <div class="tab-pane fade" id="kt_list_widget_10_tab_2">--}}
    {{--                                                            <!--begin::Item-->--}}
    {{--                                                            <div class="m-0">--}}
    {{--                                                                <!--begin::Wrapper-->--}}
    {{--                                                                <div class="d-flex align-items-sm-center mb-5">--}}
    {{--                                                                    <!--begin::Symbol-->--}}
    {{--                                                                    <div class="symbol symbol-45px me-4">--}}
    {{--																				<span class="symbol-label bg-primary">--}}
    {{--																					<i class="ki-outline ki-airplane-square text-inverse-primary fs-1"></i>--}}
    {{--																				</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Symbol-->--}}
    {{--                                                                    <!--begin::Section-->--}}
    {{--                                                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">--}}
    {{--                                                                        <div class="flex-grow-1 me-2">--}}
    {{--                                                                            <a href="#" class="text-gray-500 fs-6 fw-semibold">Plane Freight</a>--}}
    {{--                                                                            <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <span class="badge badge-lg badge-light-success fw-bold my-2 fs-8">Delivered</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Section-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Wrapper-->--}}
    {{--                                                                <!--begin::Timeline-->--}}
    {{--                                                                <div class="timeline">--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center mb-7">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line mt-1 mb-n6 mb-sm-n7"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-cd fs-2 text-danger"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">KLM Cargo</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Schipol Airport, Amsterdam</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Singapore Cargo</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Changi Airport, Singapore</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Timeline-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Item-->--}}
    {{--                                                            <!--begin::Separator-->--}}
    {{--                                                            <div class="separator separator-dashed my-6"></div>--}}
    {{--                                                            <!--end::Separator-->--}}
    {{--                                                            <!--begin::Item-->--}}
    {{--                                                            <div class="m-0">--}}
    {{--                                                                <!--begin::Wrapper-->--}}
    {{--                                                                <div class="d-flex align-items-sm-center mb-5">--}}
    {{--                                                                    <!--begin::Symbol-->--}}
    {{--                                                                    <div class="symbol symbol-45px me-4">--}}
    {{--																				<span class="symbol-label bg-primary">--}}
    {{--																					<i class="ki-outline ki-truck text-inverse-primary fs-1"></i>--}}
    {{--																				</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Symbol-->--}}
    {{--                                                                    <!--begin::Section-->--}}
    {{--                                                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">--}}
    {{--                                                                        <div class="flex-grow-1 me-2">--}}
    {{--                                                                            <a href="#" class="text-gray-500 fs-6 fw-semibold">Truck Freight</a>--}}
    {{--                                                                            <span class="text-gray-800 fw-bold d-block fs-4">#0066-954784</span>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <span class="badge badge-lg badge-light-success fw-bold my-2 fs-8">Delivered</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Section-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Wrapper-->--}}
    {{--                                                                <!--begin::Timeline-->--}}
    {{--                                                                <div class="timeline">--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center mb-7">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line mt-1 mb-n6 mb-sm-n7"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-cd fs-2 text-danger"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Haven van Rotterdam</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Rotterdam, Netherlands</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Forest-Midi</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Brussels, Belgium</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Timeline-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Item-->--}}
    {{--                                                            <!--begin::Separator-->--}}
    {{--                                                            <div class="separator separator-dashed my-6"></div>--}}
    {{--                                                            <!--end::Separator-->--}}
    {{--                                                            <!--begin::Item-->--}}
    {{--                                                            <div class="m-0">--}}
    {{--                                                                <!--begin::Wrapper-->--}}
    {{--                                                                <div class="d-flex align-items-sm-center mb-5">--}}
    {{--                                                                    <!--begin::Symbol-->--}}
    {{--                                                                    <div class="symbol symbol-45px me-4">--}}
    {{--																				<span class="symbol-label bg-primary">--}}
    {{--																					<i class="ki-outline ki-ship text-inverse-primary fs-1"></i>--}}
    {{--																				</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Symbol-->--}}
    {{--                                                                    <!--begin::Section-->--}}
    {{--                                                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">--}}
    {{--                                                                        <div class="flex-grow-1 me-2">--}}
    {{--                                                                            <a href="#" class="text-gray-500 fs-6 fw-semibold">Ship Freight</a>--}}
    {{--                                                                            <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <span class="badge badge-lg badge-light-success fw-bold my-2 fs-8">Delivered</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Section-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Wrapper-->--}}
    {{--                                                                <!--begin::Timeline-->--}}
    {{--                                                                <div class="timeline">--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center mb-7">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line mt-1 mb-n6 mb-sm-n7"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-cd fs-2 text-danger"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Mina St - Zayed Port</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Abu Dhabi, UAE</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">27 Drydock Boston</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Boston, USA</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Timeline-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Item-->--}}
    {{--                                                            <!--begin::Separator-->--}}
    {{--                                                            <div class="separator separator-dashed my-6"></div>--}}
    {{--                                                            <!--end::Separator-->--}}
    {{--                                                            <!--begin::Item-->--}}
    {{--                                                            <div class="m-0">--}}
    {{--                                                                <!--begin::Wrapper-->--}}
    {{--                                                                <div class="d-flex align-items-sm-center mb-5">--}}
    {{--                                                                    <!--begin::Symbol-->--}}
    {{--                                                                    <div class="symbol symbol-45px me-4">--}}
    {{--																				<span class="symbol-label bg-primary">--}}
    {{--																					<i class="ki-outline ki-ship text-inverse-primary fs-1"></i>--}}
    {{--																				</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Symbol-->--}}
    {{--                                                                    <!--begin::Section-->--}}
    {{--                                                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">--}}
    {{--                                                                        <div class="flex-grow-1 me-2">--}}
    {{--                                                                            <a href="#" class="text-gray-500 fs-6 fw-semibold">Ship Freight</a>--}}
    {{--                                                                            <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <span class="badge badge-lg badge-light-success fw-bold my-2 fs-8">Delivered</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Section-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Wrapper-->--}}
    {{--                                                                <!--begin::Timeline-->--}}
    {{--                                                                <div class="timeline">--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center mb-7">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line mt-1 mb-n6 mb-sm-n7"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-cd fs-2 text-danger"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Messina Harbor</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Sicily, Italy</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Hektor Container Hotel</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Tallin, EST</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Timeline-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Item-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Tap pane-->--}}
    {{--                                                        <!--begin::Tap pane-->--}}
    {{--                                                        <div class="tab-pane fade" id="kt_list_widget_10_tab_3">--}}
    {{--                                                            <!--begin::Item-->--}}
    {{--                                                            <div class="m-0">--}}
    {{--                                                                <!--begin::Wrapper-->--}}
    {{--                                                                <div class="d-flex align-items-sm-center mb-5">--}}
    {{--                                                                    <!--begin::Symbol-->--}}
    {{--                                                                    <div class="symbol symbol-45px me-4">--}}
    {{--																				<span class="symbol-label bg-primary">--}}
    {{--																					<i class="ki-outline ki-ship text-inverse-primary fs-1"></i>--}}
    {{--																				</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Symbol-->--}}
    {{--                                                                    <!--begin::Section-->--}}
    {{--                                                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">--}}
    {{--                                                                        <div class="flex-grow-1 me-2">--}}
    {{--                                                                            <a href="#" class="text-gray-500 fs-6 fw-semibold">Ship Freight</a>--}}
    {{--                                                                            <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <span class="badge badge-lg badge-light-primary fw-bold my-2 fs-8">Shipping</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Section-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Wrapper-->--}}
    {{--                                                                <!--begin::Timeline-->--}}
    {{--                                                                <div class="timeline">--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center mb-7">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line mt-1 mb-n6 mb-sm-n7"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-cd fs-2 text-danger"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Mina St - Zayed Port</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Abu Dhabi, UAE</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">27 Drydock Boston</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Boston, USA</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Timeline-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Item-->--}}
    {{--                                                            <!--begin::Separator-->--}}
    {{--                                                            <div class="separator separator-dashed my-6"></div>--}}
    {{--                                                            <!--end::Separator-->--}}
    {{--                                                            <!--begin::Item-->--}}
    {{--                                                            <div class="m-0">--}}
    {{--                                                                <!--begin::Wrapper-->--}}
    {{--                                                                <div class="d-flex align-items-sm-center mb-5">--}}
    {{--                                                                    <!--begin::Symbol-->--}}
    {{--                                                                    <div class="symbol symbol-45px me-4">--}}
    {{--																				<span class="symbol-label bg-primary">--}}
    {{--																					<i class="ki-outline ki-airplane-square text-inverse-primary fs-1"></i>--}}
    {{--																				</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Symbol-->--}}
    {{--                                                                    <!--begin::Section-->--}}
    {{--                                                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">--}}
    {{--                                                                        <div class="flex-grow-1 me-2">--}}
    {{--                                                                            <a href="#" class="text-gray-500 fs-6 fw-semibold">Plane Freight</a>--}}
    {{--                                                                            <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <span class="badge badge-lg badge-light-primary fw-bold my-2 fs-8">Shipping</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Section-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Wrapper-->--}}
    {{--                                                                <!--begin::Timeline-->--}}
    {{--                                                                <div class="timeline">--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center mb-7">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line mt-1 mb-n6 mb-sm-n7"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-cd fs-2 text-danger"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">KLM Cargo</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Schipol Airport, Amsterdam</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Singapore Cargo</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Changi Airport, Singapore</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Timeline-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Item-->--}}
    {{--                                                            <!--begin::Separator-->--}}
    {{--                                                            <div class="separator separator-dashed my-6"></div>--}}
    {{--                                                            <!--end::Separator-->--}}
    {{--                                                            <!--begin::Item-->--}}
    {{--                                                            <div class="m-0">--}}
    {{--                                                                <!--begin::Wrapper-->--}}
    {{--                                                                <div class="d-flex align-items-sm-center mb-5">--}}
    {{--                                                                    <!--begin::Symbol-->--}}
    {{--                                                                    <div class="symbol symbol-45px me-4">--}}
    {{--																				<span class="symbol-label bg-primary">--}}
    {{--																					<i class="ki-outline ki-ship text-inverse-primary fs-1"></i>--}}
    {{--																				</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Symbol-->--}}
    {{--                                                                    <!--begin::Section-->--}}
    {{--                                                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">--}}
    {{--                                                                        <div class="flex-grow-1 me-2">--}}
    {{--                                                                            <a href="#" class="text-gray-500 fs-6 fw-semibold">Ship Freight</a>--}}
    {{--                                                                            <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <span class="badge badge-lg badge-light-primary fw-bold my-2 fs-8">Shipping</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Section-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Wrapper-->--}}
    {{--                                                                <!--begin::Timeline-->--}}
    {{--                                                                <div class="timeline">--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center mb-7">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line mt-1 mb-n6 mb-sm-n7"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-cd fs-2 text-danger"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Messina Harbor</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Sicily, Italy</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Hektor Container Hotel</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Tallin, EST</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Timeline-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Item-->--}}
    {{--                                                            <!--begin::Separator-->--}}
    {{--                                                            <div class="separator separator-dashed my-6"></div>--}}
    {{--                                                            <!--end::Separator-->--}}
    {{--                                                            <!--begin::Item-->--}}
    {{--                                                            <div class="m-0">--}}
    {{--                                                                <!--begin::Wrapper-->--}}
    {{--                                                                <div class="d-flex align-items-sm-center mb-5">--}}
    {{--                                                                    <!--begin::Symbol-->--}}
    {{--                                                                    <div class="symbol symbol-45px me-4">--}}
    {{--																				<span class="symbol-label bg-primary">--}}
    {{--																					<i class="ki-outline ki-truck text-inverse-primary fs-1"></i>--}}
    {{--																				</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Symbol-->--}}
    {{--                                                                    <!--begin::Section-->--}}
    {{--                                                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">--}}
    {{--                                                                        <div class="flex-grow-1 me-2">--}}
    {{--                                                                            <a href="#" class="text-gray-500 fs-6 fw-semibold">Truck Freight</a>--}}
    {{--                                                                            <span class="text-gray-800 fw-bold d-block fs-4">#0066-954784</span>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <span class="badge badge-lg badge-light-primary fw-bold my-2 fs-8">Shipping</span>--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Section-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Wrapper-->--}}
    {{--                                                                <!--begin::Timeline-->--}}
    {{--                                                                <div class="timeline">--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center mb-7">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line mt-1 mb-n6 mb-sm-n7"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-cd fs-2 text-danger"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Haven van Rotterdam</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Rotterdam, Netherlands</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                    <!--begin::Timeline item-->--}}
    {{--                                                                    <div class="timeline-item align-items-center">--}}
    {{--                                                                        <!--begin::Timeline line-->--}}
    {{--                                                                        <div class="timeline-line"></div>--}}
    {{--                                                                        <!--end::Timeline line-->--}}
    {{--                                                                        <!--begin::Timeline icon-->--}}
    {{--                                                                        <div class="timeline-icon">--}}
    {{--                                                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline icon-->--}}
    {{--                                                                        <!--begin::Timeline content-->--}}
    {{--                                                                        <div class="timeline-content m-0">--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 text-gray-500 fw-semibold d-block">Forest-Midi</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                            <!--begin::Title-->--}}
    {{--                                                                            <span class="fs-6 fw-bold text-gray-800">Brussels, Belgium</span>--}}
    {{--                                                                            <!--end::Title-->--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <!--end::Timeline content-->--}}
    {{--                                                                    </div>--}}
    {{--                                                                    <!--end::Timeline item-->--}}
    {{--                                                                </div>--}}
    {{--                                                                <!--end::Timeline-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Item-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Tap pane-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Tab Content-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end: Card Body-->--}}
    {{--                                            </div>--}}
    {{--                                            <!--end::List widget 10-->--}}
    {{--                                        </div>--}}
    {{--                                        <!--end::Col-->--}}
    {{--                                        <!--begin::Col-->--}}
    {{--                                        <div class="col-sm-6 col-xl-12 mb-xl-10">--}}
    {{--                                            <!--begin::List widget 11-->--}}
    {{--                                            <div class="card card-flush">--}}
    {{--                                                <!--begin::Header-->--}}
    {{--                                                <div class="card-header pt-7 mb-3">--}}
    {{--                                                    <!--begin::Title-->--}}
    {{--                                                    <h3 class="card-title align-items-start flex-column">--}}
    {{--                                                        <span class="card-label fw-bold text-gray-800">Our Fleet Tonnage</span>--}}
    {{--                                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Total 1,247 vehicles</span>--}}
    {{--                                                    </h3>--}}
    {{--                                                    <!--end::Title-->--}}
    {{--                                                    <!--begin::Toolbar-->--}}
    {{--                                                    <div class="card-toolbar">--}}
    {{--                                                        <a href="#" class="btn btn-sm btn-light" data-bs-toggle='tooltip' data-bs-dismiss='click' data-bs-custom-class="tooltip-inverse" title="Logistics App is coming soon">Review Fleet</a>--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Toolbar-->--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Header-->--}}
    {{--                                                <!--begin::Body-->--}}
    {{--                                                <div class="card-body pt-4">--}}
    {{--                                                    <!--begin::Item-->--}}
    {{--                                                    <div class="d-flex flex-stack">--}}
    {{--                                                        <!--begin::Section-->--}}
    {{--                                                        <div class="d-flex align-items-center me-5">--}}
    {{--                                                            <!--begin::Symbol-->--}}
    {{--                                                            <div class="symbol symbol-40px me-4">--}}
    {{--																		<span class="symbol-label">--}}
    {{--																			<i class="ki-outline ki-ship text-gray-600 fs-1"></i>--}}
    {{--																		</span>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Symbol-->--}}
    {{--                                                            <!--begin::Content-->--}}
    {{--                                                            <div class="me-5">--}}
    {{--                                                                <!--begin::Title-->--}}
    {{--                                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Ships</a>--}}
    {{--                                                                <!--end::Title-->--}}
    {{--                                                                <!--begin::Desc-->--}}
    {{--                                                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">234 Ships</span>--}}
    {{--                                                                <!--end::Desc-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Content-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Section-->--}}
    {{--                                                        <!--begin::Wrapper-->--}}
    {{--                                                        <div class="text-gray-500 fw-bold fs-7 text-end">--}}
    {{--                                                            <!--begin::Number-->--}}
    {{--                                                            <span class="text-gray-800 fw-bold fs-6 d-block">2,345,500</span>--}}
    {{--                                                            <!--end::Number-->Tons</div>--}}
    {{--                                                        <!--end::Wrapper-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Item-->--}}
    {{--                                                    <!--begin::Separator-->--}}
    {{--                                                    <div class="separator separator-dashed my-5"></div>--}}
    {{--                                                    <!--end::Separator-->--}}
    {{--                                                    <!--begin::Item-->--}}
    {{--                                                    <div class="d-flex flex-stack">--}}
    {{--                                                        <!--begin::Section-->--}}
    {{--                                                        <div class="d-flex align-items-center me-5">--}}
    {{--                                                            <!--begin::Symbol-->--}}
    {{--                                                            <div class="symbol symbol-40px me-4">--}}
    {{--																		<span class="symbol-label">--}}
    {{--																			<i class="ki-outline ki-truck text-gray-600 fs-1"></i>--}}
    {{--																		</span>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Symbol-->--}}
    {{--                                                            <!--begin::Content-->--}}
    {{--                                                            <div class="me-5">--}}
    {{--                                                                <!--begin::Title-->--}}
    {{--                                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Trucks</a>--}}
    {{--                                                                <!--end::Title-->--}}
    {{--                                                                <!--begin::Desc-->--}}
    {{--                                                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">1,460 Trucks</span>--}}
    {{--                                                                <!--end::Desc-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Content-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Section-->--}}
    {{--                                                        <!--begin::Wrapper-->--}}
    {{--                                                        <div class="text-gray-500 fw-bold fs-7 text-end">--}}
    {{--                                                            <!--begin::Number-->--}}
    {{--                                                            <span class="text-gray-800 fw-bold fs-6 d-block">457,200</span>--}}
    {{--                                                            <!--end::Number-->Tons</div>--}}
    {{--                                                        <!--end::Wrapper-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Item-->--}}
    {{--                                                    <!--begin::Separator-->--}}
    {{--                                                    <div class="separator separator-dashed my-5"></div>--}}
    {{--                                                    <!--end::Separator-->--}}
    {{--                                                    <!--begin::Item-->--}}
    {{--                                                    <div class="d-flex flex-stack">--}}
    {{--                                                        <!--begin::Section-->--}}
    {{--                                                        <div class="d-flex align-items-center me-5">--}}
    {{--                                                            <!--begin::Symbol-->--}}
    {{--                                                            <div class="symbol symbol-40px me-4">--}}
    {{--																		<span class="symbol-label">--}}
    {{--																			<i class="ki-outline ki-airplane-square text-gray-600 fs-1"></i>--}}
    {{--																		</span>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Symbol-->--}}
    {{--                                                            <!--begin::Content-->--}}
    {{--                                                            <div class="me-5">--}}
    {{--                                                                <!--begin::Title-->--}}
    {{--                                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Planes</a>--}}
    {{--                                                                <!--end::Title-->--}}
    {{--                                                                <!--begin::Desc-->--}}
    {{--                                                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">8 Aircrafts</span>--}}
    {{--                                                                <!--end::Desc-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Content-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Section-->--}}
    {{--                                                        <!--begin::Wrapper-->--}}
    {{--                                                        <div class="text-gray-500 fw-bold fs-7 text-end">--}}
    {{--                                                            <!--begin::Number-->--}}
    {{--                                                            <span class="text-gray-800 fw-bold fs-6 d-block">1,240</span>--}}
    {{--                                                            <!--end::Number-->Tons</div>--}}
    {{--                                                        <!--end::Wrapper-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Item-->--}}
    {{--                                                    <!--begin::Separator-->--}}
    {{--                                                    <div class="separator separator-dashed my-5"></div>--}}
    {{--                                                    <!--end::Separator-->--}}
    {{--                                                    <!--begin::Item-->--}}
    {{--                                                    <div class="d-flex flex-stack">--}}
    {{--                                                        <!--begin::Section-->--}}
    {{--                                                        <div class="d-flex align-items-center me-5">--}}
    {{--                                                            <!--begin::Symbol-->--}}
    {{--                                                            <div class="symbol symbol-40px me-4">--}}
    {{--																		<span class="symbol-label">--}}
    {{--																			<i class="ki-outline ki-bus text-gray-600 fs-1"></i>--}}
    {{--																		</span>--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Symbol-->--}}
    {{--                                                            <!--begin::Content-->--}}
    {{--                                                            <div class="me-5">--}}
    {{--                                                                <!--begin::Title-->--}}
    {{--                                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Trains</a>--}}
    {{--                                                                <!--end::Title-->--}}
    {{--                                                                <!--begin::Desc-->--}}
    {{--                                                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">36 Trains</span>--}}
    {{--                                                                <!--end::Desc-->--}}
    {{--                                                            </div>--}}
    {{--                                                            <!--end::Content-->--}}
    {{--                                                        </div>--}}
    {{--                                                        <!--end::Section-->--}}
    {{--                                                        <!--begin::Wrapper-->--}}
    {{--                                                        <div class="text-gray-500 fw-bold fs-7 text-end">--}}
    {{--                                                            <!--begin::Number-->--}}
    {{--                                                            <span class="text-gray-800 fw-bold fs-6 d-block">804,300</span>--}}
    {{--                                                            <!--end::Number-->Tons</div>--}}
    {{--                                                        <!--end::Wrapper-->--}}
    {{--                                                    </div>--}}
    {{--                                                    <!--end::Item-->--}}
    {{--                                                    <div class="text-center pt-9">--}}
    {{--                                                        <a href="apps/ecommerce/catalog/add-product.html" class="btn btn-primary">Add Vehicle</a>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
    {{--                                                <!--end::Body-->--}}
    {{--                                            </div>--}}
    {{--                                            <!--end::List widget 11-->--}}
    {{--                                        </div>--}}
    {{--                                        <!--end::Col-->--}}
    {{--                                    </div>--}}
    {{--                                    <!--end::Row-->--}}
    {{--                                </div>--}}
    {{--                                <!--end::Col-->--}}
    {{--                            </div>--}}
    {{--                            <!--end::Row-->--}}
    {{--                        </div>--}}
    {{--                        <!--end::Content container-->--}}
    {{--                    </div>--}}
    {{--                    <!--end::Content-->--}}
    {{--                </div>--}}
</x-app-layout>
