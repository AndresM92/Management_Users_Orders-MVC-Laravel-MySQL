@extends('web.app')
@section('contenido')
    <section class="py-5">
        <div class="container px-4 px-lg-12 my-5">
            <h2 class="fw-bold mb-4">Detalle de su Pedido</h2>
            <form action="" method="post"></form>
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <div class="row">
                                <div class="col-md-5"><strong>Producto</strong></div>
                                <div class="col-md-2 text-center"><strong>Precio</strong></div>
                                <div class="col-md-2 text-center"><strong>Cantidad</strong></div>
                                <div class="col-md-3 text-end"><strong>Subtotal</strong></div>
                            </div>
                        </div>
                        <div class="card-body" id="cartItems">
                            @forelse ($carrito as $id=>$item)
                                <!-- Product  -->
                                <div class="row mb-4 cart-item">
                                    <!-- Nombre y Codigo -->
                                    <div class="col-md-5 d-flex align-items-center">
                                        <img src="{{asset('uploads/productos/'.$item['imagen'])}}" class="img-fluid rounded"
                                            alt="{{$item['nombre']}}" style="width: 80px; height:80px; object-fit:cover;">
                                        <div class="ms-3">
                                            <h6 class="mb-1">{{$item['nombre']}}</h6>
                                            <small class="text-muted d-block">{{$item['codigo']}}</small>
                                        </div>
                                    </div>
                                    <!-- Precio -->
                                    <div class="col-md-2 text-center d-flex align-items-center justify-content-center">
                                        <span class="fw-fold">$ {{number_format($item['precio'],2)}}</span>
                                    </div>
                                    <!-- Cantidad -->
                                    <div class="col-md-2 text-center d-flex align-items-center justify-content-center">
                                        <div class="input-group input-group-sm" style="max-width: 100px;">
                                            <a class="btn btn-outline-secondary" href="{{route('carrito.restar',['producto_id'=>$id])}}"
                                                data-action="decrease">-</a>
                                            <input type="text" class="form-control text-center" value="{{$item['cantidad']}}"
                                                readonly>
                                            <a class="btn btn-outline-secondary" href="{{route('carrito.sumar',['producto_id'=>$id])}}"
                                                data-action="increase">+</a>
                                        </div>
                                    </div>
                                    <!-- SubTotal -->
                                    <div class="col-md-3 text-end d-flex align-items-center justify-content-end">
                                        <span class="subtotal me-3">{{number_format($item['precio'] * $item['cantidad'],2)}}</span>
                                        <button class="btn btn-sm btn-outline-danger remove-item">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            @empty
                                <div class="text-center">
                                    <p>Tu carrito esta vacio</p>
                                </div>
                                @if (session('mensaje'))
                                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                        {{session('mensaje')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                                    </div>
                                @endif
                            @endforelse
                        </div>
                        <div class="card-footer bg-light">
                            <div class="row">
                                <div class="col text-end">
                                    <a class="btn btn-outline-danger me-2" href="{{route('carrito.vaciar')}}" id="clearCart">
                                        <i class="bi bi-x-circle me-1"></i>Vaciar carrito
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Resumen del Pedido</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $total=0;
                                foreach ($carrito as $item) {
                                    $total+= $item['precio']* $item['cantidad'];
                                }
                            @endphp
                            <div class="d-flex justify-content-between mb-4">
                                <strong>Total</strong>
                                <strong id="orderTotal">${{number_format($total,2)}}</strong>
                            </div>
                            <!-- Checkout Button -->
                            <button class="btn btn-primary w-100" id="checkout">
                                <i class="bi bi-credit-card me-1"></i>Realizar pedido
                            </button>

                            <!-- Continue Shopping -->
                            <a href="/" class="btn btn-outline-secondary w-100 mt-3">
                                <i class="bi bi-arrow-left me-1"></i>Continuar comprando
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
@endsection
