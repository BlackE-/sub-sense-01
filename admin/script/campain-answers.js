//https://codepen.io/vtno/pen/MXmpoy?editors=1111
//change ordenacion para que sea sortable	

	fetchCall = ( answerData ) =>{
		let object = {};
        answerData.forEach((value, key) => object[key] = value);
		fetch('./include/request.php', {
		  method: 'POST', // or 'PUT'
		  headers: {'Content-Type': 'application/json',},
		  body: JSON.stringify(object),
		})
		.then(response => response.json())
		.then(data => {
			if(!data.return){
				return;
			}else{
				let idanswer = null;
				let allAnswers = null;
				let answerValue = null;
				switch(object.request){
					case 'getAnswer':
						// const _typeQuestion = data.return._typeQuestion;
						const _typeQuestion = object._typeQuestion;
						switch(_typeQuestion){
							case 'scale':
								idanswer = data.return.idanswer;
								answerValue = data.return.value;
								//traer todas las answer para setear el valor guardado
								if(!object.idsample){
									allAnswers = [...document.querySelectorAll(`.answer`)].filter( (answer) => answer.getAttribute('data-question') == object.idquestion);
								}else{
									allAnswers = [...document.querySelectorAll(`.answer`)].filter( (answer) => answer.getAttribute('data-question') == object.idquestion && answer.getAttribute('data-sample') == object.idsample);
								}
								allAnswers.forEach((answer)=>{
									if(answer.value == answerValue){
										answer.checked = true;
									}
									answer.setAttribute('data-answer',idanswer);
								});
								
							break;
							case 'order':
								//si ya fue contestada ya no se puede cambiar
								//de una vez setear que el dragg se quita
								// const answerOrder = document.getElementsByClassName("answerOrder");
								// const listItem = document.getElementsByClassName("list-item");
								console.log(data.return);
								console.log("ya fue conetstada");
							break;
							case 'checkbox':
								//traer todas las answer para setear el valor guardado
								if(!object.idsample){
									allAnswers = [...document.querySelectorAll(`.answer`)].filter( (answer) => answer.getAttribute('data-question') == object.idquestion);
								}else{
									allAnswers = [...document.querySelectorAll(`.answer`)].filter( (answer) => answer.getAttribute('data-question') == object.idquestion && answer.getAttribute('data-sample') == object.idsample);
								}
								
								if(!data.return.once){
									//más de una respuesta
									let answersCheckbox = data.return.answers;
									idanswer = [];
									let answerValues = [];
									for (let [key, value] of Object.entries(answersCheckbox)) {
									    idanswer.push(value.idanswer);
									    answerValues.push(value.value);
									}

									allAnswers.forEach((answer)=>{
										if(answerValues.includes(answer.value)){
											answer.checked = true;
										}
										answer.setAttribute('data-answer',idanswer);
									});
								}else{
									//solo hay una respuesta
									idanswer = data.return.idanswer;
									answerValue = data.return.value;
									allAnswers.forEach((answer)=>{
										if(answer.value == answerValue){
											answer.checked = true;
										}
										answer.setAttribute('data-answer',idanswer);
									});
								}
								
							break;
							case 'short':
								idanswer = data.return.idanswer;
								answerValue = data.return.value;
								//traer todas las answer para setear el valor guardado
								if(!object.idsample){
									allAnswers = [...document.querySelectorAll(`.answer`)].filter( (answer) => answer.getAttribute('data-question') == object.idquestion);
								}else{
									allAnswers = [...document.querySelectorAll(`.answer`)].filter( (answer) => answer.getAttribute('data-question') == object.idquestion && answer.getAttribute('data-sample') == object.idsample);
								}
								allAnswers[0].value = answerValue;
								allAnswers[0].setAttribute('data-answer',idanswer) ;
							break;
							case 'long':
								idanswer = data.return.idanswer;
								answerValue = data.return.value;
								//traer todas las answer para setear el valor guardado
								if(!object.idsample){
									allAnswers = [...document.querySelectorAll(`.answer`)].filter( (answer) => answer.getAttribute('data-question') == object.idquestion);
								}else{
									allAnswers = [...document.querySelectorAll(`.answer`)].filter( (answer) => answer.getAttribute('data-question') == object.idquestion && answer.getAttribute('data-sample') == object.idsample);
								}
								allAnswers[0].value = answerValue;
								allAnswers[0].setAttribute('data-answer',idanswer) ;

							break;
						}
					break;
					case 'saveAnswer':
						console.log('saveAnswer');
						console.log(data);
						console.log(data.return);
						idanswer = data.return;
						if(!object.idsample){
							allAnswers = [...document.querySelectorAll(`.answer`)].filter( (answer) => answer.getAttribute('data-question') == object.idquestion);
						}else{
							allAnswers = [...document.querySelectorAll(`.answer`)].filter( (answer) => answer.getAttribute('data-question') == object.idquestion && answer.getAttribute('data-sample') == object.idsample);
						}
						allAnswers.forEach((answer)=>{answer.setAttribute('data-answer',idanswer)});
					break;
				}
			}
		})
		.catch((error) => {
		  console.error('Error:', error);
		});
	}

	const idcampain = document.getElementById('idcampain').value;
	const idpanelist = document.getElementById('idpanelist').value;
	const _order = document.getElementById('_order').value;
	const _type = document.getElementById('typeSurvey').value;
	const goUp = document.getElementById('goUp');
	goUp.addEventListener("click",()=>{window.scrollTo({top: 0,behavior: 'smooth'});});

	
	setCampainAnswer = () =>{
		if(document.querySelector('[data-tabs]') !== null){
			const tabsSurveys = new Tabby('[data-tabs]');
		}


		switch(_type){
			case 'samples':
				const numberSamples = document.getElementById('numberSamples').value; // cada muestra
				const formSamples = document.getElementsByClassName('formSamples');	
				for(let index = 0; index < numberSamples ; index++){
					formSamples[index].addEventListener("submit",(event)=>event.preventDefault());
					let idsample = formSamples[index].getAttribute('name');
					let idquestion = formSamples[index].elements['idquestion'];	// cada pregunta
					for(let y = 0; y<idquestion.length;y++){
						// traer las respuestas ya guardadas por cada pregunta de cada sample llamar a funcion
						let answerForm = new FormData();
						answerForm.append( 'request' , 'getAnswer' );
						answerForm.append( 'idpanelist' , idpanelist );
						answerForm.append( 'idquestion' , idquestion[y].value );
						answerForm.append( '_typeQuestion' , idquestion[y].getAttribute('data-type'));
						answerForm.append( '_typeSurvey' , _type );
						answerForm.append( 'idsample' , idsample );
						fetchCall( answerForm );
					}

					let answerInput = formSamples[index].getElementsByClassName('answer');
					for(let a = 0; a< answerInput.length;a++){
						if(answerInput[a].type == "textarea" || answerInput[a].type == "text"){
							answerInput[a].addEventListener("input",(event)=>{
								if(event.target.value.length > 50){
									event.target.style.border = "1px solid var(--red-color)";
									event.target.value = event.target.value.slice(0,50);   
								}else{
									event.target.style.border = "1px solid var(--blue-color)";
								}
							});
						}
						answerInput[a].addEventListener('change',(event)=>{
							let answerForm = new FormData();
							answerForm.append( 'request' , 'saveAnswer' );
							answerForm.append( 'idsample' , idsample );
							answerForm.append( 'idpanelist' , idpanelist );
							answerForm.append( 'value' , event.target.value );
							answerForm.append( 'idanswer' ,  event.target.getAttribute('data-answer'));
							answerForm.append( 'idquestion' , event.target.getAttribute('data-question') );
							answerForm.append( 'idquestion_response' , event.target.getAttribute('data-question-response'));
							fetchCall( answerForm );
						});
					}
				}
			break;
			default:
				const formSurvey = document.getElementsByClassName('formSurvey')[0];	
				formSurvey.addEventListener("submit",(event)=>{event.preventDefault()});
				let idquestion = formSurvey.elements['idquestion'];	// cada pregunta
				for(let y = 0; y<idquestion.length;y++){
					// traer las respuestas ya guardadas por cada pregunta de cada sample llamar a funcion
					let answerForm = new FormData();
					answerForm.append( 'request' , 'getAnswer' );
					answerForm.append( 'idpanelist' , idpanelist );
					answerForm.append( 'idquestion' , idquestion[y].value );
					answerForm.append( '_typeQuestion' , idquestion[y].getAttribute('data-type'));
					answerForm.append( '_typeSurvey' , _type );
					answerForm.append( 'idsample' , '' );
					fetchCall( answerForm );
				}

				let answerInput = formSurvey.getElementsByClassName('answer');
				for(let a = 0; a< answerInput.length;a++){
					if(answerInput[a].type == "textarea" || answerInput[a].type == "text"){
						answerInput[a].addEventListener("input",(event)=>{
							if(event.target.value.length > 50){
								event.target.style.border = "1px solid var(--red-color)";
								event.target.value = event.target.value.slice(0,50);   
							}else{
								event.target.style.border = "1px solid var(--blue-color)";
							}
						});
					}


					answerInput[a].addEventListener('change',(event)=>{
						let answerForm = new FormData();
						answerForm.append( 'request' , 'saveAnswer' );
						answerForm.append( 'idsample' , '' );
						answerForm.append( 'idpanelist' , idpanelist );
						answerForm.append( '_typeInput' , event.target.type );
						answerForm.append( 'value' , event.target.value );
						answerForm.append( 'idanswer' ,  event.target.getAttribute('data-answer'));
						answerForm.append( 'idquestion' , event.target.getAttribute('data-question') );
						answerForm.append( 'idquestion_response' , event.target.getAttribute('data-question-response'));
						fetchCall( answerForm );
					});
				}

				const answerOrder = document.getElementsByClassName("answerOrder");
				let dragged = null;
				let lista = [];
				const listItem = document.getElementsByClassName("list-item");
				for(let a = 0; a< listItem.length;a++){
					listItem[a].addEventListener("dragstart",function(event){
						event.dataTransfer.setData('text/plain',null);
						dragged = event.target;
					});
					listItem[a].addEventListener("dragend",function(event){
						event.preventDefault();
						listItem[a].setAttribute('draggable',false);
					});
				}
				for(let a = 0; a< answerOrder.length;a++){
					answerOrder[a].addEventListener("dragenter", function(event) {
						event.preventDefault();	
						event.target.appendChild( dragged );
					});
					answerOrder[a].addEventListener("dragover", function( event ) {event.preventDefault();}, false);
					answerOrder[a].addEventListener("drop", function(event){
						event.preventDefault();
						lista.push(dragged.getAttribute('data-src'));
						if(lista.length == answerOrder.length){
							console.log("guardar respuesta");
							let answerForm = new FormData();
							answerForm.append( 'request' , 'saveAnswer' );
							answerForm.append( 'idsample' , '' );
							answerForm.append( 'idpanelist' , idpanelist );
							answerForm.append( '_typeInput' , 'order' );
							answerForm.append( 'value' , lista );
							answerForm.append( 'idanswer' ,  'null');
							answerForm.append( 'idquestion' , dragged.getAttribute('data-question') );
							answerForm.append( 'idquestion_response' , dragged.getAttribute('data-question-response'));
							fetchCall( answerForm );
						}
					});
				}

			break;
		}
	}
	window.onload = setCampainAnswer();

	modalFunction = () =>{
		openModalFunction();
		setTimeout(function(){
			closeModalFunction();
		},2000);
	}
	const saveSurveyTop = document.getElementById('saveSurveyTop');
	const saveSurveyBottom = document.getElementById('saveSurveyBottom');
	const changePanelist = document.getElementById('changePanelist');
	saveSurveyTop.addEventListener('click',modalFunction);
	saveSurveyBottom.addEventListener('click',modalFunction);
	changePanelist.addEventListener('click',function(){
		let url = window.location.href;
		let newURL = `${url.substring(0, url.lastIndexOf('/'))}/campain-panelist?idcampain=${idcampain}`; 
		window.location.href = newURL;
	});