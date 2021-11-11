<?php
	require_once dirname(__FILE__) . '/include/_subsense.php';
	$set = new Subsense();

	$idcampain = $_GET['idcampain'];
	$idpanelist = $_GET['idpanelist'];
	$_order = $_GET['_order'];

?>

	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css"> -->
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/cferdinandi/tabby@12/dist/css/tabby-ui.css"> -->
	
	<link rel="stylesheet" href="css/bootstrap-icons.css">
	<link rel="stylesheet" href="css/tabby-ui.css">
	<link rel="stylesheet" href="css/app.css">

<main id="mainAnswer">
	<section id="campainAnswer">
		<div class="surveysContainer">
			<div class="titleContainer"><h1 class="title">Cuestionario #<?php echo $_order?></h1></div>
			<div class="row buttonContainer">
				<button class="save" id=""><i class="bi bi-arrow-left"></i> <span>Cambiar Panelista</span></button>
				<button class="save" id="saveSurveyTop"><i class="bi bi-save2"></i> <span>Guardar</span></button>
			</div>
			<div class="row formContainer">
				<div class="surveysContainer">
				<?php
					echo '<input type="hidden" id="idcampain" value="'.$idcampain.'">';
					echo '<input type="hidden" id="idpanelist" value="'.$idpanelist.'">';
					echo '<input type="hidden" id="_order" value="'.$_order.'">';
					$survey = $set->getSurveyFromCampain($idcampain,$_order);
					echo '<input type="hidden" id="typeSurvey" value="'.$survey['type'].'"/>';
					$totalSurveys = $set->getTotalSurveysFromCampain($idcampain);
					$idsurvey = $survey['idsurvey'];
					switch ($survey['type']) {
						case 'samples':
							$samples = $set->getSurveySamples($idsurvey);
							echo '<ul data-tabs>';
							$counterSamples = 0;
							foreach ($samples as $key => $value) {
								if($key == 0){echo '<li><a data-tabby-default href="#sample'.$key.'Container">'.$value['name'].'</a></li>';}
								else{echo '<li><a href="#sample'.$key.'Container">'.$value['name'].'</a></li>';}
								$counterSamples++;
							}
							echo '<input type="hidden" id="numberSamples" value="'.$counterSamples.'"/>';
							echo '</ul>';
							$questions = $set->getSurveyQuestions( $idsurvey );
							foreach ($samples as $key => $value) {
								echo '<div  id="sample'.$key.'Container">';
								echo '<form id="sample'.$key.'formSurvey'.$_order.'">';
								echo 	'<div class="questionsContainer">';
								foreach($questions as $qkey => $qvalue){
									$idquestion = $qvalue['idquestion'];
									echo '<div class="questionContainer">';
										echo '<div class="questionHTMLContainer">'.$qvalue['html'].'</div>';
										switch($qvalue['type']){
											case 'scale':
												$responses = $set->getQuestionResponses( $idquestion );
												foreach($responses as $rkey => $rvalue){
													echo '<div class="formRow">';
													echo '<input name="sample'.$key.'question'.$qkey.'response" type="radio" id="sample'.$key.'question'.$qkey.'response'.$rkey.'" value='.$rvalue['value'].'>';
													echo '<label for="sample'.$key.'question'.$qkey.'response'.$rkey.'">'.$rvalue['value'].' <span>'.$rvalue['label'].'</span></label>';
													echo '</div>';
												}
											break;
											case 'checkbox':
												$responses = $set->getQuestionResponses( $idquestion );
												foreach($responses as $rkey => $rvalue){
													echo '<div class="formRow">';
													echo '<input name="sample'.$key.'question'.$qkey.'response" type="checkbox" id="sample'.$key.'question'.$qkey.'response'.$rkey.'" value='.$rvalue['value'].'>';
													echo '<label for="sample'.$key.'question'.$qkey.'response'.$rkey.'">'.$rvalue['value'].'<span>'.$rvalue['label'].'</span></label>';
													echo '</div>';
												}
											break;
											case 'radio':
											break;
											case 'long':
												echo '<textarea name="question'.$qkey.'long"></textarea>';
											break;
											case 'short':
												echo '<input type="text" name="question'.$qkey.'short"/>';
											break;
										}
									echo '</div>';
								}
								echo '</div>';
								echo '</form>';
								echo '</div>';
							}
						break;
						
						default:
								$questions = $set->getSurveyQuestions( $idsurvey );
								echo '<form id="formSurvey'.$_order.'">';
								echo 	'<div class="questionsContainer">';
								foreach($questions as $qkey => $qvalue){
									$idquestion = $qvalue['idquestion'];
									echo '<div class="questionContainer">';
										echo '<div class="questionHTMLContainer">'.$qvalue['html'].'</div>';
										switch($qvalue['type']){
											case 'scale':
												$responses = $set->getQuestionResponses( $idquestion );
												foreach($responses as $rkey => $rvalue){
													echo '<div class="formRow">';
													echo '<input name="question'.$qkey.'response" type="radio" id="question'.$qkey.'response'.$rkey.'" value='.$rvalue['value'].'>';
													echo '<label for="question'.$qkey.'response'.$rkey.'">'.$rvalue['value'].' <span>'.$rvalue['label'].'</span></label>';
													echo '</div>';
												}
											break;
											case 'checkbox':
												$responses = $set->getQuestionResponses( $idquestion );
												foreach($responses as $rkey => $rvalue){
													echo '<div class="formRow">';
													echo '<input name="question'.$qkey.'response" type="checkbox" id="question'.$qkey.'response'.$rkey.'" value='.$rvalue['value'].'>';
													echo '<label for="question'.$qkey.'response'.$rkey.'">'.$rvalue['value'].'<span>'.$rvalue['label'].'</span></label>';
													echo '</div>';
												}
											break;
											case 'radio':
											break;
											case 'long':
												echo '<textarea name="question'.$qkey.'long"></textarea>';
											break;
											case 'short':
												echo '<input type="text" name="question'.$qkey.'short"/>';
											break;
										}
									echo '</div>';
								}
								echo '</div>';
								echo '</form>';

						break;
					}


				?>
		</div>

		<button id="saveSurveyBottom">GUARDAR</button>
		<?php
			if($_order < $totalSurveys){
				$_neworder = $_order+1;
				echo '<a href="campain-answer?idcampain='.$idcampain.'&idpanelist='.$idpanelist.'&_order='.$_neworder.'"><button>SIGUIENTE CUESTIONARIO</button></a>';
			}
		?>
	</section>
</main>

<?php include('modal.php');?>
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/cferdinandi/tabby@12/dist/js/tabby.polyfills.js"></script> -->
<script type="text/javascript" src="script/tabby.polyfills.js"></script>
<script type="text/javascript">
	const tabsSurveys = new Tabby('[data-tabs]');
	const idcampain = document.getElementById('idcampain').value;
	const idpanelist = document.getElementById('idpanelist').value;
	const _order = document.getElementById('_order').value;
	const _type = document.getElementById('typeSurvey').value;
	if(_type == 'samples'){
		const numberSamples = document.getElementById('numberSamples').value;
		console.log(numberSamples);
	}


</script>