@extends("admin.layout.master")

@php
    $title = "Listado de facturas";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}modal.css">
@endsection

@section("js")
    <script defer src="{{ config('constants.framework_js') }}modal.js"></script>
@endsection

@section("inlineCSS")
    <style>
        .input-container {
            position:   relative;
            display: 	inline-block;
            width: 		100%;
        }
    </style>
@endsection

@php
    $breadcrumbs = [
    ];
@endphp

@section("body")
    @includeIf('admin.facturas.modals.filter')
    @includeIf('admin.facturas.modals.detalleFactura')

    <div class="alert"></div>

    <div class="flex justify-content-between">
        <div class="input-container">
            <input form="form-search" type="text" name="busqueda" value="{{ isset($busqueda['searchbar']) ? $busqueda['searchbar'] : '' }}" placeholder="{{ __('general.search') }}...">
            <button form="form-search" type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <button class="filterButton" id="boton_filtros"><i class="fa-solid fa-filter"></i></button>
    </div>

    <table id="facturasTable">
        <thead>
            <tr>
                <th class="text-center">Número</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Tipo</th>
                <th class="text-left">Nombre / Razón social</th>
                <th class="text-left">Documento</th>
                <th class="text-left">Cuil</th>
                <th class="text-center">Cuit</th>
                <th class="text-center">Domicilio</th>
                <th class="text-center">Total</th>
                <th class="text-left">Medio Pago</th>
                <th class="text-center">CAE</th>
                <th class="text-center">CAE Vto</th>
                <th class="text-center">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $factura)
                <tr data-factura-id="{{ $factura->id }}">
                    <td class="text-center">{{ str_pad($factura->numero, 8, '0', STR_PAD_LEFT) }}</td>
                    <td class="text-center">{!! str_replace(" ","<br>",_dateTime($factura->fecha)) !!}</td>
                    <td class="text-center">{{ $factura->tipo->tipo }}</td>
                    <td class="text-left">{{ $factura->apellidos }}, {{ $factura->nombres }}</td>
                    <td class="text-left">{{ $factura->tipo_documento_id }}<br>{{ $factura->documento_nro }}</td>
                    <td class="text-right">{{ $factura->cuil }}</td>
                    <td class="text-right">{{ $factura->cuit }}</td>
                    <td class="text-left">{{ $factura->domicilio }} {{ $factura->domicilio_nro }}<br>{{ $factura->domicilio_piso }} {{ $factura->domicilio_depto }}</td>
                    <td class="text-right">{{ _money($factura->total) }}</td>
                    <td class="text-left">{{ $factura->medioPago->medio }}</td>
                    <td class="text-center">{{ $factura->cae }}</td>
                    <td class="text-center">{{ _date($factura->cae_vto) }}</td>
                    <td class="text-center">{{ $factura->estado->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Obtén todas las filas de la tabla
            var rows = document.querySelectorAll("#facturasTable tbody tr");

            // Agrega un evento de clic a cada fila
            rows.forEach(function (row) {
                row.addEventListener("click", function () {
                    // Muestra el modal al hacer clic en la fila
                    mostrarModalDetalleFactura();
                });
            });

            // Función para mostrar el modal
            function mostrarModalDetalleFactura() {
                // Obtén el modal
                var modal = document.getElementById("modal_detalle_factura");

                // Muestra el modal
                modal.style.display = "block";
            }
        });
    </script>
@endsection