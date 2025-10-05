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
            <p class="login-box-msg">Registro</p>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('registro.store') }}" method="post">
                @csrf
                <div class="input-group mb-1">
                    <div class="form-floating">
                        <input id="name" name="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Ingrese nombre" />
                        <label for="loginEmail">Nombre</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-1">
                    <div class="form-floating">
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            placeholder="Ingrese correo" />
                        <label for="loginEmail">Email</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-1">
                    <div class="form-floating">
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Ingrese Contraseña" />
                        <label for="password">Password</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-1">
                    <div class="form-floating">
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Ingrese Contraseña" />
                        <label for="password_confirmation">Password Confirmation</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
             
                <div class="row">
                    
                    <div class="col-6 align-items-center">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </div>
                    
                </div>
                
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
        
    </div>

@endsection
