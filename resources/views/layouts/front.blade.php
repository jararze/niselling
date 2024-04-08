<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Meta SEO -->
        <meta name="title" content="Cotizador Nissan Bolivia">
        <meta name="description" content="Cotiza junto con Nissan Bolivia ru proximo vehiculo. Selecciona entre una gran variedad de modelos que tenemos.">
        <meta name="robots" content="index, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="es">
        <meta name="author" content="Teknicos Bolivia">

        <!-- Social media share -->
        <meta property="og:title" content="Cotizador Nissan Bolivia">
        <meta property="og:site_name" content="Nissan Bolivia">
        <meta property="og:url" content="https://https://contacto.cotizaciones.nissan.com.bo">
        <meta property="og:description" content="Cotiza junto con Nissan Bolivia ru proximo vehiculo. Selecciona entre una gran variedad de modelos que tenemos.">
        <meta property="og:type" content="">
        <meta property="og:image" content="hhttps://https://contacto.cotizaciones.nissan.com.bo">
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@nissan" />
        <meta name="twitter:creator" content="@nissan" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/assets/media/logos/favicon.ico') }}"/>
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/media/logos/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/assets/media/logos/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/assets/media/logos/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('backend/assets/media/logos/site.webmanifest') }}">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        @stack('styles')


        @vite('resources/css/app.css')

        <title>Solicita tu cotización en Nissan</title>
    </head>
    <body>

        @include('frontend.partials.header')


        {{ $slot }}


        @include('frontend.partials.footer')



        @stack('script')
        <script>
            function toggleMenu() {
                const menu = document.getElementById('menu-modal');
                menu.classList.toggle('translate-x-full');
            }
        </script>
    </body>
</html>
