@extends("admin.layout.master")

@php
    $title = "Nueva categoría";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
@endsection

@php
    $breadcrumbs = [
        ['link' => '/admin/categorias', 'title' => 'Categorías'],
    ];
@endphp

@section("body")
@endsection