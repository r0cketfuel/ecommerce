@extends("admin.layout.master")

@php
    $title = "Nueva marquesina";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
@endsection

@php
    $breadcrumbs = [
        ['link' => '/admin/marquesinas', 'title' => 'Marquesinas'],
    ];
@endphp

@section("body")
    <div class="panel">
        <div class="panel-content">
            <label>
                Mensaje
                <input  form="form" type="text" name="mensaje" value="{{ old('mensaje') }}">
            </label>

            <label>
                Válido desde
                <input  form="form" type="date" name="valido_desde" value="{{ old('valido_desde') }}">
            </label>

            <label>
                Válido hasta
                <input  form="form" type="date" name="valido_hasta" value="{{ old('valido_hasta') }}">
            </label>

            <button form="form" class="btn-primary">Guardar</button>
        </div>
    </div>
    
    <form id="form" method="post"  enctype="multipart/form-data" action="{{ route('banners.store') }}">@csrf</form>

@endsection
