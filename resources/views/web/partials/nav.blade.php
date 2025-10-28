<!--
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">Andres.com</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Acerca</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tienda</a></li>

                <li class="nav-item dropdown">
                    @auth
                                                                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                                                                    data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->name }}</a>
                                                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                                                    <li><a class="dropdown-item" href="{{ route('perfil.pedidos') }}">Mis pedidos</a></li>
                                                                                    <li>
                                                                                        <hr class="dropdown-divider" />
                                                                                    </li>
                                                                                    <li><a class="dropdown-item" href="{{ route('perfil.edit') }}">Mi perfil</a></li>
                                                                                    <li><a class="dropdown-item" onclick="document.getElementById('logout-form').submit();">Cerrar
                                                                                            Sesion</a></li>
                                                                                </ul>
                                                                                <form class="d-none" action="{{ route('logout') }}" id="logout-form" method="post">
                                                                                    @csrf
                                                                                </form>
@else
    <a class="nav-link" href="{{ route('login') }}">Iniciar Sesion</a>
                    @endauth
                </li>
            </ul>
            <a href="{{ route('carrito.mostrar') }}" class="btn btn-outline-dark">
                <i class="bi-cart-fill me-1"></i>
                Pedido
                <span class="badge bg-dark text-white ms-1 rounded-pill">
                    {{ session('carrito') ? array_sum(array_column(session('carrito'), 'cantidad')) : 0 }}
                </span>
            </a>
        </div>
    </div>
</nav>
-->
<div class="contenedor-header">
    <nav class="nav2">
        <ul class="main-nav">
            <li><a href="#">Home</a></li>
            <li class="dropdown">
                <a href="#">Services</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">App Development</a></li>
                    <li><a href="#">SEO</a></li>
                </ul>
            </li>
            <li><a href="#">About</a></li>
            <li class="dropdown">
                @auth
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->name }}</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('perfil.pedidos') }}">Mis pedidos</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a href="{{ route('perfil.edit') }}">Mi perfil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit">Cerrar Sesion</button>
                            </form>
                        </li>
                    </ul>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Iniciar Sesion</a>
                @endauth
            </li>
            <a href="{{ route('carrito.mostrar') }}" class="btn btn-outline-dark btn-sm mx-3">
                <i class="bi-cart-fill me-1"></i>
                Pedido
                <span class="badge bg-dark text-white ms-1 rounded-pill" id="carrito">
                   {{ session('carrito') ? array_sum(array_column(session('carrito'), 'cantidad')) : 0 }} 
                </span>
            </a>
        </ul>
    </nav>
</div>
