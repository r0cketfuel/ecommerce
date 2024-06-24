@extends("admin.layout.master")

@php
    $title = "Nuevo banner";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
@endsection

@php
    $breadcrumbs = [
        ['link' => '/admin/banners', 'title' => 'Banners'],
    ];
@endphp

@section("body")
    <div class="panel">
        <div class="panel-content">
            <label>
                Imágen
                <input  form="form" type="file" name="imagen" value="{{ old('imagen') }}">
            </label>

            <label>
                Descripción
                <input  form="form" type="text" name="descripcion" value="{{ old('descripcion') }}" placeholder="Breve descripción del banner">
            </label>

            <label>
                Link
                <input  form="form" type="text" name="link" value="{{ old('link') }}" placeholder="Página a donde lleva el banner">
            </label>

            <label>
                Válido desde
                <input  form="form" type="date" name="valido_desde" value="{{ old('valido_desde') }}">
            </label>

            <label>
                Válido hasta
                <input  form="form" type="date" name="valido_hasta" value="{{ old('valido_hasta') }}">
            </label>

            <label>
                <div class="radio-fix"><input form="form" type="checkbox" name="activo" value="1" @if(old('activo')) checked @endif>Activo</div>
            </label>

            <button form="form" class="btn-primary">Guardar</button>
        </div>
    </div>
    
    <form id="form" method="post"  enctype="multipart/form-data" action="{{ route('banners.store') }}">@csrf</form>

@endsection
