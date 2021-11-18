const selectPanelist = document.getElementById('selectPanelist');
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
				users.forEach((item)=>{
					let opt = document.createElement("option");
					opt.value = item.iduser;
					opt.text = `${item.firstname} ${item.lastname}`;
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

	const idcampain = getCampaindId();
	if(!idcampain){window.location.href = 'campains';}
	else{
		selectPanelist.elements['idcampain'].value = idcampain;
		let dataCampain = new FormData();
		dataCampain.append( 'request' , 'getUsersModerator' );
		dataCampain.append( 'type' , '5' );
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