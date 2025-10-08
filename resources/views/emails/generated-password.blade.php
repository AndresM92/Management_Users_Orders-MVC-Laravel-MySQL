<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tu contraseña de acceso</title>
</head>
<body>
    <h2>Hola {{ $user->name }},</h2>

    <p>Te registraste con tu cuenta de Google.</p>

    <p>Esta es tu contraseña generada automáticamente:</p>

    <h3>{{ $password }}</h3>

    <p>Puedes usarla para iniciar sesión con tu correo si no usas Google la próxima vez.</p>

    <p>Te recomendamos cambiar esta contraseña desde tu perfil.</p>

    <p>Gracias,</p>

    <p>El equipo de {{ config('app.name') }}</p>
    
</body>
</html>
