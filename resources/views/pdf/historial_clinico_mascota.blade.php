<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Historia Clínica Veterinaria</title>

    <style>
        @page {
            margin: 30px 25px;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* ---------- ENCABEZADO ---------- */
        .encabezado {
            border-bottom: 3px solid #1a5276;
            padding-bottom: 10px;
            margin-bottom: 15px;
            text-align: left;
        }

        .logo {
            float: left;
            width: 80px;
            height: 80px;
            margin-right: 15px;
            margin-top: 10px;
            border-radius: 20px;
        }

        .titulo-clinica {
            font-size: 22px;
            color: #1a5276;
            font-weight: bold;
            margin: 0;
            padding: 0;
        }

        .datos-vet {
            font-size: 12px;
            color: #444;
            margin-top: 2px;
        }

        .clear {
            clear: both;
        }

        /* ---------- SECCIONES ---------- */
        .seccion {
            margin-bottom: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 10px;
            background-color: #f8f9fa;
            page-break-inside: avoid;
        }

        .seccion h3 {
            background-color: #1a5276;
            color: white;
            padding: 5px 10px;
            margin: -10px -10px 8px -10px;
            font-size: 15px;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px 8px;
            vertical-align: top;
            border-bottom: 1px solid #e0e0e0;
        }

        .label {
            width: 30%;
            font-weight: bold;
            color: #154360;
        }

        .valor {
            width: 70%;
        }

        .observaciones {
            border: 1px dashed #aaa;
            padding: 10px;
            border-radius: 4px;
            background-color: #fff;
            font-size: 13px;
        }

        .firma {
            margin-top: 30px;
            text-align: right;
        }

        .firma .linea {
            display: inline-block;
            border-top: 1px solid #000;
            width: 220px;
            text-align: center;
            padding-top: 4px;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            color: #555;
            margin-top: 10px;
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }

        * {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>

    {{-- ---------- ENCABEZADO ---------- --}}
    <div class="encabezado">

        {{--
        @if (!empty($registro->imagen) && file_exists(public_path('uploads/mascotas/' . $registro->imagen)))
            <img src="file://{{ public_path('uploads/mascotas/' . $registro->imagen) }}" class="logo" alt="Logo">
        @else
        --}}
        @if (file_exists(public_path('uploads/mascotas/Mascotas.jpg')))
            <img src="file://{{ public_path('uploads/mascotas/Mascotas.jpg') }}" class="logo" alt="Logo">
        @else
            <p>Logo no disponible</p>
        @endif


        <div class="info">
            <h1 class="titulo-clinica">{{ $clinica['nombre'] ?? 'Veterinaria +COTAS' }}</h1>
            <p class="datos-vet">
                Veterinario: {{ $clinica['veterinario'] ?? 'Dr. Alexander Restrepo' }} <br>
                {{--Matrícula: {{ $clinica['matricula'] ?? 'N/A' }} <br>--}}
                Tel: {{ $clinica['telefono'] ?? '3015924684' }} | Email: {{ $clinica['email'] ?? 'mascotass.alex@gmail.com' }}
            </p>
        </div>
        <div class="clear"></div>
    </div>

    {{-- ---------- PROPIETARIO ---------- --}}
    <div class="seccion">
        <h3>Datos del Propietario</h3>
        <table>
            <tr>
                <td class="label">Nombre:</td>
                <td class="valor">{{ $registro->owner->name ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Teléfono:</td>
                <td class="valor">{{ $registro->owner->N_cellphone ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Correo electrónico:</td>
                <td class="valor">{{ $registro->owner->email ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Dirección:</td>
                <td class="valor">{{ $registro->owner->address ?? '' }}</td>
            </tr>
        </table>
    </div>

    {{-- ---------- MASCOTA ---------- --}}
    <div class="seccion">
        <h3>Datos de la Mascota</h3>
        <table>
            <tr>
                <td class="label">Nombre:</td>
                <td class="valor">{{ $registro->name_pet ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Especie:</td>
                <td class="valor">{{ $registro->specie ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Raza:</td>
                <td class="valor">{{ $registro->breed ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Edad:</td>
                <td class="valor">{{ $registro->edad ?? '' }} años</td>
            </tr>
            <tr>
                <td class="label">Sexo:</td>
                <td class="valor">{{ $registro->gener ?? '' }}</td>
            </tr>
         {{--   <tr>
                <td class="label">Peso:</td>
                <td class="valor">{{ $mascota['peso'] ?? '-' }} kg</td>
            </tr> --}}
        </table>
    </div>

    {{-- ---------- CONSULTA ---------- --}}
    <div class="seccion">
        <h3>Motivo de Consulta</h3>
        <div class="observaciones">
            <p style="white-space: pre-wrap;">{{ $registro->medical_history ?? 'Sin información' }}</p>
        </div>
    </div>
{{--
    <div class="seccion">
        <h3>Anamnesis</h3>
        <div class="observaciones">
            {{ $consulta['anamnesis'] ?? 'No se registraron antecedentes.' }}
        </div>
    </div>

    <div class="seccion">
        <h3>Diagnóstico</h3>
        <div class="observaciones">
            {{ $consulta['diagnostico'] ?? 'Sin diagnóstico disponible' }}
        </div>
    </div>

    <div class="seccion">
        <h3>Tratamiento / Recomendaciones</h3>
        <div class="observaciones">
            {{ $consulta['tratamiento'] ?? 'Ninguno' }}
        </div>
    </div> 
    --}}

    {{-- ---------- FIRMA Y PIE ---------- 
    <div class="firma">
        <div class="linea">Firma del Veterinario</div>
    </div> --}}

    <div class="footer">
        Clínica Veterinaria {{ $clinica['nombre'] ?? config('app.name') }} — Generado el
        {{ now()->format('d/m/Y H:i') }}
    </div>

</body>

</html>
