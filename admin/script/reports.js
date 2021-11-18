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
				switch(object.request){
					case 'getCampains':
					break;
					case 'getSurveysData':
					break;
				}
			}
		})
		.catch((error) => {
		  console.error('Error:', error);
		});
	}

	getCampains = () =>{
		let campainsForm = new FormData();
		campainsForm.append( 'request' , 'getCampains' );
		campainsForm.append( 'idinput' , 'campainList' );
		fetchCall( campainsForm );
	}