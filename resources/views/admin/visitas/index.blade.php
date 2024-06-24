@extends("admin.layout.master")

@php
    $title = "Listado de visitas";
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
    <a class="btn-link btn-link-danger w125px" href="visitas/delete"><span><i class="fa-solid fa-trash"></i></span>Vaciar tabla</a>

    <table>
        <thead>
            <tr>
                <th class="text-left">Dirección IP</th>
                <th class="text-left">Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitas as $visita)
                <tr>
                    <td>{{ $visita->ip }}</td>
                    <td>{{ _datetime($visita->fecha) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection