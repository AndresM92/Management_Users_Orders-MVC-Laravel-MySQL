@extends('auth.app')
@section('titulo', 'Cambiar Contraseña')
@section('contenido')

    <div class="card card-outline card-primary">
        <div class="card-header">
            <a href="/" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                <h1 class="mb-0"><b>Sistema</b></h1>
            </a>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Cambiar Contraseña</p>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('password.update') }}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{$token}}">
                <div class="input-group mb-3">
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
                <div class="input-group mb-3">
                    <div class="form-floating">
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Ingrese Contraseña" />
                        <label for="password">Nuevo Contraseña</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="form-floating">
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Ingrese Contraseña" />
                        <label for="password_confirmation">Confirmar Contraseña</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
             
                <div class="row">
                    
                    <div class="col-12 align-items-center">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                        </div>
                    </div>
                    
                </div>
                
            </form>
        </div>
        
    </div>

@endsection
