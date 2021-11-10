<!DOCTYPE html>
<html>
<head>
	<title>SUB SENSE - New Campain</title>
	<?php include('header_meta.php');?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
</head>
<body>
	<?php include('header.php');?>
	<main id="main" class="main">
		<?php include('sidebar.php');?>
		<section id="campainNewSection">
			<div class="titleContainer"><h1 class="title">Nueva Campaña</h1></div>
			<div class="row buttonContainer">
				<a href="campains"><button class="add"><i class="bi bi-arrow-left"></i> <span>Regresar</span></button></a>
				<button class="save" id="saveNewCampain"><i class="bi bi-save2"></i> <span>Guardar</span></button>
			</div>
			<div class="row formContainer">
				<form id="campainForm">
					<p class="title">Información Campaña</p>
					<div class="formRow">
						<p>Nombre Campaña</p>
						<input type="text" name="nameCampain" placeholder="" required minlength="4" />
					</div>
					<div class="formRow">
						<p>Descripción</p>
						<textarea name="descriptionCampain"></textarea>
					</div>
					<div class="formRow">
						<p>Número de cuestionarios</p>
						<input type="number" name="numberSurveys" placeholder=" " required minlength="1"/>
					</div>
					<input type="submit" id="submitCampain" name="submitCampain">
				</form>
			</div>
		</section>
	</main>
	<?php include('modal.php');?>
	<?php include('footer.php');?>
	<script type="text/javascript" src="script/campain_new.js"></script>
</body>
</html>