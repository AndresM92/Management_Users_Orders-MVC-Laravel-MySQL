@extends('auth.app')
@section('titulo', 'Login')
@section('contenido')

    <div class="card card-outline card-primary">
        <div class="card-header">
            <a href="../index2.html" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                <h1 class="mb-0"><b>Sistema</b></h1>
            </a>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Ingrese sus credenciales</p>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('login.post') }}" method="post">
                @csrf
                <div class="input-group mb-1">
                    <div class="form-floating">
                        <input id="loginEmail" name="email" type="email" class="form-control"
                            value="{{ old('email') }}" placeholder="" />
                        <label for="loginEmail">Email</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                </div>
                <div class="input-group mb-1">
                    <div class="form-floating">
                        <input id="loginPassword" name="password" type="password" class="form-control" placeholder="" />
                        <label for="loginPassword">Password</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                </div>
                <!--begin::Row-->
                <div class="row">
                    <!-- /.col -->
                    <div class="col-6 align-items-center">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!--end::Row-->
            </form>
            <!--
                  <div class="social-auth-links text-center mb-3 d-grid gap-2">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-primary">
                      <i class="bi bi-facebook me-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-danger">
                      <i class="bi bi-google me-2"></i> Sign in using Google+
                    </a>
                  </div>
                   /.social-auth-links -->
            <p class="mb-1"><a href="forgot-password.html">Olvidaste tu contraseña</p>
        </div>
        <!-- /.login-card-body -->
    </div>

@endsection
