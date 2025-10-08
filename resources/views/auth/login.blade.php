@extends('auth.app')
@section('titulo', 'Login')
@section('contenido')

    <div class="card card-outline card-primary">
        <div class="card-header">
            <a href="/" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                <h1 class="mb-0"><b>Sistema</b></h1>
            </a>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Ingrese sus credenciales</p>
            @if (Session::has('mensaje'))
                <div class="alert alert-info alert-dismissible fade show mt-2">
                    {{ Session::get('mensaje') }}
                    <button class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('login.post') }}" method="post">
                @csrf
                <div class="input-group mb-2">
                    <div class="form-floating">
                        <input id="loginEmail" name="email" type="email" class="form-control"
                            value="{{ old('email') }}" placeholder="" />
                        <label for="loginEmail">Email</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                </div>
                <div class="input-group mb-2">
                    <div class="form-floating">
                        <input id="loginPassword" name="password" type="password" class="form-control" placeholder="" />
                        <label for="loginPassword">Password</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                </div>
                <!--begin::Row-->
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12 text-center mt-4">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right me-2"></i>Ingresar</button>
                            <p class="mb-0">- OR -</p>
                            <a href="{{route('login.google')}}" class="btn btn-danger">
                                <i class="bi bi-google me-2"></i> Ingresa usando Gmail
                            </a>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!--end::Row-->
            </form>

            <p class="mb-1 mt-3 text-end"><a href="{{ route('password.request') }}">Recuperar Contraseña</a></p>
        </div>
        <!-- /.login-card-body -->
    </div>

@endsection
