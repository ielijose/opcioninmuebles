<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Registro</h2>

		<div>
			Se ha creado una cuenta en OpcionInmuebles.com, estos son los datos:
			
			<hr>
			<strong>Nombre: </strong> {{ $name }}
			<br>
			<strong>Email: </strong> {{ $email }}
			<br>
			<strong>Password: </strong> {{ $password }}
			

			<hr>
			<br>
			Ingresa haciendo click <a href="{{ $url }}">Aquí</a>

		</div>
	</body>
</html>
