<!DOCTYPE html>
<html lang="es_MX">
	<head>
		<link rel="stylesheet" type="text/css" href="css/app.css">
	</head>
	<body>
		<main id="mainConfig">
		    <section class="sectionFull" id="registerContainer">
		    	<div>
		    		<img class="logo" src="../img/SUB-icon-subchecker.svg">
		    		<h1 class="title">Bienvenido a SUB Sense</h1>
			        <form class="loginForm" id="form1">
			        	<p class="topRegister"><b>Registro</b></p>
			        	<p class="topRegister">Para continuar crea tu usuario</p>
						<div class="row">
			        		<select id="type" name="type">
			        			<option value="2">Cliente</option>
			        			<option value="3">Moderador</option>
			        			<option value="4" selected>Entrevistador</option>
			        			<option value="5">Panelista</option>
			        		</select>
			        	</div>
						<div class="row panelistRow"><input type="text" name="username" placeholder="Nombre de usuario" /></div>
			        	<div class="row regularRow"> <input type="email" name="email" placeholder="Correo Electrónico" /></div>
			        	<div class="row"><input type="password" name="pass1" placeholder="Minimo 5 letras y un número" required/></div>
			        	
			        	<div class="row"><input type="submit" class="submiRegister" value="REGISTRAR"></div>
			        	<div class="error" id="error"></div>
			    	</form>
					<div style="margin-top:50px;">
						<a href="login">INICIAR SESIÓN</a>
					</div>
			    </div>
			</section>
		</main>
		<?php include("modal.php");?>
		<script src="script/register.js"></script>
	</body>
</html>