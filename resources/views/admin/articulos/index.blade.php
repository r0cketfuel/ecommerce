@extends("admin.layout.master")

@php
    $title = "Listado de artículos";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}modal.css">
@endsection

@section("js")
    <script defer src="{{ config('constants.framework_js') }}modal.js"></script>
@endsection

@section("inlineCSS")
    <style>
        .input-container {
            position:   relative;
            display: 	inline-block;
            width: 		100%;
        }
    </style>
@endsection

@php
    $breadcrumbs = [
    ];
@endphp

@section("body")
    @include('admin.articulos.modals.filter')

    <div class="alert"></div>

    <div class="flex justify-content-between gap-3">
        <a class="btn-link btn-link-primary w100px" href="articulos/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>
        <div class="input-container">
            <input form="form-search" type="text" name="busqueda" value="{{ isset($busqueda['searchbar']) ? $busqueda['searchbar'] : '' }}" placeholder="{{ __('general.search') }}...">
            <button form="form-search" type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <button class="filterButton" id="boton_filtros"><i class="fa-solid fa-filter"></i></button>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">Código</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Descripción</th>
                <th class="text-center">Precio</th>
                <th class="text-left">Categoría</th>
                <th class="text-left">Subcategoría</th>
                <th class="text-center">Visualizaciones</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articulos as $articulo)
                <tr>
                    <td class="text-center">{{ $articulo->codigo }}</td>
                    <td class="text-left">{{ $articulo->nombre }}</td>
                    <td class="text-left">{{ $articulo->descripcion }}</td>
                    <td class="text-right">{{ _money($articulo->precio) }}</td>
                    <td class="text-left">
                        @if(isset($articulo->categoria))
                            {{ $articulo->categoria->nombre }}
                        @endif
                    </td>
                    <td class="text-left">
                        @if(isset($articulo->subcategoria))
                            {{ $articulo->subcategoria->nombre }}
                        @endif
                    </td>
                    <td class="text-right">{{ $articulo->rating->visualizaciones }}</td>
                    <td class="text-center">
                        <label class="switch">
                            <input type="checkbox" id="{{ $articulo->id }}" @if($articulo->estado) checked @endif>
                            <div class="slider round"></div>
                        </label>
                    </td>
                    <td class="text-center">
                        <a href="/admin/articulos/{{ $articulo->id }}"><i class="fa-solid fa-eye"></i></a>
                        <button type="button" class="deleteButton" id="{{ $articulo->id }}"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const switches = [...document.querySelectorAll("input[type='checkbox']")];

            for (let i = 0; i < switches.length; ++i)
            {
                switches[i].addEventListener("change", function () {
                    const articleId = switches[i].getAttribute('id');
                    const newState = switches[i].checked ? 1 : 0;
                    ajaxItemDisable(articleId, newState);
                    return false;
                });
            }

            const buttons = [...document.querySelectorAll("button[type='button']")];

            for (let i = 0; i < buttons.length; ++i)
            {
                buttons[i].addEventListener("click", function () {
                    const articleId = buttons[i].getAttribute('id');
                    ajaxItemDelete(articleId);
                    return false;
                });
            }

            const botonFiltros          = document.getElementById("boton_filtros");
            const botonAplicarFiltros   = document.getElementById("boton_aplicar_filtros_modal");

            botonFiltros.addEventListener("click", function () { openModal("modal_filter"); return false })
            botonAplicarFiltros.addEventListener("click", function () { filter(); return false })
        });

        async function filter()
        {
            try {
                const selectEstado      = document.getElementById("modal_select_estado");
                
                window.location.href    = "/admin/articulos?estado=" + selectEstado.value;
            }
            catch (error)
            {
                console.error("Error:", error);
            }
        }

        async function ajaxItemDisable(articleId, newState)
        {
            try {
                const response = await fetch(`/api/articulos/${articleId}`, {
                    method: "PUT",
                    headers: {
                        'Accept':       'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ estado: newState })
                });

                const alertContainer = document.querySelector(".alert");

                const responseBody = await response.json();

                if (response.status == 200)
                    alertContainer.className    = "alert success";
                else
                    alertContainer.className    = "alert danger";

                alertContainer.innerHTML    = responseBody["message"] + '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
                alertContainer.style.display = 'flex';
            }
            catch (error)
            {
                console.error('Error en la solicitud:', error);
            }
        }

        async function ajaxItemDelete(articleId)
        {
            try {
                const response = await fetch(`/api/articulos/${articleId}`, {
                    method: "DELETE",
                    headers: {
                        'Accept':       'application/json',
                        'Content-Type': 'application/json',
                    },
                });

                const responseBody = await response.json();
                console.log(responseBody);
            }
            catch (error)
            {
                console.error('Error en la solicitud:', error);
            }
        }
    </script>
@endsection