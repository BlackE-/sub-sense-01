<?php
	require_once dirname(__FILE__) . '/include/_subsense.php';
	$set = new Subsense();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SUB SENSE - Surveys</title>
		<?php include('header_meta.php');?>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
		<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php include('header.php');?>
		<main id="main" class="main">
			<?php include('sidebar.php');?>
			<section id="usersSection">
				<div class="titleContainer"><h1 class="title">Cuestionarios</h1></div>
				<div class="row">
					<a href="survey-new"><button class="add" id="addPanelist"><i class="bi bi-plus"></i> <span>Agregar Cuestionario</span></button></a>
					<button class="download" id="tabletoexcel"><i class="bi bi-download"></i> <span>Descargar</span></button>
				</div>
				<div class="tableContainer">
					<table class="table" id="surveysTable"></table>	
				</div>
			</section>
		</main>
		<?php include('footer.php');?>
		<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
		<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
		<script type="text/javascript" src="script/surveys.js"></script>
	</body>
</html>