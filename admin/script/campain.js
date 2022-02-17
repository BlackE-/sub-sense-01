	const formCampain = document.getElementById('campainForm');
	const saveCampain = document.getElementById('saveCampain');
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
							break;
							default:
								document.getElementById("startCampain").style.display="none";
							break;
						}
					break;
					case "updateCampain":

					break;
				}
				closeModalFunction();
			}
		});
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