<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
</head>
<body>
	<h2>Un nuevo cliente ha sido registrado.</h2>

	<hr>

	<strong>Recepcionista: </strong> {{ $recepcionista }} <br>

	<strong>Sucursal: </strong> {{ $sucursal }} <br>

	<strong>Cliente: </strong> <a href="{{ URL::to('user') }}"> {{ $cliente }} </a><br>
</body>
</html>
