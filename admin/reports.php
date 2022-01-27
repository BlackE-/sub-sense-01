<!DOCTYPE html>
<html>
<head>
	<title>SUB SENSE - Reportes</title>
	<?php include('header_meta.php');?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php include('header.php');?>
	<main id="main" class="main">
		<?php include('sidebar.php');?>
		<section id="reportSection">
			<div class="titleContainer"><h1 class="title">Reportes</h1></div>
			<div class="titleContainer"><p>Para mostrar las respuestas en tiempo real, elegir la campaña, el cuestionario y el panelista</p></div>
			<div class="row">
				<select id="campainList">
					<option value="0">Seleccionar Campaña</option>
				</select>
				<button id="doReport">Hacer Reporte</button>
				<button class="download" id="tabletoexcel"><i class="bi bi-download"></i> <span>Descargar</span></button>
			</div>
			<div class="tableContainer" id="dataContainer">
				<table id="tableReport">
					
				</table>
			</div>
		</section>
	</main>
	<?php include("modal.php");?> 
	<?php include('footer.php');?>
	<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
	<script type="text/javascript" src="script/reports.js"></script>
</body>
</html>