@extends("admin.layout.master")

@php
    $title = "Nueva subcategoría";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
@endsection

@php
    $breadcrumbs = [
        ['link' => '/admin/subcategorias', 'title' => 'Subcategorias'],
    ];
@endphp

@section("body")
@endsection
