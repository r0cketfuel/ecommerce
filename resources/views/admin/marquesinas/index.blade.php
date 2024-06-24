@extends("admin.layout.master")

@php
    $title = "Marquesinas";
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
    <a class="btn-link btn-link-primary w100px" href="marquesinas/create"><span><i class="fa-solid fa-plus"></i></span>Nueva</a>

    <table>
        <thead>
            <tr>
                <th class="text-left">Mensaje</th>
                <th class="text-left">Valido Desde</th>
                <th class="text-left">Valido Hasta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($marquesinas as $marquesina)
            <tr>
                <td>{{ $marquesina->mensaje }}</td>
                <td>{{ _dateTime($marquesina->valido_desde) }}</td>
                <td>{{ _dateTime($marquesina->valido_hasta) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection