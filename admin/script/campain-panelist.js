let userType;
const selectPanelist = document.getElementById('selectPanelist');
fetchCall = ( answerData ) =>{
	let object = {};
	answerData.forEach((value, key) => object[key] = value);
	fetch('./include/request.php', {
	method: 'POST', // or 'PUT'
	headers: {'Content-Type': 'application/json',},
	body: JSON.stringify(object),
	})
	.then(response => response.json())
	.then(data => {if(!data.return){return;}else{userType = data.return;}})
	.catch((error) => {console.error('Error:', error);});
}
	getPanelists = ( dataFetch ) =>{
		let object = {};
        dataFetch.forEach((value, key) => object[key] = value);
		fetch('./include/request.php', {
		  method: 'POST', // or 'PUT'
		  headers: {'Content-Type': 'application/json',},
		  body: JSON.stringify(object),
		})
		.then(response => response.json())
		.then(data => {
			if(!data.return){
				openModalFunction();
					modalSetMessage('Sin Panelistas');
					setTimeout(function(){
						closeModalFunction();
						window.history.back();
					},2000);
				// return;
			}else{
				let users = data.return;
				users.forEach((item)=>{
					let opt = document.createElement("option");
					opt.value = item.iduser;
					opt.text = `${item.folio}`;
					selectPanelist.elements['panelist'].add(opt, null);
				});
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

	//entrevistador no puede ver reportes ni tiempo real
	checkUser = () =>{
		let user = new FormData();
		user.append( 'request' , 'checkUser' );
		fetchCall( user );
	}
	checkUser();

	const idcampain = getCampaindId();
	if(!idcampain){window.location.href = 'campains';}
	else{
		selectPanelist.elements['idcampain'].value = idcampain;
		let dataCampain = new FormData();
		dataCampain.append( 'request' , 'getUsersModerator' );
		dataCampain.append( 'type' , '5' );
		dataCampain.append( 'userType' , userType );
		getPanelists( dataCampain );
	}

	selectPanelist.addEventListener('submit',function(event){
		event.preventDefault();
		const idpanelist = selectPanelist.elements['panelist'].value;
		window.location.href=`campain-answer?idcampain=${idcampain}&idpanelist=${idpanelist}&_order=1`;
	});

	const back = document.getElementById('back');
	back.addEventListener('click',function(){
		console.log('back');
		window.location.href = `campain?idcampain=${idcampain}`; ;
	});