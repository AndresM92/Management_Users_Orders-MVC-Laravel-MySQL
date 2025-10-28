document.addEventListener('DOMContentLoaded', function () {
    const inputImagen = document.getElementById('inputImagen');
    const preview = document.getElementById('preview');
   

    if (inputImagen) {
        inputImagen.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    btnEliminar.classList.remove('d-none');
                    inputImagen.classList.add('d-none');

                };
                reader.readAsDataURL(file);
            }
        });
    }

    if (btnEliminar) {
        btnEliminar.addEventListener('click', function () {
            inputImagen.value = ''; // Limpia el input file
            preview.src = '';
            preview.classList.add('d-none');
            btnEliminar.classList.add('d-none');
            inputImagen.classList.remove('d-none');
        });
    }
});



document.addEventListener('DOMContentLoaded', function () {
    const precioInput = document.getElementById('precio');
    const utilidadInput = document.getElementById('utilidad');
    const precioVentaInput = document.getElementById('precio_venta');

    function calcularPrecioVenta() {
        const precio = parseFloat(precioInput.value) || 0;
        const utilidad = parseFloat(utilidadInput.value) || 0;


        const precioVenta = precio + (precio * (utilidad / 100));
        precioVentaInput.value = precioVenta.toFixed(2);
    }

    // Calcular cuando el usuario termine de escribir
    precioInput.addEventListener('blur', calcularPrecioVenta);
    utilidadInput.addEventListener('blur', calcularPrecioVenta);

    document.getElementById('form_productos').addEventListener('keydown', function (event) {
        if (event.key === 'Enter' && event.target.tagName === 'INPUT') {
            event.preventDefault();
            calcularPrecioVenta();
        }
    });
});

function showToastrSuccess(message) {
    toastr.success(
        message, 'Agregado',
        {
            timeOut: 3000,
            progressBar: true,
            closeButton: true
        }
    );
}

setTimeout(function () {
    var alert = document.getElementById('alertss');
    var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
    bsAlert.close();
}, 2000);


$('.add-to-cart').click(function () {
    const tokenCSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let productId = $(this).data('id');
    let cantidad = $('#cantidad').val();

    $.ajax({
        url: urlAgregarCarrito,
        method: 'POST',
        data: {
            producto_id: productId,
            cantidad: cantidad,
            _token: tokenCSRF
        },
        success: function (response) {
            //alert(response.message);
            showToastrSuccess(response.message);
            $('#carrito').text(response.cartCount);
        },
        error: function () {
            alert('Hubo un error al agregar el producto');
        }
    });
});