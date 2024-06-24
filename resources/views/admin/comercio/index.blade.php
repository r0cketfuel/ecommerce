@extends("admin.layout.master")

@php
    $title = "Información del comercio";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet" href="{{ config('constants.framework_css') }}panel.css">
@endsection

@php
    $breadcrumbs = [
    ];
@endphp

@section("body")
    <div class="panel" style="padding: 10px;">
        <div class="panel-content">
            @foreach ($comercio->getAttributes() as $campo => $valor)
                @if ($campo != "id")
                    <label for="{{ $campo }}">{{ ucfirst($campo) }}</label>
                    <input form="form" type="text" id="{{ $campo }}" name="{{ $campo }}" value="{{ $valor }}">
                @endif
            @endforeach
            <button form="form" class="btn-primary" type="submit">Guardar</button>
        </div>
    </div>

    <form id="form" method="post">@csrf</form>
@endsection
