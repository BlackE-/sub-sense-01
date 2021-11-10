<?php
	require_once dirname(__FILE__) . '/include/_subsense.php';
	$set = new Subsense();
	$checkDBLogin = $set->checkDBLogin();
	if(!$checkDBLogin['return']){
		header('Location: init');
		exit;
	}
?>
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
			        	    <input type="email" name="email" placeholder="Correo Electrónico" required/>
			        	</div>
			        	<div class="row">
			        		<input type="password" name="pass1" placeholder="Minimo 5 letras y un número" required/>
			        	</div>
			        	<div class="row">
			        		<input type="submit" class="submitLogin" value="REGISTRAR">
			        	</div>
			        	<div class="error" id="error"></div>
			    	</form>
			    	<div class="noShow" id="divToLogin">
			    		<h1>ÉXITO</h1>
			    		<p>Todo ha sido instalado correctamente.</p>
			    		<a href="login"><button>Iniciar Sesión</button></a>
			    	</div>
			    </div>
			</section>
		</main>
		<?php include("modal.php");?>
		<script src="script/config.js"></script>
	</body>
</html>