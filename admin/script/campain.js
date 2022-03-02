	const formCampain = document.getElementById('campainForm');
	const saveCampain = document.getElementById('saveCampain');
	let userTypeForUsers;
	const usersType = '5';

	fetchCall = ( dataFetch ) =>{
		openModalFunction();
		let object = {};
		dataFetch.forEach((value, key) => object[key] = value);
		openModalFunction();
		fetch('./include/request.php', {
		  method: 'POST', // or 'PUT'
		  headers: {'Content-Type': 'application/json',},
		  body: JSON.stringify(object),
		})
		.then(response => response.json())
		.then(data => {
			// console.log('Success:', data);
			if(!data.return){
				modalHideLoading();
				modalSetMessage(data.return);
				setTimeout(function(){closeModalFunction();},2000);
			}else{
				switch(object.request){
					case "getCampain":
						//colocar los links a los cuestionarios y proceder a contestarlo eligiendo un panelista
						formCampain.elements['campainName'].value = data.return[0].name;
						formCampain.elements['campainHTML'].value = data.return[0].html;
						if(data.return[0].status == "1"){
							formCampain.elements['statusCampain'].checked = true;
						}
						formCampain.elements['datecreatedCampain'].value = data.return[0].date_created;
						formCampain.elements['dateendCampain'].value = data.return[0].date_end;

						switch(window.sessionStorage.getItem("userType")){
							case "4":break;
							case "1":
								saveCampain.style.display="block";
								formCampain.elements['statusCampain'].removeAttribute("disabled");
								document.getElementById("startCampain").style.display="none";
								getPanelists();
							break;
							default:
								document.getElementById("startCampain").style.display="none";
							break;
						}
						
					break;
					case "updateCampain":
					break;
					case "getPanelistFromCampain":
						// console.log(data.return);
						if(!data.return){
							document.getElementById('usersTable').innerHTML = `<p>${data.message}</p>`;
							return;
						}
						
						//tenemos información
						const users = data.return;
						let sampleNumber = users[0].samples.length;
						let samplesArray = [];
						let userData = users.map(item => {
						 	let arrayReturn = [item.user];
						 	item.samples.map( item => arrayReturn.push(item) );
						 	return arrayReturn;
						});
						let headers = ["N"];
						for(let x=1;x<=sampleNumber;x++){
							headers.push(`C-${x}`);
						}
						table = new simpleDatatables.DataTable("#usersTable", {
							data: {
								headings: headers,
								data:userData
							}
						});
					break;
				}
				closeModalFunction();
			}
		});
	}

	getPanelists = () =>{
		let datos = new FormData();
		datos.append( 'request' , 'getPanelistFromCampain' );
		datos.append( 'type' , usersType );
		datos.append( 'idcampain' , idcampain );
		fetchCall(datos);
	}

	getCampaindId = () =>{
		const url_string = window.location.href
		const url = new URL(url_string);
		return url.searchParams.get("idcampain"); 
	}

	const idcampain = getCampaindId();
	if(!idcampain){window.location.href = 'campains';}
	else{
		let dataCampain = new FormData();
		dataCampain.append( 'request' , 'getCampain' );
		dataCampain.append( 'idcampain' , idcampain );
		fetchCall( dataCampain );	
	}

	const startCampain = document.getElementById('startCampain');
	startCampain.addEventListener('click',function(){
		window.location.href=`campain-panelist?idcampain=${idcampain}`;
	});

	saveCampain.addEventListener("click",function(){
		const campainData = new FormData();
		campainData.append("request","updateCampain");
		campainData.append("name",formCampain.elements['campainName'].value)
		campainData.append("description",formCampain.elements['campainHTML'].value);
		let status = formCampain.elements['statusCampain'].checked ? 1:0;
		campainData.append("status",status);
		campainData.append("idcampain",idcampain);
		fetchCall(campainData);
	});


	fetchPost = (formData) =>{
		fetch('./include/uploadFile.php', {
		  method: 'POST',
		  body: formData
		})
		.then(response => response.json())
		.then(result => {
			console.log(result);
			switch(formData.request){
				case "importarHojaControl":
					console.log("getPanelistFromCampain");
					window.location.reload();
				break;
			}
		})
		.catch(error => {
		  console.error(`Error:  ${error}`);
		});
	}

	const importarHojaControl = document.getElementById("importarHojaControl");
	importarHojaControl.addEventListener("change",(file)=>{
		openModalFunction();
		let formData = new FormData();
		formData.append('request','importarHojaControl');
		formData.append('idcampain',idcampain);
		formData.append('file',file.target.files[0]);
		fetchPost(formData);
	});