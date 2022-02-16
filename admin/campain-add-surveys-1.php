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
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/cferdinandi/tabby@12/dist/css/tabby-ui.css"> -->

</head>
<body>
	<?php include('header.php');?>
	<main id="main" class="main">
		<?php include('sidebar.php');?>
		<section id="campainAddSurveys">
			<?php echo '<input type="hidden" id="idcampain" value="'.$idcampain.'"/>';?>
			
			<div class="titleContainer"><h1 class="title"></h1></div>
			<div class="row buttonContainer">
				<button class="save" id="buttonFinal"><i class="bi bi-save2"></i> <span>Guardar</span></button>
			</div>
			<div class="row formContainer">
				<div class="surveysContainer">
					<p class="title">Información Cuestionarios</p>
					<div class="totalCuestionarios">
						<p>Total de Cuestionarios</p>
						<input type="text" disabled id="numberSurveys" value=""/>
					</div>
					
					<div class="surveyContainer">
						<form id="survey" name="" data-order="1">
							<input type="hidden" name="idsurvey" value=""/>
							<div class="formRow">
			      				<p>Número de Cuestionario</p>
			      				<input type="text" name="numberSurvey" placeholder="" value="" disabled/> 
			      			</div>
							<div class="formRow">
			      				<p>Nombre</p>
			      				<input type="text" name="nameSurvey" placeholder="" value="" /> 
			      			</div>
			      			<div class="formRow">
			      				<p>Descripción</p>
			      				<textarea name="descriptionSurvey" placeholder=""></textarea> 
			      			</div>
			      			<div class="formRow">
			      				<p>Tipo Cuestionario</p>
			      				<select name="typeSurvey">
		      						<option value="samples">Muestras</option>
		      						<option value="regular">Normal</option>
		      					</select>
			      			</div>
							<div class="rowContainer" id="rowSamples">
								<div class="formRow">
									<p></p>
									<div class="formRow inverted">
										<div class="formRow inverted">
											<input type="text" name="sampleName" placeholder="Nombre"/>
											<input type="text" name="sampleCode" placeholder="Código"/>
										</div>
										<div id="addSamples">+ <span>Agregar Muestras</span></div>
									</div>
								</div>
								<div class="formRow">
									<p></p>
									<div class="samplesContainer" id="samplesContainer">
										
									</div>
								</div>
							</div>
			      			<input type="submit" value="Guardar Cuestionario">
						</form>
					</div>

					<div class="questionForm">
						<form id="questionForm">
							<div class="formRow">
								<p>Pregunta <span id="numberQuestion"></span></p>
								<input type="hidden" name="idquestion" class="idquestion" value=""/>
								<input type="text" name="questionName" placeholder="" value=""/>
							</div>
							<div class="formRow">
								<p>Tipo Pregunta</p>
								<select name="questionType">
									<option value="short">Respuesta corta</option>
									<option value="long">Respuesta larga</option>
									<option value="scale">Escala Lineal</option>
									<option value="checkbox">Casillas</option>
									<option value="order">Ordenamiento</option>
								</select>
							</div>
							<button>GUARDAR</button>
						</form>
					</div>

					<div class="scaleForm">
						<form id="scaleForm">
							<div class="formRow margin0">
								<input type="text" name="questionScaleValue" value="1">
								<input type="text" name="questionScaleLabel" value="">
							</div>
							<button id="addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
						</form>
					</div>

					<div class="orderForm">
						<div id="samplesOrderForm">
						</div>
						<form id="orderForm">
							<div class="formRow margin0">
								<input type="hidden" name="responseId" value="">
								<input type="text" name="questionOrderValue" value="">
								<input type="text" name="questionOrderLabel" value="">
							</div>
							<button><i class="bi bi-plus"></i><span>Agregar Opción</span></button>
						</form>
						<button id="orderSave">GUARDAR ORDENAMIENTO</button>
					</div>
				</div>
				<div class="questionsContainer" id="questionsContainer">
					<p>Preguntas que han sido guardadas</p>
				</div>
				<button id="nextSurvey">SIGUIENTE CUESTIONARIO</button>
			</div>
		</section>
	</main>
	<?php include('modal.php');?>
	<?php include('footer.php');?>
	<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/cferdinandi/tabby@12/dist/js/tabby.polyfills.js"></script> -->
	<script type="text/javascript" src="script/campain_add_surveys-01.js"></script>
</body>
</html>