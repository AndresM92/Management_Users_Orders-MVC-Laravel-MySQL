@extends('layaout.app')
@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">

                    <div class="card-header">
                        <h3 class="card-title">Mascota</h3>
                    </div>

                    <div class="card-body">
                        <form id="form_mascotas"
                            action="{{ isset($mascota) ? route('mascotas.update', $mascota->id) : route('mascotas.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($mascota))
                                @method('PUT')
                            @endif
                            <section class="py-1 my-1">
                                <div class="container px-4 px-lg-5 my-5">
                                    <div class="row gx-4 gx-lg-5 align-items-center">
                                        <div class="col-md-6 d-flex flex-column align-items-center">

                                            <label for="imagen" class="form-label">Imagen</label>
                                            <input type="file" class="form-control" id="inputImagen" name="imagen">

                                            <div class="mt-3 text-center">
                                                <img id="preview"
                                                    class="img-fluid rounded shadow-sm {{ isset($mascota) && $mascota->imagen ? '' : 'd-none' }}"
                                                    src="{{ isset($mascota) && $mascota->imagen ? asset('uploads/mascotas/' . $mascota->imagen) : '' }}"
                                                    alt="Vista previa" style="max-width: 300px;">
                                            </div>
                                            @error('imagen')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                            <button type="button" id="btnEliminar"
                                                class="btn btn-outline-danger btn-md mr-5 mt-2  {{ isset($mascota) && $mascota->imagen ? '' : 'd-none' }}">
                                                Eliminar imagen
                                            </button>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-6 medium mb-1 mr-2">
                                                    <label for="name_pet" class="form-label mt-3"><strong>Nombre de
                                                            mascota</strong></label>
                                                    <input type="text"
                                                        class="form-control @error('name_pet') is-invalid @enderror"
                                                        id="name_pet" name="name_pet"
                                                        value="{{ old('name_pet', $mascota->name_pet ?? '') }}" required>
                                                    @error('name_pet')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-6 medium mb-1 mr-2">
                                                    <label for="specie"
                                                        class="form-label mt-3"><strong>Especie</strong></label>
                                                    <input type="text"
                                                        class="form-control @error('specie') is-invalid @enderror"
                                                        id="specie" name="specie"
                                                        value="{{ old('specie', $mascota->specie ?? '') }}" required>
                                                    @error('specie')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-4 medium mb-1 mr-2">
                                                    <label for="breed" class="form-label"><strong>Raza</strong></label>
                                                    <input type="text"
                                                        class="form-control @error('breed') is-invalid @enderror"
                                                        id="breed" name="breed"
                                                        value="{{ old('breed', $mascota->breed ?? '') }}" required>
                                                    @error('breed')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-4 medium mb-1 mr-2">
                                                    <label for="date_birth" class="form-label"><strong>Fecha
                                                            Nacimiento</strong></label>
                                                    <input type="date"
                                                        class="form-control @error('date_birth') is-invalid @enderror"
                                                        id="date_birth" name="date_birth"
                                                        value="{{ old('date_birth') ?: (isset($mascota) ? $mascota->date_birth->format('Y-m-d') : '') }}"
                                                        required>
                                                    @error('date_birth')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-4 medium mb-1 mr-2">
                                                    <label for="gener" class="form-label"><strong>Genero
                                                            Mascota</strong></label>

                                                    <select class="form-control @error('gener') is-invalid @enderror"
                                                        name="gener" id="gener" required>

                                                        @foreach ($generos as $genero)
                                                            <option value="{{ $genero }}"
                                                                {{ old('gener', $mascota->gener ?? '') === $genero->value ? 'selected' : '' }}>
                                                                {{ $genero->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>

                                                    @error('gener')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 medium mb-1 mr-2">
                                                    <label for="name" class="form-label"><strong>Nombre del
                                                            dueño</strong></label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="name" name="name"
                                                        value="{{ old('name', $mascota->owner->name ?? '') }}" required>
                                                    @error('name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-6 medium mb-1 mr-2">
                                                    <label for="email" class="form-label"><strong>Email</strong></label>
                                                    <input type="text"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="email" name="email"
                                                        value="{{ old('email', $mascota->owner->email ?? '') }}" required>
                                                    @error('email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 medium mb-1 mr-2">
                                                    <label for="N_cellphone" class="form-label"><strong>Numero
                                                            Celular</strong></label>
                                                    <input type="text"
                                                        class="form-control @error('N_cellphone') is-invalid @enderror"
                                                        id="N_cellphone" name="N_cellphone"
                                                        value="{{ old('N_cellphone', $mascota->owner->N_cellphone ?? '') }}"
                                                        required>
                                                    @error('N_cellphone')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-6 medium mb-1 mr-2">
                                                    <label for="address"
                                                        class="form-label"><strong>Direccion</strong></label>
                                                    <input type="text"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        id="email" name="address"
                                                        value="{{ old('address', $mascota->owner->address ?? '') }}"
                                                        required>
                                                    @error('address')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="medical_history" class="form-label"><strong>Historial
                                            Clinico</strong></label>
                                    <textarea class="form-control" name="medical_history" id="medical_history" rows="4">{{ old('medical_history', $mascota->medical_history ?? '') }}</textarea>
                                    @error('medical_history')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </section>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-secondary me-md-2"
                                    onclick="window.location.href='{{ route('mascotas.index') }}'">Cancelar</button>
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
