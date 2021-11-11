	const formCampain = document.getElementById('campainForm');

	getCampainData = ( dataFetch ) =>{
		let object = {};
        dataFetch.forEach((value, key) => object[key] = value);
		fetch('./include/request.php', {
		  method: 'POST', // or 'PUT'
		  headers: {'Content-Type': 'application/json',},
		  body: JSON.stringify(object),
		})
		.then(response => response.json())
		.then(data => {
			console.log(data);
			if(!data.return){
				document.getElementById('campainTable').innerHTML = `<p>${data.return}</p>`;
				return;
			}else{
				//colocar los links a los cuestionarios y proceder a contestarlo eligiendo un panelista
				formCampain.elements['campainName'].value = data.return[0].name;
				formCampain.elements['campainHTML'].value = data.return[0].html;
				if(data.return[0].status){
					formCampain.elements['statusCampain'].checked = true;
				}
				formCampain.elements['datecreatedCampain'].value = data.return[0].date_created;
				formCampain.elements['dateendCampain'].value = data.return[0].date_end;
			}
		})
		.catch((error) => {
		  console.error('Error:', error);
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
		getCampainData( dataCampain );
	}

	const startCampain = document.getElementById('startCampain');
	startCampain.addEventListener('click',function(){
		window.location.href=`campain-panelist?idcampain=${idcampain}`;
	});