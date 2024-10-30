<!DOCTYPE html>
<html lang="es">
<head>
    <title>Nissan cotizacion |  {{ str_pad($quote->id, 6, '0', STR_PAD_LEFT) }} | {{ $quote->name . ' ' . $quote->last_name  }}</title>
    <style>

        p {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure,
        footer, header, hgroup, menu, nav, section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol, ul {
            list-style: none;
        }

        blockquote, q {
            quotes: none;
        }

        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        @font-face {
            font-family: 'CustomFont';
            src: url('{{ asset('fonts/Nissan-Brand-Regular.woff2') }}') format('woff2'),
            url('{{ asset('fonts/Nissan-Brand-Regular.otf') }}') format('opentype');
        }

        body {
            font-family: 'CustomFont', sans-serif;
        }

        p {
            font-size: 13px;
            line-height: 15px;
            margin: 5px 0;
        }

        h4 {
            font-size: 15px;
            margin-bottom: 1px;
            line-height: 13px;
        }

        .justify-between {
            display: flex;
            justify-content: space-between;
        }

        .justify-between div {
            mmargin-top: 10px;
            width: 100%;
            border: 1px solid #eeeeee;
            background-color: white;
            padding: 3px;
            text-align: right;
            font-size: 1rem;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-nissan {
            color: #c3002f; /* replace this with actual Nissan color code */
        }

        .font-thin {
            font-weight: lighter;
            font-size: 11px;
        }

        .column {
            width: 50%;
            float: left;
        }

        .clear {
            clear: both;
        }

        .header {
            width: 100%;
            position: relative;
        }

        .header img {
            position: absolute;
            right: -180px;
            top: -20px;
        }

        .gridParent {
            position: relative;
            max-width: 100%;
            padding: 1px 1px 1px 1px;
            margin-left: auto;
            margin-right: auto;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 16px 16px;
            border-top-width: 2px;
            width: 80%;
        }

        .gridChild {
            margin-top: 12px;
            font-size: 24px;
            letter-spacing: -0.02857em;
            color: rgba(17, 24, 39, 1);
            text-transform: uppercase;
            margin-block-start: 0.67em;
            margin-block-end: 0.67em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: normal;
        }

        .bottomDiv {
            bottom: -10px;
            left: 10.4%;
            width: 7%;
            height: 5px;
            background-color: #c3002f;
        }
    </style>
</head>
<body>
@php
    \Carbon\Carbon::setLocale('es');
@endphp
<div class="header">
    <img src="{{ asset('backend/assets/media/logos/Nissan_2020_logo.svg') }}" style="width: 260px;" alt="Nissan"/>
</div>
<div class="content">
    <div class="gridParent" style="margin-bottom: 10px">
        <h2 class="gridChild" style="margin-bottom: 4px !important;">PROFORMA</h2>
        <div class="bottomDiv"></div>
    </div>
    <p>Gracias por su preferencia. Un Asesor Profesional de Ventas lo contactará para brindarle atención personalizada.
        A continuación encontrará la proforma del vehículo de su interés</p>
    <div class="column">
        <h4 style="font-weight: normal; font-size: 20px; margin-bottom: 0px ">{{ $quote->modelOfCar->name }}</h4>
        <h4 style="font-weight: normal; font-style: italic">{{ $quote->gradeOfCar->name }}
            - {{ $quote->colorOfCar->name }}</h4>
    </div>
    <div class="column" style="margin-top: 10px">
        <div class="text-sm">
            <p><strong>Cilindrada:</strong> <span
                    id="cylindered_span">{{ $quote->gradeOfCar->cylindered  }}</span></p>
            <p><strong>Transmisión:</strong> <span
                    id="transmission_span">{{ $quote->gradeOfCar->transmission  }}</span></p>
            <p><strong>Tracción:</strong> <span
                    id="traction_span">{{ $quote->gradeOfCar->traction  }}</span></p>
            <p><strong>Año Comercial:</strong> <span
                    id="commercial_date_span">{{ $quote->gradeOfCar->commercial_date  }}</span></p>
        </div>
    </div>
    <div class="clear"></div>
    <img id="carImage"
         src="{{ asset('storage/vehicles/'.$quote->modelOfCar->slug .'/'.$quote->colorOfCar->image) }}"
         alt="{{ $quote->colorOfCar->name }}" style="width: 100%">
    <table style="width: 100%;">
        <tr>
            <td style="text-align: left; width: 50%">
                <h3 style="font-style: italic; font-size: 20px; font-weight: normal">DATOS DE LA PROFORMA</h3>
                <div class="text-sm">
                    <p><strong>Número de Proforma:</strong> <span
                            id="cylindered_span">{{ str_pad($quote->id, 6, '0', STR_PAD_LEFT) }}</span></p>
                    <p><strong>Proforma a nombre de:</strong> <span
                            id="transmission_span">{{ $quote->name . ' ' . $quote->last_name  }}</span></p>
                    <p><strong>Cédula de Identidad:</strong> <span
                            id="traction_span">{{ $quote->dni . ' ' . $quote->ext  }}</span></p>
                    <p><strong>Fecha de proforma:</strong> <span
                            id="commercial_date_span">{{ \Carbon\Carbon::parse($quote->created_at)->isoFormat('D [de] MMMM [del] YYYY') }}</span>
                    </p>
                    <p><strong>Ciudad:</strong> <span
                            id="commercial_date_span">{{ $quote->cityOfCar->name  }}</span></p>
                    <p style="font-size: 12px">Validez de la oferta: 48 horas. Paga en bolivianos al tipo de cambio oficial (6.96).</p>
                </div>
            </td>
            <td style="text-align: right; width: 50%">
                <div class="justify-between" style="margin-left: 40px">
                    <div>
                        <p>Precio</p>
                        <p class="font-bold">$us. <span
                                id="price_span">{{ number_format($quote->gradeOfCar->price, 2) }}</span></p>
                    </div>
                    <div>
                        <p>Descuento</p>
                        <p class="font-bold">$us. <span
                                id="discount_span">{{ number_format($quote->gradeOfCar->discount, 2) }}</span></p>
                    </div>
                    <div>
                        <p>Costos Adicionales</p>
                        <p class="font-bold">$us. <span
                                id="aditional_costs_span">{{ number_format($quote->gradeOfCar->discount, 2) }}</span>
                        </p>
                    </div>
                    <div>
                        <p>Precio Final</p>
                        <p class="font-bold text-nissan" style="color: #c3002f; font-weight: bold">$us. <span
                                id="final_price_span">{{ number_format(($quote->gradeOfCar->price - $quote->gradeOfCar->discount + $quote->gradeOfCar->discount), 2) }}</span>
                        </p>
                        <p class="font-thin">El precio incluye placas, registros definitivos y SOAT.</p>
                    </div>
                </div>
            </td>
        </tr>
        <!-- More rows here -->
    </table>

    <div class="clear" style="border: 1px solid #eeeeee; margin: 20px 0"></div>

    <table style="width: 100%;">
        <tr>
            <td style="text-align: left; width: 50%">
                <div class="text-sm">
                    <p><strong>Asesor de ventas:</strong> <span
                            id="cylindered_span1">{{ $quote->agentOfCar->name }}</span></p>
                    <p><strong>Showroom:</strong> <span
                            id="transmission_span1">{{ $quote->showroomOfCar->name }}</span></p>
                </div>
            </td>

            <td style="text-align: right;; width: 50%">
                <div class="text-sm">
                    <p><strong>Celular:</strong> <span
                            id="cylindered_span2">{{ $quote->agentOfCar->phone }}</span></p>
                    <p><strong>Correo Electrónico:</strong> <span
                            id="transmission_span2">{{ $quote->agentOfCar->email }}</span></p>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
