<!DOCTYPE html>
<html lang="es">
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenido/a a nuestro sitio</title>
    </head>
    <div class="body">
        <p>Hola {{ $apellidos }}, {{ $nombres }}</p>
        
        <p>¡Bienvenido/a a nuestro sitio! Estamos emocionados de tenerte como parte de nuestra comunidad.</p>

        <p>Para activar tu cuenta, haz clic en el siguiente enlace:</p>
        <a href="{{ $activationURL }}">Activar mi cuenta</a>

        <p>Si no puedes hacer clic en el enlace, cópialo y pégalo en la barra de direcciones de tu navegador: {{ $activationURL }}</p>

        <p>Gracias por unirte a nosotros.</p>

        <p>Saludos,</p>
        <p>Tu Equipo</p>
    </div>
</html>
