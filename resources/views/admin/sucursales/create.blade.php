@extends("admin.layout.master")

@php
    $title = "Nueva sucursal";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
@endsection

@php
    $breadcrumbs = [
        ['link' => '/admin/sucursales', 'title' => 'sucursales'],
    ];
@endphp

@section("body")
@endsection
