<!DOCTYPE html>
<html>
<head>
	<title>SUB SENSE - Campain</title>
	<?php include('header_meta.php');?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php include('header.php');?>
	<main id="main" class="main">
		<?php include('sidebar.php');?>
		<section id="campainContainer">
			<div class="titleContainer"><h1 class="title">Campaña</h1></div>
			<div class="row buttonContainer">
				<a href="campains"><button class="add"><i class="bi bi-arrow-left"></i> <span>Regresar</span></button></a>
				<button class="save" id="saveCampain"><i class="bi bi-save2"></i> <span>Guardar</span></button>
			</div>
			<div class="row formContainer">
					<form id="campainForm">
						<p class="title">Información Campaña</p>
						<div class="formRow">
							<p>Nombre</p>
							<input type="text" name="campainName" id="campainName" value="" />
						</div>

						<div class="formRow">
							<p>HTML</p>
							<textarea id="campainHTML"></textarea>
						</div>

						<div class="formRow">
							<p>Status</p>
							<div class="halfRow">
								<input type="checkbox" name="statusCampain" id="statusCampain" disabled>
								<label for="statusCampain"><span>&nbsp;</span></label>
							</div>
						</div>

						<div class="formRow">
							<p>Fecha creación</p>
							<input type="text" name="datecreatedCampain" disabled>
						</div>

						<div class="formRow">
							<p>Fecha final</p>
							<input type="text" name="dateendCampain">
						</div>
						<input type="submit" name="campainSubmit"/>
					</form>

					<button id="startCampain">Comenzar Cuestionarios</button>
			</div>
			<div class="row">
				<h1 class="title">Panelistas de la campaña</h1>
			</div>
			<div class="row buttonContainer" style="margin-bottom:30px;">
				<div class="">
					<p><i class="bi bi-upload"></i> <span>Importar Hoja De Control (Primer paso)</span></p>
					<input type="file" id="importarHojaControl" accept=".csv"/>
				</div>
				<div class="">
					<p><i class="bi bi-upload"></i> <span>Actualizar Panelistas <br>(Segundo paso)</span></p>
					<input type="file" id="updateHojaControl" accept=".csv"/>
				</div>
			</div>
			<div class="row panelistTable">
				<table class="table" id="usersTable"></table>
			</div>
		</section>
	</main>
	<?php include('footer.php');?>
	<?php include('modal.php');?>
	<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
	<script type="text/javascript" src="script/campain.js"></script>
</body>
</html>