<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SUB Sense</title>
</head>
<body>
	<?php include('header_meta.php');?>
	<?php include('header.php');?>

	<main id="main" class="main">
		<section class="sectionFull" id="login">
			<div class="row">
				<figure class="logoContainer">
					<img loading="lazy" src="img/SUB-icon-subchecker.svg" class="logo"/>
				</figure>
				<h1>SUB SENSE</h1>
				<p>Pantalla para cuestionarios en línea</p>
				<form id="loginForm">
					<input type="text" name="email" placeholder="Correo Electrónico">
					<input type="password" name="password" placeholder="Contraseña">
					<input type="submit" name="submit" value="INICIAR SESIÓN">
				</form>

				<a href="./admin"><button style="padding:10px;">Cuestionarios con Panelistas</button></a>
			</div>
		</section>
	</main>
	<?php include('footer.php');?>
	<script>
		
	</script>
</body>
</html>