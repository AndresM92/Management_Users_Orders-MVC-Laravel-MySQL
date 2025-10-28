<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Shop" />
    <meta name="description" content="Shop" />
    <meta name="keywords" content="Shop" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Shop')</title>
    @flasher_render
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles2.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
    @stack('estilos')
</head>

<body>
    @include('web.partials.nav')

    @if (View::hasSection('header'))
        @include('web.partials.header')
    @endif

    @yield('contenido')

    @include('web.partials.footer')

    <a class="whatsapp-button" href="https://wa.me/57" target="_blank"><img
            src="{{ asset('Assets/icons/whatsapp.png') }}"></a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        const urlAgregarCarrito = "{{ route('carrito.agregar') }}";
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @stack('scripts')
</body>

</html>
