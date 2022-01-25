	const dropdownCampains = document.getElementById("campainList");
	const selectPanelist = document.getElementById('panelist');
	const surveysList = document.getElementById('surveysList');
	const bringReport = document.getElementById('bringReport');
	const totalContainer = document.getElementById('totalContainer');
	const dataContainer = document.getElementById('dataContainer');

	let campainId = null;
	let panelistId = null;
	let surveyId = null;
	let surveyType = null;

	fetchCall = ( answerData ) =>{
		openModalFunction();
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
				closeModalFunction();
				switch(object.request){
					case 'getCampains':
						for(let campain of data.return){
							var option = document.createElement("option");
							option.text = campain.name;
							option.value = campain.idcampain;
							dropdownCampains.appendChild(option);
						}
					break;
					case 'getUsersModerator':
						for(let panelist of data.return){
							var option = document.createElement("option");
							option.text = `${panelist.firstname} ${panelist.lastname}`;
							option.value = panelist.iduser;
							selectPanelist.appendChild(option);
						}
					break;
					case 'getSurveysFromCampain':
						for(let survey of data.return){
							var option = document.createElement("option");
							option.text = survey.name;
							option.value = survey.idsurvey;
							option.setAttribute('type',survey.type);
							surveysList.appendChild(option);
						}
					break;

					case 'getReport':
						let textData = '';
						switch(surveyType){
							case 'samples':
								data.return.QA.forEach( sample => {
									textData += `<h2>${sample.sample.name}</h2>`; 
									sample.faq.forEach( item =>{
										textData += ( !item.answer ) ? '' : `<p class="question">${item.question}</p><p class="answer">${item.answer.value}</p>`;
									});
								});
							break;
							default:
								data.return.QA.forEach( item => {
									if(typeof item.answer === 'object'){
										textData += `<p class="question">${item.question}</p>`;
										if(!item.answer.once){
											item.answer.answers.forEach( ans =>{
												textData += `<p class="answer">${ans.value}</p>`;
											});
										}else{
											textData += `<p class="answer">${item.answer.value}</p>`;
										}
									}
								});
							break
						}
						dataContainer.innerHTML = textData;
						totalContainer.innerHTML = `<div class="divisionContainer"><p><sup>${data.return.totalAnswers}</sup><span>/</span><sub>${data.return.totalQuestions}</sub></div>`;

					break;
				}
			}
		})
		.catch((error) => {
		  console.error('Error:', error);
		});
	}

	bringReport.addEventListener("click",function(){
		let report = new FormData();
		report.append( 'request' , 'getReport' );
		if(campainId == dropdownCampains.value && surveyId == surveysList.value && panelistId ==  selectPanelist.value){return;}
		else{campainId = dropdownCampains.value;surveyId=surveysList.value;panelistId=selectPanelist.value;surveyType=surveysList.selectedOptions[0].getAttribute("type");}
		report.append( 'idcampain' , dropdownCampains.value );
		report.append( 'idsurvey' , surveysList.value );
		report.append( 'surveyType' , surveysList.selectedOptions[0].getAttribute("type")  );
		report.append( 'idpanelist' , selectPanelist.value );
		fetchCall( report );
	})

	dropdownCampains.addEventListener("change",function(event){
		if(event.target.value == '0'){
			return;
		}
		let campainForm = new FormData();
		campainForm.append( 'request' , 'getSurveysFromCampain' );
		campainForm.append( 'idcampain' , event.target.value );
		fetchCall( campainForm );
	});
	


	getCampains = () =>{
		let campainsForm = new FormData();
		campainsForm.append( 'request' , 'getCampains' );
		campainsForm.append( 'idinput' , 'campainList' );
		fetchCall( campainsForm );
	}

	getPanelists = () =>{
		let dataCampain = new FormData();
		dataCampain.append( 'request' , 'getUsersModerator' );
		dataCampain.append( 'type' , '5' );
		fetchCall( dataCampain );
	}

	getCampains();
	getPanelists();