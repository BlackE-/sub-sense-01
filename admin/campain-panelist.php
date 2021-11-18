<?php
	$idcampain = $_GET['idcampain'];
?>
<link rel="stylesheet" type="text/css" href="css/app.css">
<main id="mainPanelist">
	<section id="campainpanelist">
		<form id="selectPanelist">
			<input type="hidden" name="idcampain">
			<p>Elige un panelista para iniciar el cuestionario</p>
			<select name="panelist">
			</select>
			<input type="submit" name="submitPanelist" value="ELEGIR"/>
		</form>
		<button id="back">REGRESAR</button>
	</section>
</main>
<?php include("modal.php");?>


<script type="text/javascript" src="script/campain-panelist.js"></script>