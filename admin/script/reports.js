	const dropdownCampains = document.getElementById("campainList");
	const doReport = document.getElementById('doReport');
	const tableReport = document.getElementById('tableReport');
	let campainId = null;

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
						let panelists = data.return.panelists;
						// console.log(panelists);

						let tblBody = document.createElement('tbody');
						let row
						panelists.map( ( panelist , index ) => {
							if(index === 0){
								//crear primer renglon de excel
								
							}
							console.log(panelist);
							console.log(panelist.folio);
							console.log(panelist.data);
							let row = document.createElement('tr');
							let node = document.createElement('td');
							let nodeText = document.createTextNode(`${panelist.folio}`);
							node.appendChild(nodeText);
							row.appendChild(node);
							
							let surveys = panelists.data;//elegir las preguntas de cada cuestionario para jacer 
							surveys.map( survey => {

						// 	// 	switch( survey.type ){
						// 	// 		case 'samples':
						// 	// 		break;
						// 	// 		default:
						// 	// 		break;
						// 	// 	}
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