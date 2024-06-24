<div class="navbar-container">
    <div class="navbar">
        <div class="responsive-nav-icon" id="responsive-nav">
            <div class="font-awesome-icon-bars">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="nav-links">
            <div class="sidebar-logo">
                <span class="logo-name">{{ session("infoComercio.nombre") }}</span>
                <div class="font-awesome-icon-close">
                    <i class="fa-solid fa-x fa-lg"></i>
                </div>
            </div>
            <ul class="links">

                <li class="main-menu">
                    <div>
                        <a class="main-menu-link" href="#">Categorías</a>
                        <i class="fa-solid fa-caret-down menu-arrow arrow"></i>
                    </div>
                    <ul class="main-menu-links sub-menu">
                        @foreach($categorias as $categoria)
                            <li class="more">
                                <div>
                                    <a class="submenu-link" href="/shop?categoria={{ $categoria->id }}">{{ $categoria->nombre }}</a>
                                    <i class="fa-solid fa-caret-right more-arrow arrow"></i>
                                </div>
                                <ul class="more-sub-menu sub-menu">
                                    @foreach($categoria->subcategoria as $subcategoria)
                                        <li><a href="/shop?subcategoria={{ $subcategoria->id }}">{{ $subcategoria->nombre }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>