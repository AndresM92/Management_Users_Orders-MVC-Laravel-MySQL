@extends('layaout.app')
@section('contenido')
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Roles</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div>
                            <form action="{{ route('roles.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="text" id="" class="form-control"
                                        value="{{ $text }}" placeholder="Ingrese palabra a buscar">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary"><i
                                                class="fas fa-search "></i>Buscar</button>
                                        @can('rol-create')
                                            <a href="{{ route('roles.create') }}" class="btn btn-primary">Nuevo</a>
                                        @endcan
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if (Session::has('mensaje'))
                            <div class="alert alert-info alert-dismissible fade show">
                                {{ Session::get('mensaje') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    arial-label="close"></button>
                            </div>
                        @endif

                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 150px">Opciones</th>
                                        <th style="width: 50px">ID</th>
                                        <th>Nombre</th>
                                        <th>Permisos</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($registros) <= 0)
                                        <tr>
                                            <td colspan="4">No hay registros que coincidad con la busqueda</td>
                                        </tr>
                                    @else
                                        @foreach ($registros as $reg)
                                            <tr class="align-middle">
                                                <td>
                                                    @can('role-edit')
                                                        <a href="{{ route('roles.edit', $reg->id) }}"
                                                            class="btn btn-warning btn-sm"><i
                                                                class="bi bi-pencil-fill"></i></a>&nbsp;
                                                    @endcan
                                                    @can('role-delete')
                                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#modal-eliminar-{{ $reg->id }}">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    @endcan
                                                </td>
                                                <td>{{ $reg->id }}</td>
                                                <td>{{ $reg->name }}</td>
                                                <td>
                                                    @if ($reg->permissions->isNotEmpty())
                                                        {!! $reg->permissions->pluck('name')->map(function ($name) {
                                                                return "<span class='badge bg-primary me-1'>$name</span>";
                                                            })->implode(' ') !!}
                                                    @else
                                                        <span class="badge bg-secondary">Sin permisos</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @can('role-delete')
                                                @include('role.eliminar')
                                            @endcan
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $registros->appends(['text' => $text]) }}
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
        document.getElementById("mSeguridad").classList.add('menu-open');
        document.getElementById("itemRoles").classList.add('active');
    </script>
@endpush
