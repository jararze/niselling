<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, initial-scale=1">
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

        <!-- Meta Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '264260907692731');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
                       src="https://www.facebook.com/tr?id=264260907692731&ev=PageView&noscript=1"
            /></noscript>
        <!-- End Meta Pixel Code -->
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
