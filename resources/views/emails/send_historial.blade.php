<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu reporte está listo</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 6px; overflow: hidden;">
        <tr>
            <td style="background-color: #3490dc; color: white; text-align: center; padding: 20px;">
                <h2>Tu reporte en PDF está listo 📄</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <p>Hola,</p>
                <p>Puedes ver tu reporte directamente en línea (tamaño carta) haciendo clic en el siguiente botón:</p>

                <p style="text-align: center; margin: 30px 0;">
                    <a href="{{ $url }}" target="_blank"
                       style="display:inline-block; background-color:#3490dc; color:white; text-decoration:none; 
                              padding:12px 25px; border-radius:5px; font-weight:bold;">
                        🔗 Ver PDF
                    </a>
                </p>

                <p>Este enlace estará disponible por los próximos <strong>2 minutos</strong>.</p>
                <p>Si el botón no funciona, copia y pega este enlace en tu navegador:</p>
                <p><a href="{{ $url }}">{{ $url }}</a></p>

                <p>Saludos,<br><strong>El equipo de tu aplicación</strong></p>
            </td>
        </tr>
    </table>
</body>
</html>

