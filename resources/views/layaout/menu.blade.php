        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="../index.html" class="brand-link">
                    <!--begin::Brand Image-->
                    <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image opacity-75 shadow" />
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->
                    <span class="brand-text fw-light">ADMIN</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
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
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>
                                    Pedidos
                                </p>
                            </a>
                        </li>

                        @canany(['user-list', 'rol-list'])
                            <li class="nav-item" id="mSeguridad">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-speedometer"></i>
                                    <p>
                                        Seguridad
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                @can('user-list')
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('usuarios.index') }}" class="nav-link" id="itemUsuario">
                                                <i class="nav-icon bi bi-circle"></i>
                                                <p>Usuarios</p>
                                            </a>
                                        </li>
                                    </ul>
                                @endcan
                                @can('role-list')
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('roles.index') }}" class="nav-link" id="itemRoles">
                                                <i class="nav-icon bi bi-circle"></i>
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
                                    <i class="nav-icon bi bi-speedometer"></i>
                                    <p>
                                        Almacen
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                @can('product-list')
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('productos.index') }}" class="nav-link" id="itemProducto">
                                                <i class="nav-icon bi bi-circle"></i>
                                                <p>Productos</p>
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
