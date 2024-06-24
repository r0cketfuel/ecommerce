@php 
    $sucursales = session('infoComercio.sucursales');
@endphp

<footer>
    <div class="top-footer">
        <div class="top-footer-container">
            <div class="footer-section">
                <h3 class="top-footer-title">{{ __('general.about') }}</h3>
                <p>{{ session("infoComercio.descripcion") }}</p>
            </div>
            <div class="footer-section">
                <h3 class="top-footer-title">{{ __('general.contact') }}</h3>
                @foreach($sucursales as $sucursal)
                    <ul class="footer-links">
                        <li>
                            @if($sucursal['nombre'])
                                <p>
                                    <strong>{{ $sucursal['nombre'] }}</strong>
                                    @if(count($sucursales) > 1 && $sucursal['principal'])
                                        (principal)
                                    @endif
                                </p>
                            @endif
                        </li>
                        <li>
                            @if($sucursal['telefono_1'])
                                <a href="tel:{{ $sucursal['telefono_1'] }}">
                                    <span>
                                        <i class="fa-solid fa-phone"></i>
                                    </span>{{ $sucursal['telefono_1'] }}
                                </a>
                            @endif
                        </li>
                        <li>
                            @if($sucursal['email'])
                                <a href="mailto:{{ $sucursal['email'] }}">
                                    <span>
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>{{ $sucursal['email'] }}
                                </a>
                            @endif
                        </li>
                        <li>
                            @if($sucursal['geolocalizacion'])
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $sucursal['geolocalizacion'] }}">
                                    <span>
                                        <i class="fa-solid fa-location-dot"></i>
                                    </span>{{ $sucursal['direccion'] }}
                                    @if ($sucursal['entre_calles_1'] && $sucursal['entre_calles_2'])
                                        ( entre calles {{ $sucursal['entre_calles_1'] }}, {{ $sucursal['entre_calles_2'] }} )
                                    @endif
                                </a>
                            @endif
                        </li>
                        <li>
                            @if($sucursal['localidad'])
                                <a href="">
                                    <span>
                                        <i class="fa-solid fa-map"></i>
                                    </span>{{ $sucursal['localidad'] }}, {{ $sucursal['provincia'] }}
                                </a>
                            @endif
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bottom-footer">
        <div class="bottom-footer-container">
            <div class="footer-payments">
                <img src="{{ config('constants.images') }}/medios_pago/visa.png" alt="visa">
                <img src="{{ config('constants.images') }}/medios_pago/mastercard.png" alt="mastercard">
                <img src="{{ config('constants.images') }}/medios_pago/mercadopago.png" alt="mercadopago">
                <img src="{{ config('constants.images') }}/medios_pago/pagofacil.png" alt="pagofacil">
                <img src="{{ config('constants.images') }}/medios_pago/rapipago.png" alt="rapipago">
            </div>
            <div>
                <a href="#">
                    <img class="afip" src="{{ config('constants.images') }}/afip.jpg" alt="afipQR">
                </a>
            </div>
            <div>{{ date("Y") }} - FG Design</div>
        </div>
    </div>
</footer>
