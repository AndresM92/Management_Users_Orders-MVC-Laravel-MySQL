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
            <p class="login-box-msg">Registro</p>
            @if (session('error'))
                <div class="alert alert-danger" id="alertss">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('registro.store') }}" method="post">
                @csrf
                <div class="mt-2 input-group mb-1">
                    <div class="form-floating">
                        <input id="name" name="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Ingrese nombre" />
                        <label for="loginEmail">Nombre</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-person"></span></div>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2 input-group mb-1">
                    <div class="form-floating">
                        <input id="email" name="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            placeholder="Ingrese correo" />
                        <label for="loginEmail">Email</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2 input-group mb-1">
                    <div class="form-floating">
                        <input id="password" name="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Ingrese Contraseña" />
                        <label for="password">Password</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2 input-group mb-1">
                    <div class="form-floating">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Ingrese Contraseña" />
                        <label for="password_confirmation">Password Confirmation</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="mt-2 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
