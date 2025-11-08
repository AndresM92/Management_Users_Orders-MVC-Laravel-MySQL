<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f9fafb; padding: 20px; }
        .container { background: white; padding: 20px; border-radius: 6px; }
        h1 { color: #2d3748; }
        p { color: #4a5568; }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Hola {{ $data->owner->name }}!</h1>
        <p>Adjuntamos la historia clinica de {{ $data->name_pet }} emitida el {{ now()->format('d/m/Y') }}.</p>
        <p>Gracias por confiar en nosotros. Si tienes alguna duda, no dudes en contactarnos.</p>
        <p>Veterinaria <strong>MasCotas</strong></p>
    </div>
</body>
</html>
