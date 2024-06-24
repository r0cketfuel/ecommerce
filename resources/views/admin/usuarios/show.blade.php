@extends("admin.layout.master")

@php
    $title = "Detalle usuario";
@endphp

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
@endsection

@section("title", $title)

@php
    $breadcrumbs = [
        ['link' => '/admin/usuarios', 'title' => 'Usuarios'],
    ];
@endphp

@section("body")
@endsection