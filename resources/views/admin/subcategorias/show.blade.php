@extends("admin.layout.master")

@php
    $title = "Detalle subcategoría";
@endphp

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
@endsection

@section("title", $title)

@php
    $breadcrumbs = [
        ['link' => '/admin/subcategorias', 'title' => 'Subcategorias'],
    ];
@endphp

@section("body")
    <table>
        <thead>
            <tr>
                <th class="text-left">Categoría</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Descripción</th>
                <th class="text-center">Estado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $subcategoria->categoria->nombre }}</td>
                <td>{{ $subcategoria->nombre }}</td>
                <td>{{ $subcategoria->descripcion }}</td>
                <td class="text-center">
                    <label class="switch">
                        <input type="checkbox" id="{{ $subcategoria->id }}" @if($subcategoria->activo) checked @endif>
                        <div class="slider round"></div>
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
@endsection