<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ficha Veterinaria - {{ $registro['nombre'] ?? '' }}</title>

    {{-- ✅ Cargar Bootstrap desde CDN (Dompdf requiere isRemoteEnabled = true) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12pt;
        }

        .titulo {
            text-align: center;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .seccion {
            margin-bottom: 1.5rem;
        }

        .table th {
            background-color: #e9ecef !important;
        }

        .footer {
            text-align: center;
            font-size: 10pt;
            color: #777;
            margin-top: 2rem;
        }

        /* Evitar que Dompdf corte bordes */
        table {
            border: 1px solid #dee2e6;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .encabezado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .nombre-vet {
            text-align: right;
            font-size: 16pt;
            color: #198754;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="encabezado">
        <img src="{{ public_path('assets/img/animals.png') }}" class="logo" alt="Logo Veterinaria">
        <div class="nombre-vet">Veterinaria SanPet</div>
    </div>

    <h2 class="titulo">Ficha Veterinaria</h2>

    @php
        $ruta = public_path('uploads/mascotas/ds-lobo.jpg');
    @endphp

    @if (file_exists($ruta))
        <div class="mt-3 text-center">
            <img src="{{ $ruta }}" class="img-fluid rounded shadow-sm" width="200" alt="Foto de la mascota">
        </div>
    @else
        <p style="text-align:center; color:#888;">Imagen no disponible</p>
    @endif


    {{-- Datos Generales --}}
    <div class="seccion">
        <h4 class="text-success"> Datos Generales</h4>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nombre</th>
                    <td>{{ $registro['nombre'] ?? '—' }}</td>
                    <th>Especie</th>
                    <td>{{ $registro['especie'] ?? '—' }}</td>
                </tr>
                <tr>
                    <th>Raza</th>
                    <td>{{ $registro['raza'] ?? '—' }}</td>
                    <th>Sexo</th>
                    <td>{{ $registro['sexo'] ?? '—' }}</td>
                </tr>
                <tr>
                    <th>Edad</th>
                    <td>{{ $registro['edad'] ?? '—' }} años</td>
                    <th>Color</th>
                    <td>{{ $registro['color'] ?? '—' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Propietario --}}
    <div class="seccion">
        <h4 class="text-success"> Datos del Propietario</h4>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nombre</th>
                    <td>{{ $registro['propietario'] ?? '—' }}</td>
                </tr>
                <tr>
                    <th>Teléfono</th>
                    <td>{{ $registro['telefono'] ?? '—' }}</td>
                </tr>
                <tr>
                    <th>Correo</th>
                    <td>{{ $registro['correo'] ?? '—' }}</td>
                </tr>
                <tr>
                    <th>Dirección</th>
                    <td>{{ $registro['direccion'] ?? '—' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Historial Médico --}}
    <div class="seccion">
        <h4 class="text-success"> Historial Médico</h4>
        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>Fecha</th>
                    <th>Procedimiento / Vacuna</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($registro['historial']) && count($registro['historial']) > 0)
                    @foreach ($registro['historial'] as $item)
                        <tr>
                            <td>{{ $item['fecha'] }}</td>
                            <td>{{ $item['procedimiento'] }}</td>
                            <td>{{ $item['observaciones'] }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center">Sin historial disponible</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Diagnóstico --}}
    <div class="seccion">
        <h4 class="text-success"> Diagnóstico Actual</h4>
        <div class="border p-3">
            {{ $registro['diagnostico'] ?? '—' }}
        </div>
    </div>

    {{-- Tratamiento --}}
    <div class="seccion">
        <h4 class="text-success"> Tratamiento Recomendado</h4>
        <div class="border p-3">
            {{ $registro['tratamiento'] ?? '—' }}
        </div>
    </div>

    <div class="footer">
        <p>Veterinaria SanPet — {{ now()->format('d/m/Y') }}</p>
    </div>
</body>

</html>
