	
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
				document.getElementById(object.idinput).value = data.return;
			}
		})
		.catch((error) => {
		  console.error('Error:', error);
		});
	}

	getCampainsCount = () =>{
		let campainsForm = new FormData();
		campainsForm.append( 'request' , 'getCampainsCount' );
		campainsForm.append( 'idinput' , 'campainsCount' );
		fetchCall( campainsForm );
	}

	getPanelistsCount = () =>{
		let panelistForm = new FormData();
		panelistForm.append( 'request' , 'getPanelistCount' );
		panelistForm.append( 'idinput' , 'panelistCount' );
		fetchCall( panelistForm );
	}

	getPanelistsCount();
	getCampainsCount();