<?php
	require_once dirname(__FILE__) . '/include/_subsense.php';
	$set = new Subsense();

	$checkDBLogin = $set->checkDBLogin();
	if(!$checkDBLogin['return']){
		header('Location: init');
		exit;
	}

	$checkLogin = $set->CheckLogin();
	if(!$checkLogin){
		echo $set->getErrorMessage();
		header("Location: login"); 
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>SUB SENSE</title>
	<?php include('header_meta.php');?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
</head>
<body>
	<?php include('header.php');?>
	<main id="main" class="main">
		<?php include('sidebar.php');?>
		<section id="profileSection">
            <div class="titleContainer"><h1 class="title">Mi Perfil</h1></div>
                <form id="profileForm">
                    <div class="row"><span>Nombre de usuario</span><input type="text" name="username" disabled /></div>
                    <div class="row"><span>Correo Electrónico</span><input type="email" name="email"/></div>
                    <div class="row"><span>Tipo</span>
						<select id="type" name="type" disabled>
							<option value="1">Admin</option>
							<option value="2">Cliente</option>
							<option value="3">Moderador</option>
							<option value="4">Entrevistador</option>
							<option value="5">Panelista</option>
						</select>
					</div>
                    <div class="row"><span>Nombre</span><input type="text" name="firstName"/></div>
                    <div class="row"><span>Apellidos</span><input type="text" name="lastName"/></div>
                </form>
		</section>
	</main>
	<?php include('footer.php');?>
	<script type="text/javascript" src="script/profile.js"></script>
</body>
</html>