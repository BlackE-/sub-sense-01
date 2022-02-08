<!DOCTYPE html>
<html>
<head>
	<title>SUB SENSE - Campains</title>
	<?php include('header_meta.php');?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php include('header.php');?>
	<main id="main" class="main">
		<?php include('sidebar.php');?>
		<section id="usersSection">
			<div class="titleContainer"><h1 class="title">Campañas</h1></div>
			<div class="row" id="adminRow">
				<a href="campain-new"><button class="add" id="addPanelist"><i class="bi bi-plus"></i> <span>Agregar Campaña</span></button></a>
				<button class="download" id="tabletoexcel"><i class="bi bi-download"></i> <span>Descargar</span></button>
			</div>
			<div class="tableContainer">
				<table class="table" id="campainTable"></table>	
			</div>
		</section>
	</main>
	<?php include('footer.php');?>
	<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
	<script type="text/javascript" src="script/campains.js"></script>
</body>
</html>