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
	      							<input type="text" value="Muestra #4" id="survey1sample4" name="sampleValue"/>
	      							<input type="text" value="Muestra #5" id="survey1sample5" name="sampleValue"/>
	      						</div>
			      			</div>

			      			<div class="formRow">
			      				<p>Preguntas</p>
			      				<div class="questionsContainer">
			      					<input type="hidden" name="surveyQuestionCounter" value="20"/>
			      					<div class="appendQuestions">
			      						<!-- 1 -->
			      						<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #1</p>
				      							<input type="hidden" name="survey1question1idquestion" class="idquestion" value="46"/>
				      							<input type="text" name="survey1question1name" placeholder="" value="P.1 Tomando en cuenta lo que acaba de ver de esta mayonesa. ¿Cómo calificaría en términos generales la apariencia de este producto?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question1type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="7" name="survey1question1scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question1scale1" value="Pésima">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question1scale2" value="Muy mala">
						      									<button class="delete" id="survey1question1scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question1scale3" value="Mala">
						      									<button class="delete" id="survey1question1scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question1scale4" value="Ni buena, ni mala">
						      									<button class="delete" id="survey1question1scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question1scale5" value="Buena">
						      									<button class="delete" id="survey1question1scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">6</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question1scale6" value="Muy buena">
						      									<button class="delete" id="survey1question1scale6Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">7</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question1scale7" value="Excelente">
						      									<button class="delete" id="survey1question1scale7Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>

				      					<!-- 2 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #2</p>
				      							<input type="hidden" name="survey1question2idquestion" class="idquestion" value="47"/>
				      							<input type="text" name="survey1question2name" placeholder="" value="P. 2  Ahora me gustaría que pensara en la intensidad del color de esta mayonesa que acaba de ver ¿Diría que es…?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question2type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question2scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question2scale1" value="Demasiado amarillo  para lo que a mí me gusta">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question2scale2" value="Algo amarillo  para lo que mí me gusta">
						      									<button class="delete" id="survey1question2scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question2scale3" value="Justo como a mí me gusta">
						      									<button class="delete" id="survey1question2scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question2scale4" value="Algo blanca para lo que a mí me gusta">
						      									<button class="delete" id="survey1question2scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question2scale5" value="Demasiado blanca para lo que a mí me gusta">
						      									<button class="delete" id="survey1question2scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>

				      					<!-- 3 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #3</p>
				      							<input type="hidden" name="survey1question3idquestion" class="idquestion" value="48"/>
				      							<input type="text" name="survey1question3name" placeholder="" value="P.3 Ahora me gustaría que pensara en la intensidad del aroma de esta mayonesa  ¿Diría que es…? "/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question3type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question3scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question3scale1" value="Nada  fuerte para lo que a mi me gusta">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question3scale2" value="No es lo suficientemente fuerte para lo que a mí me gusta">
						      									<button class="delete" id="survey1question1scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question3scale3" value="Justo como  a mi me gusta">
						      									<button class="delete" id="survey1question1scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question3scale4" value="Algo  fuerte para lo que a mí me gusta">
						      									<button class="delete" id="survey1question3scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question3scale5" value="Demasiado  fuerte para lo que a mí me gusta">
						      									<button class="delete" id="survey1question3scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>

				      					<!-- 4 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #4</p>
				      							<input type="hidden" name="survey1question4idquestion" class="idquestion" value="49"/>
				      							<input type="text" name="survey1question4name" placeholder="" value="P.4 Tomando en cuenta lo que acaba de ver de esta mayonesa ¿Cómo calificaría en términos generales la apariencia  de la textura de esta mayonesa?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question4type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="7" name="survey1question4scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question4scale1" value="Pésima">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question4scale2" value="Muy mala">
						      									<button class="delete" id="survey1question4scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question4scale3" value="Mala">
						      									<button class="delete" id="survey1question4scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question4scale4" value="Ni buena, ni mala">
						      									<button class="delete" id="survey1question4scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question4scale5" value="Buena">
						      									<button class="delete" id="survey1question4scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">6</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question4scale6" value="Muy buena">
						      									<button class="delete" id="survey1question4scale6Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">7</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question4scale7" value="Excelente">
						      									<button class="delete" id="survey1question4scale7Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>

				      					<!-- 5 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #5</p>
				      							<input type="hidden" name="survey1question5idquestion" class="idquestion" value="50"/>
				      							<input type="text" name="survey1question5name" placeholder="" value="P. 5 Ahora me gustaría que pensara en la textura de esta mayonesa cuando la unto en su pan  ¿Diría que es...? "/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question5type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question5scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question5scale1" value="Demasiado aguada  para lo que a mí me gusta">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question5scale2" value="Algo aguada para lo que mí me gusta">
						      									<button class="delete" id="survey1question5scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question5scale3" value="Justo como a mí me gusta">
						      									<button class="delete" id="survey1question5scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question5scale4" value="Algo espesa  para lo que a mí me gusta">
						      									<button class="delete" id="survey1question5scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question5scale5" value="Demasiado espesa para lo que a mí me gusta">
						      									<button class="delete" id="survey1question5scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question5addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>

				      					<!-- 6 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #6</p>
				      							<input type="hidden" name="survey1question6idquestion" class="idquestion" value="51"/>
				      							<input type="text" name="survey1question6name" placeholder="" value="P.10  ¿Cuántas cucharadas/ cucharaditas de mayonesa usó por su pan que se preparó?  (FAVOR DE REGISTRAR aproximadamente cuanto uso )"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question6type">
				      								<option value="scale">Escala Lineal</option>
				      								<option value="short" selected>Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
					      					</div>
				      					</div>

				      					<!-- 7 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #7</p>
				      							<input type="hidden" name="survey1question7idquestion" class="idquestion" value="52"/>
				      							<input type="text" name="survey1question7name" placeholder="" value="P.11  ¿Cómo calificaría el sabor en términos generales de esta mayonesa ?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question7type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="7" name="survey1question7scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question7scale1" value="Pésima">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question7scale2" value="Muy mala">
						      									<button class="delete" id="survey1question1scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question7scale3" value="Mala">
						      									<button class="delete" id="survey1question1scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question7scale4" value="Ni buena, ni mala">
						      									<button class="delete" id="survey1question1scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question7scale5" value="Buena">
						      									<button class="delete" id="survey1question1scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">6</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question7scale6" value="Muy buena">
						      									<button class="delete" id="survey1question1scale6Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">7</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question7scale7" value="Excelente">
						      									<button class="delete" id="survey1question1scale7Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>

				      					<!-- 8 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #8</p>
				      							<input type="hidden" name="survey1question8idquestion" class="idquestion" value="53"/>
				      							<input type="text" name="survey1question8name" placeholder="" value="P. 12  Ahora me gustaría que pensara en la intensidad del sabor en general de este café que acaba de probar ¿Diría que es..?       "/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question8type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question8scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question8scale1" value="Nada fuerte para lo que a mí me gusta">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question8scale2" value="No es lo suficientemente fuerte para lo que a mí me gusta">
						      									<button class="delete" id="survey1question8scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question8scale3" value="Justo como a mí me gusta">
						      									<button class="delete" id="survey1question8scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question8scale4" value="Algo más fuerte para lo que a mí me gusta">
						      									<button class="delete" id="survey1question8scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question8scale5" value="Demasiado fuerte para lo que a mí me gusta">
						      									<button class="delete" id="survey1question8scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>


				      					<!-- 9 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #9</p>
				      							<input type="hidden" name="survey1question9idquestion" class="idquestion" value="54"/>
				      							<input type="text" name="survey1question9name" placeholder="" value="P.13   Ahora me gustaría que pensara lo grasoso en el sabor de este café que acaba de probar ¿Diría que este café tiene un sabor grasosa?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question9type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question9scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question9scale1" value="Completamente en desacuerdo">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question9scale2" value="En desacuerdo">
						      									<button class="delete" id="survey1question8scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question9scale3" value="Ni de acuerdo, ni en desacuerdo">
						      									<button class="delete" id="survey1question8scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question9scale4" value="De acuerdo">
						      									<button class="delete" id="survey1question8scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question9scale5" value="Completamente de Acuerdo">
						      									<button class="delete" id="survey1question8scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>


				      					<!-- 10 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #10</p>
				      							<input type="hidden" name="survey1question10idquestion" class="idquestion" value="55"/>
				      							<input type="text" name="survey1question10name" placeholder="" value="P.14   ¿Cómo calificaría la intensidad de sabor a mayonesa ?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question10type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question10scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question10scale1" value="Completamente en desacuerdo">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question10scale2" value="En desacuerdo">
						      									<button class="delete" id="survey1question8scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question10scale3" value="Ni de acuerdo, ni en desacuerdo">
						      									<button class="delete" id="survey1question10scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question10scale4" value="De acuerdo">
						      									<button class="delete" id="survey1question10scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question10scale5" value="Completamente de Acuerdo">
						      									<button class="delete" id="survey1question8scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>

				      					<!-- 11 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #11</p>
				      							<input type="hidden" name="survey1question11idquestion" class="idquestion" value="57"/>
				      							<input type="text" name="survey1question11name" placeholder="" value="P.15  ¿Cómo calificaría el sabor a limón en esta mayonesa?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question11type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question11scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question11scale1" value="Nada limón para lo que a mí me gusta">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question11scale2" value="No es lo suficientemente limón para lo que a mí me gusta">
						      									<button class="delete" id="survey1question11scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question11scale3" value="Justo como a mí me gusta">
						      									<button class="delete" id="survey1question11scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question11scale4" value="Algo más limón de lo que a mí me gusta">
						      									<button class="delete" id="survey1question11scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question11scale5" value="Demasiado limón para lo que a mí me gusta">
						      									<button class="delete" id="survey1question11scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>



				      					<!-- 12 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #12</p>
				      							<input type="hidden" name="survey1question12idquestion" class="idquestion" value="58"/>
				      							<input type="text" name="survey1question12name" placeholder="" value="P.16  ¿Cómo calificaría el sabor acido en esta mayonesa?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question12type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question12scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question12scale1" value="Nada ácido para lo que a mí me gusta">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question12scale2" value="No es lo suficientemente ácido para lo que a mí me gusta">
						      									<button class="delete" id="survey1question12scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question12scale3" value="Justo como a mí me gusta">
						      									<button class="delete" id="survey1question12scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question12scale4" value="Algo ligera para lo que a mí me gusta">
						      									<button class="delete" id="survey1question12scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question12scale5" value="Demasiado ligera para lo que a mí me gusta">
						      									<button class="delete" id="survey1question12scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>

				      					<!-- 13 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #13</p>
				      							<input type="hidden" name="survey1question13idquestion" class="idquestion" value="56"/>
				      							<input type="text" name="survey1question13name" placeholder="" value="P.17  ¿Cómo calificaría la sensación que deja en su boca esta mayonesa? "/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question13type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question13scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question13scale1" value="Demasiado pesada  para lo que a mí me gusta">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question13scale2" value="Algo pesada  para lo que mí me gusta">
						      									<button class="delete" id="survey1question13scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question13scale3" value="Justo como a mí me gusta">
						      									<button class="delete" id="survey1question13scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question13scale4" value="Algo ligera para lo que a mí me gusta">
						      									<button class="delete" id="survey1question13scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question13scale5" value="Demasiado ligera para lo que a mí me gusta">
						      									<button class="delete" id="survey1question13scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>


				      					<!-- 14 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #14</p>
				      							<input type="hidden" name="survey1question14idquestion" class="idquestion" value="59"/>
				      							<input type="text" name="survey1question14name" placeholder="" value="P.18  ¿Diría que  esta mayonesa deja un sabor agradable en su boca?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question14type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question14scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question14scale1" value="Completamente en desacuerdo">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question14scale2" value="En desacuerdo">
						      									<button class="delete" id="survey1question14scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question14scale3" value="Ni de acuerdo, ni en desacuerdo">
						      									<button class="delete" id="survey1question13scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question14scale4" value="De acuerdo">
						      									<button class="delete" id="survey1question13scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question14scale5" value="Completamente de Acuerdo">
						      									<button class="delete" id="survey1question13scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>

				      					<!-- 15 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #15</p>
				      							<input type="hidden" name="survey1question15idquestion" class="idquestion" value="61"/>
				      							<input type="text" name="survey1question15name" placeholder="" value="P.19  Ahora me gustaría que pensara en la intensidad del sabor que deja en la boca el producto que acaba de probar ¿Diría que es...? (197)"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question15type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question15scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question15scale1" value="Completamente en desacuerdo">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question15scale2" value="En desacuerdo">
						      									<button class="delete" id="survey1question15scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question15scale3" value="Ni de acuerdo, ni en desacuerdo">
						      									<button class="delete" id="survey1question15scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question15scale4" value="De acuerdo">
						      									<button class="delete" id="survey1question15scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question15scale5" value="Completamente de Acuerdo">
						      									<button class="delete" id="survey1question13scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>

				      					<!-- 16 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #16</p>
				      							<input type="hidden" name="survey1question16idquestion" class="idquestion" value="60"/>
				      							<input type="text" name="survey1question16name" placeholder="" value="P.20 Considerando todo lo que vio y probó de esta mayonesa, ¿Qué tan de acuerdo estaría en que este producto fuera ahora “su mayonesa de todos los días”?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question16type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question16scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question16scale1" value="Completamente en desacuerdo">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question16scale2" value="En desacuerdo">
						      									<button class="delete" id="survey1question16scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question16scale3" value="Ni de acuerdo, ni en desacuerdo">
						      									<button class="delete" id="survey1question16scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question16scale4" value="De acuerdo">
						      									<button class="delete" id="survey1question16scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question16scale5" value="Completamente de Acuerdo">
						      									<button class="delete" id="survey1question16scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>


				      					<!-- 17 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #17</p>
				      							<input type="hidden" name="survey1question17idquestion" class="idquestion" value="62"/>
				      							<input type="text" name="survey1question17name" placeholder="" value="P.21  ¿Qué tan dispuesto estaría en sustituir o cambiar la marca de mayonesa que mencionó que consume con mayor frecuencia por este otra mayonesa? "/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question17type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question17scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question17scale1" value="Definitivamente no lo cambiaría">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question17scale2" value="Probablemente no lo cambiaría">
						      									<button class="delete" id="survey1question17scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question17scale3" value="No se si lo cambiaría o no">
						      									<button class="delete" id="survey1question17scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question17scale4" value="Probablemente lo cambiaría">
						      									<button class="delete" id="survey1question17scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question17scale5" value="Definitivamente lo cambiaría">
						      									<button class="delete" id="survey1question17scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>



				      					<!-- 18 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #18</p>
				      							<input type="hidden" name="survey1question18idquestion" class="idquestion" value="63"/>
				      							<input type="text" name="survey1question18name" placeholder="" value="P.22  ¿Por qué razones dice que... SI / NO cambiaría esta marca por la que consume con mayor frecuencia?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question18type">
				      								<option value="scale">Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long" selected>Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional"></div>
				      					</div>



				      					<!-- 19 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #19</p>
				      							<input type="hidden" name="survey1question19idquestion" class="idquestion" value="64"/>
				      							<input type="text" name="survey1question19name" placeholder="" value="P.39 Tomando en cuenta todo lo que vio y probó, ¿Cómo calificaría este producto en términos generales?  (215)"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question19type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="7" name="survey1question19scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question19scale1" value="Pésima">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question19scale2" value="Muy mala">
						      									<button class="delete" id="survey1question18scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question19scale3" value="Mala">
						      									<button class="delete" id="survey1question19scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question19scale4" value="Ni buena, ni mala">
						      									<button class="delete" id="survey1question19scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question19scale5" value="Buena">
						      									<button class="delete" id="survey1question19scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">6</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question19scale6" value="Muy buena">
						      									<button class="delete" id="survey1question19scale6Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">7</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question19scale7" value="Excelente">
						      									<button class="delete" id="survey1question19scale7Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>


				      					<!-- 20 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #20</p>
				      							<input type="hidden" name="survey1question20idquestion" class="idquestion" value="65"/>
				      							<input type="text" name="survey1question20name" placeholder="" value="P.40 Tomando en cuenta todo lo que vio y probó, ¿Qué tan dispuesta se encontraría a comprar este producto? "/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey1question20type">
				      								<option value="scale" selected>Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="5" name="survey1question20scale">
					      						<div class="formRow">
					      							<p></p>
					      							<div class="scaleContainer">
					      								<div class="formRow margin0">
						      								<span class="number">1</span>
						      								<input type="text" name="survey1question20scale1" value="Definitivamente no lo compraría">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">2</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question20scale2" value="Probablemente no lo compraría">
						      									<button class="delete" id="survey1question20scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">3</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question20scale3" value="Tal vez sí, tal vez no lo compraría">
						      									<button class="delete" id="survey1question20scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">4</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question20scale4" value="Probablemente lo compraría">
						      									<button class="delete" id="survey1question20scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="number">5</span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey1question20scale5" value="Definitivamente lo compraría">
						      									<button class="delete" id="survey1question20scale5Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Agregar Escala</span></button>
					      							</div>
					      						</div>
					      					</div>
				      					</div>

			      					</div>

			      					<button class="surveyAddQuestion" id="addSurvey1"><i class="bi bi-plus"></i><span>Agregar Pregunta</span></button>
	      						</div>
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

			      			<div class="formRow">
			      				<p>Preguntas</p>
			      				<div class="questionsContainer">
			      					<input type="hidden" name="surveyQuestionCounter" value="5"/>
			      					<div class="appendQuestions">
			      						
			      						<!-- 1 -->
			      						<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #1</p>
				      							<input type="hidden" name="survey2question1idquestion" class="idquestion" value="66"/>
				      							<input type="text" name="survey2question1name" placeholder="" value="P.41  ¿Podría decirme cuál de los dos mayonesas  que probo PREFIERE?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey2question1type">
				      								<option value="scale">Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      								<option value="checkbox" selected>Casillas</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="4" name="survey2question1checkbox">
				      							<div class="formRow">
					      							<p></p>
					      							<div class="checkboxContainer">
					      								<div class="formRow margin0">
						      								<span class="square"></span>
						      								<input type="text" name="survey2question1checkbox1" value="Xxxx REF">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="square"></span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey2question1checkbox2" value="Xxxx Prototipo">
						      									<button class="delete" id="survey2question1scale2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="square"></span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey2question1checkbox3" value="AMBOS">
						      									<button class="delete" id="survey2question1scale3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="square"></span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey2question1checkbox4" value="NINGUNO">
						      									<button class="delete" id="survey2question2scale4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Añadir Opción</span></button>
					      							</div>
					      						</div>
				      						</div>
				      					</div>

				      					<!-- 2 -->
			      						<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #2</p>
				      							<input type="hidden" name="survey2question2idquestion" class="idquestion" value="67"/>
				      							<input type="text" name="survey2question2name" placeholder="" value="P. 42  ¿Por qué le gustó más el……(MENCIONAR RESPUESTA DE LA PREG. ANTERIOR)"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey2question2type">
				      								<option value="scale">Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long" selected>Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional"></div>
				      					</div>

				      					<!-- 3 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #3</p>
				      							<input type="hidden" name="survey2question3idquestion" class="idquestion" value="68"/>
				      							<input type="text" name="survey2question3name" placeholder="" value="P.43   Si yo le dijera que tiene que comprar uno de los dos mayonesas , ¿Cual compraría, el primero o el segundo?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey2question3type">
				      								<option value="scale">Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long">Respuesta larga</option>
				      								<option value="checkbox" selected>Casillas</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional">
				      							<input type="hidden" value="4" name="survey2question3checkbox">
				      							<div class="formRow">
					      							<p></p>
					      							<div class="checkboxContainer">
					      								<div class="formRow margin0">
						      								<span class="square"></span>
						      								<input type="text" name="survey2question3checkbox1" value="Xxxx REF">
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="square"></span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey2question3checkbox2" value="Xxxx Prototipo">
						      									<button class="delete" id="survey2question3checkbox2Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="square"></span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey2question3checkbox3" value="AMBOS">
						      									<button class="delete" id="survey2question1checkbox3Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      							<div class="formRow margin0">
						      								<span class="square"></span>
						      								<div class="deleteRow">
						      									<input type="text" name="survey2question3checkbox4" value="NINGUNO">
						      									<button class="delete" id="survey2question1checkbox4Delete"><i class="bi bi-x"></i></button>
						      								</div>
						      							</div>
						      						</div>
						      					</div>
						      					<div class="formRow">
						      						<p></p>
						      						<div class="scaleAddContainer">
					      								<input type="text" name="newScale">
					      								<button id="survey1question1addScale"><i class="bi bi-plus"></i><span>Añadir Opción</span></button>
					      							</div>
					      						</div>
				      						</div>
				      					</div>

				      					<!-- 4 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #4</p>
				      							<input type="hidden" name="survey2question4idquestion" class="idquestion" value="69"/>
				      							<input type="text" name="survey2question4name" placeholder="" value="P.44   ¿Por qué razones compraría.................... (MENCIONAR LA RESPUESTA DE LA PREGUNTA ANTERIOR)?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey2question4type">
				      								<option value="scale">Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long" selected>Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional"></div>
				      					</div>

				      					<!-- 5 -->
				      					<div class="questionContainer">
				      						<div class="formRow">
				      							<p>Pregunta #5</p>
				      							<input type="hidden" name="survey2question5idquestion" class="idquestion" value="70"/>
				      							<input type="text" name="survey2question5name" placeholder="" value="P.45   ¿Por qué razones NO compraría ninguno?"/>
				      						</div>
				      						<div class="formRow">
				      							<p>Tipo Pregunta</p>
				      							<select name="survey2question5type">
				      								<option value="scale">Escala Lineal</option>
				      								<option value="short">Respuesta corta</option>
				      								<option value="long" selected>Respuesta larga</option>
				      							</select>
				      						</div>
				      						<div class="questionAdditional"></div>
				      					</div>


			      						<button class="surveyAddQuestion" id="addSurvey2"><i class="bi bi-plus"></i><span>Agregar Pregunta</span></button>
			      					</div>
			      				</div>
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
	<script type="text/javascript" src="script/campain_add_surveys.js"></script>
</body>
</html>