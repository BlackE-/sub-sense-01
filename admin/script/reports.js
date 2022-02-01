	const dropdownCampains = document.getElementById("campainList");
	const doReport = document.getElementById('doReport');
	const tableReport = document.getElementById('tableReport');
	let campainId = null;
	let panelists;

	const button = document.querySelector("#tabletoexcel");
	button.addEventListener("click", e => {
	  TableToExcel.convert(tableReport,{name: "SUB-Sense-report.xlsx"});
	});


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
					case 'getReport':
						//https://jsfiddle.net/totoe/2QN9z/   para hacer el excel 
						let textData = '';
						panelists = data.return.panelists;
						console.log(panelists);


						/*	////////////////////////////////////////////////////
										 PRIMER RENGLON 
							////////////////////////////////////////////////////		
						*/
						let tblBody = document.createElement('tbody');
						let firstRow = document.createElement('tr');
						let nodeFirstRow = document.createElement('td');
						firstRow.appendChild(nodeFirstRow);
						nodeFirstRow = document.createElement('td');
						firstRow.appendChild(nodeFirstRow);

						panelists[0].data.map( survey => {
							let row = document.createElement('tr');
							let surveysData = survey.data;
							switch(survey.type){
								case "samples":
									let surveySamples = survey.samples;
									surveysData.map( ( surveyData,index ) => {
										let dataSampleTitle = surveySamples[index].name;
										let dataSampleQuestionLenght = surveyData.dataSample.length;
										let node = document.createElement('td');
										node.setAttribute("colspan",dataSampleQuestionLenght);
										let sampleTitleNodeText = document.createTextNode(dataSampleTitle);
										node.appendChild(sampleTitleNodeText);
										firstRow.appendChild(node);
									});
								break;
								case "regular":
									let surveyTitle = survey.survey;
									let node = document.createElement('td');
									node.setAttribute('colspan',survey.data.length);
									let surveyTitleNodeText = document.createTextNode(surveyTitle);
									node.appendChild(surveyTitleNodeText);
									firstRow.appendChild(node);
								break;
							}
						});
						tblBody.appendChild(firstRow);

						/*	
							////////////////////////////////////////////////////
								 end PRIMER RENGLON 
							////////////////////////////////////////////////////
						*/


						/*	////////////////////////////////////////////////////
										 segundo RENGLON 
							////////////////////////////////////////////////////		
						*/
						let secondRow = document.createElement('tr');
						let nodeSecondRow = document.createElement('td');
						let nodeTextSecondRow = document.createTextNode('#');
						nodeSecondRow.appendChild(nodeTextSecondRow);
						secondRow.appendChild(nodeSecondRow);
						nodeSecondRow = document.createElement('td');
						nodeTextSecondRow = document.createTextNode('folio');
						nodeSecondRow.appendChild(nodeTextSecondRow);
						secondRow.appendChild(nodeSecondRow);

						panelists[0].data.map( survey => {
							let row = document.createElement('tr');
							let surveysData = survey.data;
							switch(survey.type){
								case "samples":
									surveysData.map( ( surveyData,index ) => {
										surveyData.dataSample.map(question => {
											let node = document.createElement('td');
											let questionTitle = document.createTextNode(question.question);
											node.appendChild(questionTitle);
											secondRow.appendChild(node);
										});
									});
								break;
								case "regular":
									survey.data.map ( question => {
										let node = document.createElement('td');
										let questionTitle = document.createTextNode(question.question);
										node.appendChild(questionTitle);
										secondRow.appendChild(node);
									});
								break;
							}
						});
						tblBody.appendChild(secondRow);

						/*	
							////////////////////////////////////////////////////
								 end segundo RENGLON 
							////////////////////////////////////////////////////
						*/


						//ya agrenar la data de los panelistas
						let row,node,nodeText;
						panelists.map( ( panelist , index ) => {
							row = document.createElement('tr');	
							//celda del numero de participante
							node = document.createElement('td');	
							nodeText = document.createTextNode(`${index+1}`);
							node.appendChild(nodeText);
							row.appendChild(node);
								//celda del folio
							node = document.createElement('td');				
							nodeText = document.createTextNode(`${panelist.folio}`);
							node.appendChild(nodeText);
							row.appendChild(node);

							panelist.data.map( surveysData =>{
								switch(surveysData.type){
									case "samples":
										surveysData.data.map( ( surveyData,index ) => {
											surveyData.dataSample.map(answer => {
												node = document.createElement('td');
												let answerText = '';
												if(answer.answer !== false){
													answerText = (answer.answer.once) ? answer.answer.value : answer.answer.answers.map( i => `${i.value}`).toString();
												}
												let answerTextNode = document.createTextNode(answerText);
												node.appendChild(answerTextNode);
												row.appendChild(node);
											});
										});
									break;
									case "regular":
										surveysData.data.map ( answer => {
											node = document.createElement('td');
											let answerText = '';
											if(answer.answer !== false){
												answerText = (answer.answer.once) ? answer.answer.value : answer.answer.answers.map( i => `${i.value}`).toString();
											}
											let answerTextNode = document.createTextNode(answerText);
											node.appendChild(answerTextNode);
											row.appendChild(node);
										});
									break;
								}
							});
							tblBody.appendChild(row);
						});
						tableReport.appendChild(tblBody);
					break;
				}
			}
		})
		.catch((error) => {
		  console.error('Error:', error);
		});
	}

	doReport.addEventListener("click",function(){
		let report = new FormData();
		report.append( 'request' , 'getReport' );
		if(campainId == dropdownCampains.value){return;}
		else{campainId = dropdownCampains.value;}
		report.append( 'idcampain' , dropdownCampains.value );
		fetchCall( report );
	});

	getCampains = () =>{
		let campainsForm = new FormData();
		campainsForm.append( 'request' , 'getCampains' );
		campainsForm.append( 'idinput' , 'campainList' );
		fetchCall( campainsForm );
	}

	getCampains();