@extends('layaout.app')
@section('contenido')
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Pedidos</h3>
                    </div>

                    <div class="card-body">
                        <div>
                            <form action="{{ route('productos.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="texto" id="" class="form-control"
                                        value="{{ $text }}" placeholder="Ingrese palabra a buscar">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary"><i
                                                class="fas fa-search "></i>Buscar</button>
                                        @can('product-create')
                                            <a href="{{ route('productos.create') }}" class="btn btn-primary">Nuevo</a>
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
                                        <th>Usuario</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Detalles</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($registros) <= 0)
                                        <tr>
                                            <td colspan="7">No hay registros que coincidad con la busqueda</td>
                                        </tr>
                                    @else
                                        @foreach ($registros as $reg)
                                            <tr class="align-middle">
                                                <td>

                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modal-estado-{{$reg->id}}">
                                                    <i class="bi bi bi-arrow-repeat"></i>

                                                    </button>

                                                </td>
                                                <td>{{ $reg->id }}</td>
                                                <td>{{ $reg->user->name }}</td>
                                                <td>${{ number_format($reg->total, 2) }}</td>
                                                <td>
                                                    @php
                                                        $colors=[
                                                            'pendiente'=>'bg-warning',
                                                            'enviado'=>'bg-success',
                                                            'anulado'=>'bg-danger',
                                                            'cancelado'=>'bg-secondary',
                                                        ]
                                                    @endphp
                                                    <span
                                                        class="badge {{ $colors[$reg->estado] ?? 'bg-dark'}}">
                                                        {{ ucfirst($reg->estado) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#detalles-{{ $reg->id }}">
                                                        Ver Detalles
                                                    </button>
                                                </td>
                                                <td>{{ $reg->created_at->format('d/m/Y') }}</td>
                                            </tr>
                                            <tr class="collapse" id="detalles-{{ $reg->id }}">
                                                <td colspan="7">
                                                    <table class="table table-sm table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Producto</th>
                                                                <th>Imagen</th>
                                                                <th>Cantidad</th>
                                                                <th>Precio Unitario</th>
                                                                <th>SubTotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($reg->detalles as $detalle)
                                                                <tr>
                                                                    <td>{{$detalle->producto->nombre}}</td>
                                                                    <td>
                                                                        <img class="img-fluid rounded" src="{{asset('uploads/productos/'.$detalle->producto->imagen)}}" 
                                                                        alt="{{$detalle->producto->nombre}}" style="width: 80px; height:80px; object-fit:cover;">
                                                                    </td>
                                                                    <td>{{$detalle->cantidad}}</td>
                                                                    <td>{{number_format($detalle->precio,2)}}</td>
                                                                    <td>{{number_format($detalle->cantidad * $detalle->precio,2)}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            @include('pedido.state')
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
        document.getElementById("mAlmacen").classList.add('menu-open');
        document.getElementById("itemProducto").classList.add('active');
    </script>
@endpush
