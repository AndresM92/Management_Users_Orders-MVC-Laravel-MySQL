@extends('auth.app')
@section('titulo', 'Recuperar Contraseña')
@section('contenido')

    <div class="card card-outline card-primary">
        <div class="card-header">
            <a href="/" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                <h1 class="mb-0"><b>Sistema</b></h1>
            </a>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Ingrese su email para recuperar su contraseña</p>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('password.send_link') }}" method="post">
                @csrf
                @if (Session::has('mensaje'))
                    <div class="alert alert-info alert-dimissible fade show mt-2">
                        {{Session::get('mensaje')}}
                        <button class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>
                @endif
                <div class="input-group mb-1">
                    <div class="form-floating">
                        <input id="loginEmail" name="email" type="email" class="form-control"
                            value="{{ old('email') }}" placeholder=""/>
                        <label for="loginEmail">Email</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{$message}}</div>
                    @enderror
                </div>

                <div class="row">

                    <div class="col-12 align-items-center mt-5">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Enviar enlace</button>
                        </div>
                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection
