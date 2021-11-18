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
		<section id="dashboardContainer">
			<div class="card clientsCountContainer">
				<h2>Panelistas</h2>
				<input type="text" id="panelistCount" />
			</div>
			<div class="card campainsCountContainer">
				<h2>Campañas</h2>
				<input type="text" id="campainsCount"/>
			</div>


			<!-- <a href="https://localhost/sub-sense/sub-sense-01/admin/campain-add-surveys.php?idcampain=14">LINK DE DAR DE ALTA UESTIONARIO</a> -->
		</section>
	</main>
	<?php include('footer.php');?>
	<script type="text/javascript" src="script/index.js"></script>
</body>
</html>