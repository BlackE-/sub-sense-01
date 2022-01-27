<!DOCTYPE html>
<html>
<head>
	<title>SUB SENSE - Tiempo Real</title>
	<?php include('header_meta.php');?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php include('header.php');?>
	<main id="main" class="main">
		<?php include('sidebar.php');?>
		<section id="reportSection">
			<div class="titleContainer"><h1 class="title">Resultados en tiempo real</h1></div>
			<div class="titleContainer"><p>Para mostrar las respuestas, elegir la campaña, el cuestionario y el panelista</p></div>
			<div class="row">
				<select id="campainList">
					<option value="0">Seleccionar Campaña</option>
				</select>
				<select id="surveysList">
					<option value="0">Seleccionar Cuestionario</option>
				</select>
			</div>
			<div class="row">
				<select id="panelist">
					<option value="0">Seleccionar Panelista</option>
				</select>
				<button id="bringReport">Traer Información</button>
			</div>
			<div class="tableContainer">
				<div id="totalContainer"></div>
				<div id="dataContainer"></div>
			</div>
		</section>
	</main>
	<?php include("modal.php");?> 
	<?php include('footer.php');?>
	<script type="text/javascript" src="script/realtime.js"></script>
</body>
</html>