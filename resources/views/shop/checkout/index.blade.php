@extends("shop.layout.master")

@php
    $title = "Checkout";
@endphp

@section("title", $title)

@php
    $breadcrumbs = [
    ];
@endphp

@section("css")
	<link rel="stylesheet"	href="{{ config('constants.shop_css') }}productCards.css">
	<link rel="stylesheet"	href="{{ config('constants.shop_css') }}progress-indicator.css">
	<link rel="stylesheet"	href="{{ config('constants.shop_css') }}carousel-forms.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}panel.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}modal.css">
@endsection

@section("js")
	<script defer src="{{ config('constants.shop_js') }}carouselForms.js"></script>
@endsection

@section("inlineCSS")
    <style>
        @media (max-width: 600px)
        {
            .panel-content .flex {
                flex-flow: 			column nowrap;
            }
        }

		.panel {
			box-shadow: 			unset;
		}

		.container {
            height:                 28px;
            width:                  100%;
            border:                 1px solid rgb(220,220,220);
            padding:                5px;
            background-color:		white;
            box-sizing:             border-box;
        }
	</style>
@endsection

@section("body")
    <div class="main-container">
		@include("shop.layout.breadcrumb")
		
		@if(count($checkout["items"])>0)

			@include("shop.checkout.includes.step-indicator")

			<div class="carousel-container">
				<div class="carousel-slider">

					<!-- Pantalla 1 -->
					<form method="post" class="step-form">
						<input type="hidden" name="currentStep" value="1">
						@csrf
						@include('shop.checkout.includes.1')
					</form>

					<!-- Pantalla 2 -->
					<form method="post" class="step-form">
						<input type="hidden" name="currentStep" value="2">
						@csrf
						@include('shop.checkout.includes.2')
					</form>

					<!-- Pantalla 3 -->
					<form method="post" class="step-form">
						<input type="hidden" name="currentStep" value="3">
						@csrf
						@include("shop.checkout.includes.3")
					</form>

					<!-- Pantalla 4 -->
					<form method="post" class="step-form">
						<input type="hidden" name="currentStep" value="4">
						@csrf
						@include("shop.checkout.includes.4")
					</form>

				</div>
			</div>
		@else
			<p>Todavía no agregaste ningún item al carrito de compras</p>
		@endif
    </div>
	<br>

	<form id="form-checkout" action="/shop/process_payment" method="post">@csrf</form>
@endsection

@if(count($checkout["items"]) > 0)
    @section("scripts")
		<script>
			document.addEventListener("DOMContentLoaded", () => {
				const radiosMedioPago   = document.querySelectorAll('input[name="radio_medioPago"]');
				const radiosMedioEnvio  = document.querySelectorAll("input[type='radio'][name='radio_medioEnvio']");
				
				const panelEnvios       = document.getElementById('shipmentPanel');
				const dataFields        = document.getElementById("shipmentData");

				radiosMedioPago.forEach(radio => {
					radio.addEventListener("change", () => handleMediosPago(radio));
				});

				radiosMedioEnvio.forEach(radio => {
					radio.addEventListener("change", () => handleMediosEnvio(radio));
				});

				medioPagoSeleccionado();

				function handleMediosPago(radio) {
					if (radio.value !== '1') {
						habilitaEnvio();
					} else {
						restablecerMedioEnvio();
						deshabilitaEnvio();
					}
				}

				function handleMediosEnvio(radio) {
					if (radio.value === '1') {
						ocultarCamposEnvio();
					} else {
						mostrarCamposEnvio();
					}
				}

				function habilitaEnvio() {
					const medio = document.querySelectorAll('input[name="radio_medioEnvio"]');
					if (medio.length > 1) {
						medio[1].removeAttribute("disabled");
					}
				}

				function deshabilitaEnvio() {
					const medio = document.querySelectorAll('input[name="radio_medioEnvio"]');
					if (medio.length > 1) {
						medio[1].setAttribute("disabled", "disabled");
					}
				}

				function mostrarCamposEnvio() {
					dataFields.style.display = "block";
				}

				function ocultarCamposEnvio() {
					dataFields.style.display = "none";
				}

				function medioPagoSeleccionado() {
					const medio = document.querySelector('input[name="radio_medioPago"]:checked');
					if (medio) {
						handleMediosPago(medio);
					}
					const medioEnvioSeleccionado = document.querySelector('input[name="radio_medioEnvio"]:checked');
					if (medioEnvioSeleccionado && medioEnvioSeleccionado.value === '1') {
						ocultarCamposEnvio();
					}
				}

				function restablecerMedioEnvio() {
					const primerMedioEnvio = document.querySelector("input[name='radio_medioEnvio']");
					if (primerMedioEnvio) {
						primerMedioEnvio.checked = true;
						ocultarCamposEnvio();
					}
				}
			});
		</script>

        <script>
            async function ajax(url = "", parameters = {}) {
                let token = document.querySelector("meta[name='csrf-token']").getAttribute("content");

                const response = await fetch(url, {
                    method: "POST",
                    cache: "no-cache",
                    credentials: "same-origin",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token,
                    },
                    redirect: "follow",
                    referrerPolicy: "strict-origin-when-cross-origin",
                    body: JSON.stringify(parameters)
                });

                return response.json();
            }

            function itemRemove(dataset) {
                let parametros = {
                    id: dataset.id,
                    atributos_id: dataset.atributos_id,
                    cantidad: '0'
                };

                const url = "/shop/requests/updateCart";
                const promise = ajax(url, parametros);

                promise.then((data) => {
                    window.location.replace("/shop/checkout");
                });
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const selectedOption = document.querySelector('input[name="radio_medioPago"]:checked');

                if (selectedOption) {
                    change(selectedOption.value);
                }
            });

            document.addEventListener('change', async function(event) {
                if (event.target.matches('[name="radio_medioPago"]')) {
                    const medioPagoId = event.target.value;
                    change(medioPagoId);
                }
            });

            async function change(medioPagoId) {

				return;

                try {
                    const response = await fetch(`shop/requests/views/payment-methods/${medioPagoId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    });
                    if (!response.ok) {
                        throw new Error('Error al obtener la vista del medio de pago');
                    }
                    const html = await response.text();
                    document.getElementById('selected_payment_method').innerHTML = html;
                } catch (error) {
                    console.error(error);
                }
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const button = document.getElementById('resume');

                button.addEventListener('click', function(event) {
                    refresh();
                });
            });

            async function refresh() {
                try {
                    const response = await fetch("requests/views/payment-methods", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    });
                    if (!response.ok) {
                        throw new Error('Error al obtener la vista del resumen de compra');
                    }
                    const html = await response.text();
                    document.getElementById('resumen').innerHTML = html;
                } catch (error) {
                    console.error(error);
                }
            }
        </script>
    @endsection
@endif
