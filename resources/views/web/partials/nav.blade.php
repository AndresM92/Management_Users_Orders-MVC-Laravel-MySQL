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
