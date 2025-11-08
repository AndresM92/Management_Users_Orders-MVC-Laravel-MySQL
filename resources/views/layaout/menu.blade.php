        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="../index.html" class="brand-link">
                    <img src="{{ asset('assets/img/MasCotas.jpg') }}" alt="AdminLTE Logo"
                        class="brand-image opacity-75 shadow" />
                    <span class="brand-text fw-light">ADMIN</span>
                </a>
            </div>

            <div class="sidebar-wrapper">
                <nav class="mt-2">

                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                        aria-label="Main navigation" data-accordion="false" id="navigation">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link" id="mnDasboard">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('perfil.pedidos') }}" class="nav-link" id="mnPedidos">
                                <i class="nav-icon bi bi-clipboard-check"></i>
                                <p>
                                    Pedidos
                                </p>
                            </a>
                        </li>

                        @canany(['user-list', 'rol-list'])
                            <li class="nav-item" id="mSeguridad">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-key"></i>
                                    <p>
                                        Seguridad
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                @can('user-list')
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('usuarios.index') }}" class="nav-link" id="itemUsuario">
                                                <i class="nav-icon bi bi-people"></i>
                                                <p>Usuarios</p>
                                            </a>
                                        </li>
                                    </ul>
                                @endcan
                                @can('role-list')
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('roles.index') }}" class="nav-link" id="itemRoles">
                                                <i class="nav-icon bi bi-ui-checks"></i>
                                                <p>Roles</p>
                                            </a>
                                        </li>
                                    </ul>
                                @endcan
                            </li>
                        @endcanany

                        @can('product-list')
                            <li class="nav-item" id="mAlmacen">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-shop"></i>
                                    <p>
                                        Almacen
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                @can('product-list')
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('productos.index') }}" class="nav-link" id="itemProducto">
                                                <i class="nav-icon bi bi-cart4"></i>
                                                <p>Productos</p>
                                            </a>
                                        </li>
                                    </ul>
                                @endcan
                            </li>
                        @endcan

                        @can('product-list')
                            <li class="nav-item" id="mMascota">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-hospital"></i>
                                    <p>
                                        Consultorio
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                @can('product-list')
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('mascotas.index') }}" class="nav-link" id="itemMascota">
                                                <img src="{{asset('assets/img/animals.png')}}" style="max-width: 20px;">
                                                <p>Mascotas</p>
                                            </a>
                                        </li>
                                    </ul>
                                @endcan
                            </li>
                        @endcan

                    </ul>

                </nav>
            </div>

        </aside>
