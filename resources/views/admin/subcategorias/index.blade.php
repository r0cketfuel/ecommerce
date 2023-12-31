@extends("admin.layout.master")

@php
    $title = "Listado de subcategorías";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
@endsection

@php
    $breadcrumbs = [
    ];
@endphp

@section("body")
    <a class="btn-link btn-link-primary w100px" href="subcategorias/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>

    <table>
        <thead>
            <tr>
                <th class="text-left">Categoría</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcategorias as $subcategoria)
            <tr>
                <td>{{ $subcategoria->categoria->nombre }}</td>
                <td>{{ $subcategoria->nombre }}</td>
                <td>{{ $subcategoria->descripcion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection