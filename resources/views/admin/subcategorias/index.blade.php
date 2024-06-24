@extends("admin.layout.master")

@php
    $title = "Listado de subcategorías";
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
    <a class="btn-link btn-link-primary w100px" href="subcategorias/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>

    <table>
        <thead>
            <tr>
                <th class="text-left">Categoría</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Descripción</th>
                <th class="text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcategorias as $subcategoria)
            <tr>
                <td>{{ $subcategoria->categoria->nombre }}</td>
                <td>{{ $subcategoria->nombre }}</td>
                <td>{{ $subcategoria->descripcion }}</td>
                <td class="text-center">
                    <a href="/admin/subcategorias/{{ $subcategoria->id }}"><i class="fa-solid fa-eye"></i></a>
                    <button type="button" class="deleteButton" id="{{ $subcategoria->id }}"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const buttons = [...document.querySelectorAll("button[type='button']")];

            for (let i = 0; i < buttons.length; ++i)
            {
                buttons[i].addEventListener("click", function () {
                    const articleId = buttons[i].getAttribute('id');
                    baja(articleId);
                    return false;
                });
            }

            async function baja(id)
            {
                try {
                    const response = await fetch(`/api/subcategorias/${id}`, {
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
        });
    </script>
@endsection