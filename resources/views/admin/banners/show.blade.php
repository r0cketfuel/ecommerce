@extends("admin.layout.master")

@php
    $title = "Detalle de banner";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
@endsection

@php
    $breadcrumbs = [
        ['link' => '/admin/banners', 'title' => 'Banners'],
    ];
@endphp

@section("body")
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Descripción</th>
                <th>Link</th>
                <th>Valido Desde</th>
                <th>Valido Hasta</th>
                <th>Activo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="{{ $banner->imagen }}" alt="{{ $banner->descripcion }}" width="100"></td>
                <td>{{ $banner->descripcion }}</td>
                <td><a href="/{{ $banner->link }}">/{{ $banner->link }}</a></td>
                <td>{{ $banner->valido_desde }}</td>
                <td>{{ $banner->valido_hasta }}</td>
                <td>{{ $banner->activo }}</td>
            </tr>
        </tbody>
    </table>
@endsection