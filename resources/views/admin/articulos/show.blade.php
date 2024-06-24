@extends("admin.layout.master")

@php
    $title = "Detalle del artículo";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
@endsection

@php
    $breadcrumbs = [
        ['link' => '/admin/articulos', 'title' => 'Artículos'],
    ];
@endphp

@section("body")
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
            </tr>
        </thead>
        <tbody>
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
                    <td class="text-right">{{ $articulo->visualizaciones }}</td>
                    <td class="text-center">
                        <label class="switch">
                            <input type="checkbox" id="{{ $articulo->id }}" @if($articulo->estado) checked @endif>
                            <div class="slider round"></div>
                        </label>
                    </td>
                </tr>
        </tbody>
    </table>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const switches = [...document.querySelectorAll("input[type='checkbox']")];

            for (let i = 0; i < switches.length; ++i) {
                switches[i].addEventListener("change", function () {
                    const articleId = switches[i].getAttribute('id');
                    const newState = switches[i].checked ? 1 : 0;
                    ajaxItemDisable(articleId, newState);
                    return false;
                });
            }
        });

        async function ajaxItemDisable(articleId, newState) {
            try {
                const response = await fetch(`/api/articulos/${articleId}`, {
                    method: "PUT",
                    headers: {
                        'Accept':       'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ estado: newState })
                });

                if (response.ok) {
                    // Actualización exitosa, puedes realizar acciones adicionales aquí
                } else {
                    // Manejar errores si es necesario
                    console.error('Error al cambiar el estado del artículo');
                }
            } catch (error) {
                console.error('Error en la solicitud:', error);
            }
        }
    </script>

@endsection
