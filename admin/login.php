<!DOCTYPE html>
<html lang="es_MX">
	<head>
		<?php
			include('header_meta.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/app.css">
	</head>
<body>   
    <main id="mainLogin">
    	<section class="sectionFull" id="loginContainer">
	    	<div>
		    	<figure><img class="logo" src="../img/SUB-icon-subchecker.svg"></figure>
		        <form class="loginForm" id="loginForm">
		        	<p class="topRegister"><b>INICIAR SESIÓN</b></p>
		        	<div class="row">
		        	    <input type="email" name="email" placeholder="Email" />
		        	</div>
		        	<div class="row">
		        		<input type="password" name="pass" placeholder="Contraseña" />
		        	</div>
		        	<div class="row">
		        		<input type="submit" class="submitLogin" value="INICIAR SESIÓN">
		        		<p class="forgot"><a href="recoverPassword.php"><i>Olvidé mi contraseña</i></a></p>
		        	</div>
		        	<div class="error" id="error"></div>
		    	</form>
		    </div>
		</section>
	</main>

	<?php include("modal.php");?> 
	
		<script src="script/login.js"></script>
	</body>
</html>