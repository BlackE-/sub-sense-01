<?php
	$idcampain = $_GET['idcampain'];
	if(!$idcampain){
		header("Location: campain-new"); 
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SUB SENSE - New Campain</title>
	<?php include('header_meta.php');?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/cferdinandi/tabby@12/dist/css/tabby-ui.css">
</head>
<body>
	<?php include('header.php');?>
	<main id="main" class="main">
		<?php include('sidebar.php');?>
		<section id="campainAddSurveys">
			<?php echo '<input type="hidden" id="idcampain" value="'.$idcampain.'/>';?>
			<div class="titleContainer"><h1 class="title"></h1></div>
			<div class="row buttonContainer">
				<button class="save" id=""><i class="bi bi-save2"></i> <span>Guardar</span></button>
			</div>
			<div class="row formContainer">
				<div class="surveysContainer">
					<p class="title">Información Cuestionarios</p>
					<ul data-tabs>
						<li><a data-tabby-default href="#survey1Container1">Cuestionario 1</a></li>
						<li><a href="#surveyContainer2">Cuestionario 2</a></li>
					</ul>
					<div id="survey1Container1">
						<form id="survey1" name="11">
							<div class="formRow">
			      				<p>Nombre</p>
			      				<input type="text" name="nameSurvey" placeholder="" value="PRUEBA MONÁDICA COMPARATIVA" /> 
			      			</div>
			      			<div class="formRow">
			      				<p>Descripción</p>
			      				<textarea name="descriptionSurvey" placeholder="">Se repite 3 veces o 2 dependiendo el número de muestras</textarea> 
			      			</div>
			      			<div class="formRow">
			      				<p>Tipo Cuestionario</p>
			      				<select name="typeSurvey">
		      						<option value="samples" selected>Muestras</option>
		      						<option value="regular">Normal</option>
		      					</select>
			      			</div>
			      			<div class="formRow">
			      				<p></p>
			      				<div class="formRow inverted">
			      					<input type="hidden" name="samplesCounter" value="5">
	      							<input type="text" name="sample"/>
	      							<button type="submit">+ <span>Agregar Muestras</span></button>
	      						</div>
			      			</div>
			      			<div class="formRow">
			      				<p></p>
			      				<div class="samplesContainer">
	      							<input type="text" value="Muestra #1" id="survey1sample1" name="sampleValue"/>
	      							<input type="text" value="Muestra #2" id="survey1sample2" name="sampleValue"/>
	      							<input type="text" value="Muestra #3" id="survey1sample3" name="sampleValue"/>
	      						</div>
			      			</div>
                            <div class="formRow">
                                <input type="number" name="surveyQuestionCounter" value="20"/>
                            </div>
			      			<input type="submit" id="submitsurvey1" name="submitsurvey1">
						</form>
					</div>
					<div id="surveyContainer2">
						<form id="survey2" name="12">
							<div class="formRow">
			      				<p>Nombre</p>
			      				<input type="text" name="nameSurvey" placeholder="" value="PRUEBA COMPARATIVA" /> 
			      			</div>
			      			<div class="formRow">
			      				<p>Descripción</p>
			      				<textarea name="descriptionSurvey" placeholder=""><p><b>MUCHAS GRACIAS!!</b>Responsiva del entrevistador:<br></p>
			      					<p>Declaro que toda la información registrada en el presente cuestionario es absolutamente verídica. Acepto que si existe algún dato falsificado en el presente cuestionario se tomen las medidas legales y judiciales pertinentes.</p>
			      					<ul>
			      						<ol>Solo entrevistaré a personas que cumplan con los requisitos mencionados en la capacitación.</ol>
			      						<ol>No entrevistaré a ningún amigo, conocido o familiar.</ol>
			      						<ol>Toda la información relacionada con este estudio será confidencial. No comentaré ni divulgaré con nadie ningún tipo de información relativa al mismo.</ol>
			      					</ul>
			      				</textarea> 
			      			</div>
			      			<div class="formRow">
			      				<p>Tipo Cuestionario</p>
			      				<select name="typeSurvey">
		      						<option value="samples">Muestras</option>
		      						<option value="regular" selected>Normal</option>
		      					</select>
			      			</div>

							<input type="submit" id="submitsurvey2" name="submitsurvey2">
						</form>
					</div>
				</div>
			</div>
		</section>
	</main>
	<?php include('modal.php');?>
	<?php include('footer.php');?>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/cferdinandi/tabby@12/dist/js/tabby.polyfills.js"></script>
	<script type="text/javascript" src="script/campain_add_surveys-01.js"></script>
</body>
</html>