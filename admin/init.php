<!DOCTYPE html>
<html lang="es">
	<head>
		<link rel="stylesheet" type="text/css" href="css/app.css">
	</head>
	<body>
	    <main id="mainInit">
	    	<section class="sectionFull" id="registerContainer">
	    		<div>
	        		<img class="logo" src="../img/SUB-icon-subchecker.svg">
	        		<h1 class="title">SUB Sense</h1>
			        <form class="loginForm" id="loginForm">
			        	<p class="topRegister"><b>BASE DE DATOS</b></p>
			        	<p class="topRegister">Para comenzar a utilizar la plataforma necesitamos la siguiente información</p>
				        	<div class="row">
				        	    <input type="text" name="host" placeholder="Host" required/>
				        	</div>
				        	<div class="row">
				        	    <input type="text" name="database" placeholder="Database" required/>
				        	</div>
				        	<div class="row">
				        	    <input type="text" name="username" placeholder="Username" required/>
				        	</div>
				        	<div class="row">
				        		<input type="password" name="password" placeholder="Password" required/>
				        	</div>
				        	<div class="row">
				        		<input type="submit" class="submitLogin" value="Guardar">
				        	</div>
			        	<div class="error"></div>
			    	</form>
			    </div>
		    </section>
		</main>

		<?php include("modal.php");?> 
			<script src="script/init.js"></script>
	</body>
</html>
