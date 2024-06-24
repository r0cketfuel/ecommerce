@extends("admin.layout.master")

@php
    $title = "Modo mantenimiento";
@endphp

@section("title", $title)

@section("css")

@endsection

@php
    $breadcrumbs = [
    ];
@endphp

@section("body")
    <div class="alert"></div>

    <div class="flex align-items-center">Estado: 
        <label class="switch">
            <input type="checkbox" id="check-mantenimiento" {{ $status ? 'checked' : '' }}>
            <div class="slider round"></div>
        </label>
    </div>
@endsection

@section("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const slider = document.getElementById("check-mantenimiento");

            slider.addEventListener("change", function () {
                const estado = slider.checked ? 1 : 0;
                setMantenimiento(estado);
                return false;
            });
        });

        async function setMantenimiento(estado)
        {
            const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");

            try {
                const formData = new FormData();
                formData.append('estado', estado);

                const response = await fetch('/admin/mantenimiento', {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    body: formData
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
    </script>
@endsection