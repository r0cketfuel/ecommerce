@extends("admin.layout.master")

@php
    $title = "Listado de usuarios";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet" href="{{ config('constants.admin_css') }}table.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}modal.css">
@endsection

@section("js")
    <script defer src="{{ config('constants.framework_js') }}modal.js"></script>
@endsection

@php
    $breadcrumbs = [
    ];
@endphp

@section("body")
    @include('admin.usuarios.modals.edit')
    
    <table>
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-left">Nombre</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Domicilio</th>
                <th class="text-center">Localidad</th>
                <th class="text-center">Teléfonos</th>
                <th class="text-center">Email</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Creado</th>
                <th class="text-center">Alta</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr data-id="{{ $usuario->id }}">
                    <td class="text-center">{{ $usuario->id }}</td>
                    <td class="text-left">{{ $usuario->apellidos }}, {{ $usuario->nombres }}</td>
                    <td class="text-left">{{ $usuario->tipoDocumento->tipo }}<br>{{ $usuario->documento_nro }}</td>
                    <td class="text-left">{{ $usuario->domicilio }} {{ $usuario->domicilio_nro }}<br>{{ $usuario->domicilio_piso }} {{ $usuario->domicilio_depto }}</td>
                    <td class="text-left">{{ $usuario->localidad }}<br>{{ $usuario->codigo_postal }}</td>
                    <td class="text-left">
                        <div class="flex justify-content-between"><div>Fijo:</div><div>{{ $usuario->telefono_fijo }}</div></div>
                        <div class="flex justify-content-between"><div>Celular:</div><div>{{ $usuario->telefono_celular }}</div></div>
                        <div class="flex justify-content-between"><div>Alternativo:</div><div>{{ $usuario->telefono_alt }}</div></div>
                    </td>
                    <td class="text-left">{{ $usuario->email }}</td>
                    <td class="text-center">
                        <label class="switch">
                            <input type="checkbox" id="{{ $usuario->id }}" @if($usuario->estado) checked @endif>
                            <div class="slider round"></div>
                        </label>
                    </td>
                    <td class="text-right">{!! str_replace(" ","<br>",_dateTime($usuario->creado)) !!}</td>
                    <td class="text-right">
                        @if ($usuario->alta)
                            {!! str_replace(" ","<br>",_dateTime($usuario->alta)) !!}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const switches = [...document.querySelectorAll("input[type='checkbox']")];

            for (let i = 0; i < switches.length; ++i) {
                switches[i].addEventListener("change", function () {
                    const userId = switches[i].getAttribute('id');
                    const newState = switches[i].checked ? 1 : 0;
                    ajaxUserDisable(userId, newState);
                    return false;
                });
            }

            const rows = [...document.getElementsByTagName("tr")];

            for (let i = 0; i < rows.length; ++i) {
                rows[i].addEventListener("click", function () {
                    openModal("modal_usuario_edit");
            })};
        });

        async function ajaxUserDisable(userId, newState) {
            try {
                const response = await fetch(`/api/usuarios/${userId}`, {
                    method: "PUT",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ estado: newState })
                });

                if (response.ok) {
                    // Actualización exitosa, puedes realizar acciones adicionales aquí
                } else {
                    // Manejar errores si es necesario
                    console.error('Error al cambiar el estado del usuario');
                }
            } catch (error) {
                console.error('Error en la solicitud:', error);
            }
        }
    </script>
@endsection
