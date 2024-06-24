@extends("admin.layout.master")

@php
    $title = "Banners";
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
    <a class="btn-link btn-link-primary w100px" href="banners/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>

    <table>
        <thead>
            <tr>
                <th class="text-left">Imagen</th>
                <th class="text-left">Descripción</th>
                <th class="text-left">Link</th>
                <th class="text-left">Valido Desde</th>
                <th class="text-left">Valido Hasta</th>
                <th class="text-center">Activo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
            <tr>
                <td><img src="{{ $banner->imagen }}" alt="{{ $banner->descripcion }}" width="100"></td>
                <td>{{ $banner->descripcion }}</td>
                <td><a href="/{{ $banner->link }}">/{{ $banner->link }}</a></td>
                <td>{{ _dateTime($banner->valido_desde) }}</td>
                <td>{{ _dateTime($banner->valido_hasta) }}</td>
                <td class="text-center">
                    <label class="switch">
                        <input type="checkbox" id="{{ $banner->id }}" @if($banner->activo) checked @endif>
                        <div class="slider round"></div>
                    </label>
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
                    const bannerId = switches[i].getAttribute('id');
                    const newState = switches[i].checked ? 1 : 0;
                    ajaxItemDisable(bannerId, newState);
                    return false;
                });
            }
        });

        async function ajaxItemDisable(bannerId, newState)
        {
            try {
                const response = await fetch(`/api/banners/${bannerId}`, {
                    method: "PUT",
                    headers: {
                        'Accept':       'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ estado: newState })
                });

                if (response.ok)
                {
                    console.log('Se cambió el estado del item');
                }
                else
                {
                    console.error('Error al cambiar el estado del item');
                }
            }
            catch (error)
            {
                console.error('Error en la solicitud:', error);
            }
        }

        async function ajaxItemDelete(bannerId)
        {
            try {
                const response = await fetch(`/api/banners/${bannerId}`, {
                    method: "DELETE",
                    headers: {
                        'Accept':       'application/json',
                        'Content-Type': 'application/json',
                    },
                });

                if (response.ok)
                {
                    console.log('Item eliminado');
                }
                else
                {
                    console.error('Error al eliminar el item');
                }
            }
            catch (error)
            {
                console.error('Error en la solicitud:', error);
            }
        }
    </script>
@endsection