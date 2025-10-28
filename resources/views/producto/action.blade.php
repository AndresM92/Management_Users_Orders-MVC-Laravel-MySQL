@extends('layaout.app')
@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">

                    <div class="card-header">
                        <h3 class="card-title">Productos</h3>
                    </div>

                    <div class="card-body">
                        <form id="form_productos"
                            action="{{ isset($registro) ? route('productos.update', $registro->id) : route('productos.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($registro))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label for="codigo" class="form-label">Codigo</label>
                                    <input type="text" class="form-control @error('codigo') is-invalid @enderror"
                                        id="codigo" name="codigo" value="{{ old('codigo', $registro->codigo ?? '') }}"
                                        required>
                                    @error('codigo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text"
                                        class="form-control @error('nombre', $registro->nombre ?? '') is-invalid @enderror"
                                        id="nombre" name="nombre" value="{{ old('nombre', $registro->nombre ?? '') }}"
                                        required>
                                    @error('nombre')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <input type="text"
                                        class="form-control @error('precio', $registro->precio ?? '') is-invalid @enderror"
                                        id="precio" name="precio" value="{{ old('precio', $registro->precio ?? '') }}"
                                        required>
                                    @error('precio')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label for="categoria" class="form-label">Categoria</label>
                                    <select class="form-select" name="categoria" id="activo">
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('activo')
                                        <small class="text-danger">{{ $mensaje }}</small>
                                    @enderror
                                </div>


                                <div class="col-md-2 mb-3">
                                    <label for="utilidad" class="form-label">Utilidad</label>
                                    <input type="text"
                                        class="form-control @error('utilidad', $registro->utilidad ?? '') is-invalid @enderror"
                                        id="utilidad" name="utilidad"
                                        value="{{ old('utilidad', $registro->utilidad ?? '') }}" required>
                                    @error('utilidad')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label for="precio_venta" class="form-label">Precio Venta</label>
                                    <input type="text" class="form-control" id="precio_venta" name="precio_venta"
                                        value="{{ old('precio_venta', $registro->precio_venta ?? '') }}" disabled required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" name="descripcion" id="descripcion" rows="4">
                                        {{ old('descripcion', $registro->descripcion ?? '') }}
                                    </textarea>
                                    @error('descripcion')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="imagen" class="form-label">Imagen</label>
                                    <input type="file" class="form-control @error('imagen') is-invalid @enderror"
                                        id="imagen" name="imagen" value="{{ old('imagen') }}">
                                    @error('imagen')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    @if (isset($registro) && $registro->imagen)
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/productos/' . $registro->imagen) }}"
                                                alt="Imagen Actual"
                                                style="max-width:300px; height:auto; border-radius:8px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-secondary me-md-2"
                                    onclick="window.location.href='{{ route('productos.index') }}'">Cancelar</button>
                            </div>
                        </form>

                    </div>

                    <div class="card-footer clearfix">

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById("mAlmacen").classList.add('menu-open');
        document.getElementById("itemProducto").classList.add('active');
    </script>
@endpush
