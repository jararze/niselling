<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Meta SEO -->
        <meta name="title" content="Landwind - Tailwind CSS Landing Page">
        <meta name="description" content="Get started with a free and open-source landing page built with Tailwind CSS and the Flowbite component library.">
        <meta name="robots" content="index, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="English">
        <meta name="author" content="Themesberg">

        <!-- Social media share -->
        <meta property="og:title" content="Landwind - Tailwind CSS Landing Page">
        <meta property="og:site_name" content="Themesberg">
        <meta property="og:url" content="https://https://demo.themesberg.com/landwind/">
        <meta property="og:description" content="Get started with a free and open-source landing page for Tailwind CSS built with the Flowbite component library featuring dark mode, hero sections, pricing cards, and more.">
        <meta property="og:type" content="">
        <meta property="og:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/github/landwind/og-image.png">
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@themesberg" />
        <meta name="twitter:creator" content="@themesberg" />

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

    </body>
</html>
