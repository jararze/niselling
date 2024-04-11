<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->
<head>
    <base href="../../../"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <link rel="canonical" href=""/>
    <link rel="shortcut icon" href="{{ asset('backend/assets/media/logos/favicon.ico') }}"/>
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('backend/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10">

                    {{ $slot }}

                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->
            <!--begin::Footer-->
{{--            <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">--}}
{{--                <!--begin::Links-->--}}
{{--                <div class="d-flex fw-semibold text-primary fs-base gap-5">--}}
{{--                    <a href="pages/team.html" target="_blank">Terms</a>--}}
{{--                    <a href="pages/pricing/column.html" target="_blank">Plans</a>--}}
{{--                    <a href="pages/contact.html" target="_blank">Contact Us</a>--}}
{{--                </div>--}}
{{--                <!--end::Links-->--}}
{{--            </div>--}}
            <!--end::Footer-->
        </div>
        <!--end::Body-->
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
             style="background-image: url({{ asset('backend/assets/media/misc/auth-bg.png') }})">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <!--begin::Logo-->
                <a href="{{ route('login') }}" class="mb-0 mb-lg-12">
                    <img alt="Logo" src="{{ asset('backend/assets/media/logos/Nissan_2020_logo.svg') }}" class="h-60px h-lg-75px"/>
                </a>
                <!--end::Logo-->
                <!--begin::Image-->
                <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                     src="{{ asset('backend/assets/media/misc/auth-screens.png') }}" alt=""/>
                <!--end::Image-->
                <!--begin::Title-->
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Velocidad, precisión y eficacia a la hora de vender vehículos</h1>
                <!--end::Title-->
                <!--begin::Text-->
                <div class="d-none d-lg-block text-white fs-base text-center">En <span class="opacity-75-hover text-warning fw-bold me-1">nuestro CRM</span>, la velocidad, precisión y eficacia no son solo palabras, son nuestro mantra a la hora de vender vehículos. Imagínate un cohete, pero en lugar de ir al espacio, va directo a cerrar ventas. Nuestro sistema es tan rápido que, si parpadeas, <span class="opacity-75-hover text-warning fw-bold me-1">¡podrías perderte una venta! Pero no te preocupes</span>, con nuestra precisión milimétrica, nos aseguramos de que cada detalle esté en su lugar, garantizando una experiencia sin contratiempos. Porque al final del día, lo que importa es la eficacia, y en eso, somos como un auto de carreras en la recta final: <span class="opacity-75-hover text-warning fw-bold me-1">imparables</span>.

                </div>
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Aside-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('backend/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('backend/assets/js/custom/authentication/sign-in/general.js') }}"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
