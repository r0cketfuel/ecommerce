<header>
    <div class="top-header">
        <div class="top-header-container">
            <marquee>
                @foreach (session("shop.marquesinas") as $marquesina)
                    {{ $marquesina->mensaje }}
                @endforeach
            </marquee>
            @auth
                <nav class="user-menu">
                    <div class="menu-container">
                        <div class="main-menu-link">
                            <div class="menu-link"><a href="#"><i class="fa-regular fa-user"></i>&nbsp;{{ explode(' ', auth()->user()->nombres)[0] }}</a></div>
                            <div class="menu-arrow"><i class="fa-solid fa-chevron-down fa-sm"></i></div>
                        </div>
                        <ul class="main-menu-submenu">
                            <li class="submenu-item">
                                <a href="/shop/account">
                                    <div class="user-menu-icon"><i class="fa-solid fa-user-gear"></i></div>
                                    <div class="user-menu-link">Mi cuenta</div>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="/shop/compras">
                                    <div class="user-menu-icon"><i class="fa-solid fa-shopping-bag"></i></div>
                                    <div class="user-menu-link">Mis compras</div>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="/shop/favoritos">
                                    <div class="user-menu-icon"><i class="fa-solid fa-heart"></i></div>
                                    <div class="user-menu-link">Favoritos</div>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="/shop/logout">
                                    <div class="user-menu-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                                    <div class="user-menu-link">Salir</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            @endauth
            @guest
                @if(session('shop.usuario.datos.id') == -1)
                    <nav class="user-menu">
                        <div class="main-menu-link">
                            <div class="menu-link"><a href="#"><i class="fa-regular fa-user"></i>&nbsp;{{ session('shop.usuario.datos.username') }}</a></div>
                            <div class="menu-arrow"><i class="fa-solid fa-chevron-down fa-sm"></i></div>
                        </div>
                        <ul class="main-menu-submenu">
                            <li class="submenu-item">
                                <div class="user-menu-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                                <div class="user-menu-link"><a href="/shop/logout">Salir</a></div>
                            </li>
                        </ul>
                    </nav>
                @else
                    <nav class="user-menu">
                        <div class="main-menu-link">
                            <div class="menu-link"><a href="{{ route('user.login') }}" id="login-link"><i class="fa-solid fa-user"></i>&nbsp;{{ __('general.login') }}</a></div>
                        </div>
                    </nav>
                @endif
            @endguest
        </div>
    </div>
    <div class="main-header">
        <div class="main-header-container">
            <div class="main-header-top">
                <div class="logo">
                    <a href="/shop">
                        <h1>{{ session("infoComercio.nombre") }}</h1>
                        <h2>{{ session("infoComercio.slogan") }}</h2>
                    </a>
                </div>
                <div class="search-bar">
                    <form id="search_form" action="/shop" method="get">
                        <input type="text" name="busqueda" id="busqueda" value="{{ isset($busqueda['searchbar']) ? $busqueda['searchbar'] : '' }}" placeholder="{{ __('general.search') }}...">
                        <button type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="iconos">
                    <div>
                        <a href="/shop/favoritos">
                            <div class="wishlist-container-icon">
                                <i class="fa-solid fa-heart"></i>
                                <div class="qty" id="heart">{{ $favoritosItemQty }}</div>
                                <div class="shopping-cart-container-label">{{ __('general.favorites') }}</div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="/shop/checkout">
                            <div class="shopping-cart-container-icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <div class="qty" id="qty">{{ $shoppingCartItemQty }}</div>
                                <div class="shopping-cart-container-label">{{ __('general.cart') }}</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="main-header-bottom">
                <nav>
                    @include("shop.layout.navbar")
                </nav>
            </div>
        </div>
    </div>
</header>