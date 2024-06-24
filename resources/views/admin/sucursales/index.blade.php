@extends("admin.layout.master")

@php
    $title = "Sucursales";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet" href="{{ config('constants.admin_css') }}table.css">
@endsection

@php
    $breadcrumbs = [
    ];
@endphp

@section("body")
    <a class="btn-link btn-link-primary w150px" href="sucursales/create"><span><i class="fa-solid fa-plus"></i></span>Nueva sucursal</a>

    <table>
        <thead>
            <tr>
                <th class="text-left">Nombre</th>
                <th class="text-left">Direccion</th>
                <th class="text-left">Ubicacion</th>
                <th class="text-left">Telefonos</th>
                <th class="text-left">Email</th>
                <th class="text-center">Principal</th>
                <th class="text-center">Activa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sucursales as $sucursal)
            <tr>
                <td class="text-left">{{ $sucursal->nombre }}</td>
                <td class="text-left">{{ $sucursal->direccion }}<br>{{ $sucursal->entre_calles_1 }} {{ $sucursal->entre_calles_2 }}</td>
                <td class="text-left">
                    <div class="flex justify-content-between"><div>Localidad:</div><div>{{ $sucursal->localidad }}</div></div>
                    <div class="flex justify-content-between"><div>CP:</div><div>{{ $sucursal->codigo_postal }}</div></div>
                    <div class="flex justify-content-between"><div>Provincia:</div><div>{{ $sucursal->provincia }}</div></div>
                    <div class="flex justify-content-between"><div>País:</div><div>{{ $sucursal->pais }}</div></div>
                </td>
                <td class="text-left">
                    <div class="flex justify-content-between"><div>Teléfono 1:</div><div>{{ $sucursal->telefono_1 }}</div></div>
                    <div class="flex justify-content-between"><div>Teléfono 2:</div><div>{{ $sucursal->telefono_2 }}</div></div>
                    <div class="flex justify-content-between"><div>Fax:</div><div>{{ $sucursal->fax }}</div></div>
                </td>
                <td class="text-left">{{ $sucursal->email }}</td>
                <td class="text-center">{{ $sucursal->principal }}</td>


                <td class="text-center">
                    <label class="switch">
                        <input type="checkbox" id="{{ $sucursal->id }}" @if($sucursal->activo) checked @endif>
                        <div class="slider round"></div>
                    </label>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
