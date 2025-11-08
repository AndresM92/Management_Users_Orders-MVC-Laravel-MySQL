@extends('layaout.app')
@section('contenido')
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Mascotas</h3>
                    </div>

                    <div class="card-body">
                        <div>
                            <form action="{{ route('mascotas.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="text" id="" class="form-control"
                                        value="{{ $text }}" placeholder="Ingrese palabra a buscar">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary"><i
                                                class="fas fa-search "></i>Buscar</button>
                                        @can('product-create')
                                            <a href="{{ route('mascotas.create') }}" class="btn btn-primary">Nuevo</a>
                                        @endcan

                                    </div>
                                </div>
                            </form>
                        </div>

                        @if (Session::has('mensaje'))
                            <div class="alert alert-info alert-dismissible fade show" id="alertss">
                                {{ Session::get('mensaje') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    arial-label="close"></button>
                            </div>
                        @endif

                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 180px">Opciones</th>
                                        <th>Nombre</th>
                                        <th>Raza</th>
                                        <th>Edad</th>
                                        <th>Nombre del dueño</th>
                                        <th>Email</th>
                                        <th>Historial</th>
                                        <th>Imagen</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($registro) <= 0)
                                        <tr>
                                            <td colspan="9">No hay registros que coincidad con la busqueda</td>
                                        </tr>
                                    @else
                                        @foreach ($registro as $reg)
                                            <tr class="align-middle">
                                                <td>

                                                    @can('product-edit')
                                                        <a href="{{ route('mascotas.edit', $reg->id) }}"
                                                            class="btn btn-warning btn-md"><i
                                                                class="bi bi-pencil-fill"></i></a>&nbsp;
                                                    @endcan

                                                    @can('product-delete')
                                                        <button class="btn btn-danger btn-md" data-bs-toggle="modal"
                                                            data-bs-target="#modal-eliminar-{{ $reg->id }}"><i
                                                                class="bi bi-trash-fill"></i></button>
                                                    @endcan

                                                    @can('product-edit')
                                                        <a href="{{ route('mascotas.send_historial_clinico', $reg->id) }}"
                                                            class="btn btn-primary btn-md"><i
                                                                class="bi bi-filetype-pdf"></i></a>&nbsp;
                                                    @endcan

                                                </td>
                                                <td>{{ $reg->name_pet }}</td>
                                                <td>{{ $reg->breed }}</td>
                                                <td>{{ $reg->edad }}</td>
                                                <td>{{ $reg->owner->name }}</td>
                                                <td>{{ $reg->owner->email }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-md" data-bs-toggle="modal"
                                                        data-bs-target="#modal-estado-{{ $reg->id }}">
                                                        Ver historial
                                                    </button>
                                                </td>

                                                <td>
                                                    @if ($reg->imagen)
                                                        <img src= "{{ asset('uploads/mascotas/' . $reg->imagen) }}"
                                                            alt="{{ $reg->name_pet }}"
                                                            style="max-width:150px; height: 100px;">

                                                        <img src= "{{ url('mascotas/imagen/' . $reg->imagen) }}"
                                                        alt="{{ $reg->name_pet }}"
                                                            style="max-width:150px; height: 100px;">
                                                        @else <span>Sin imagen</span>

                                                    @endif
                                                </td>
                                            </tr>
                                            @can('product-delete')
                                                @include('mascota.eliminar')
                                            @endcan
                                            @include('mascota.historial')
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $registro->appends(['text' => $text]) }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById("mMascota").classList.add('menu-open');
        document.getElementById("itemMascota").classList.add('active');
    </script>
@endpush
