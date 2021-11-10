	setError = ( input ) =>{
		input.classList.add('error');
		setTimeout(()=>{input.classList.remove('error')},2000);
	}

	insertCampain = ( dataCampain ) =>{
		var object = {};
		dataCampain.forEach((value, key) => object[key] = value);

		openModalFunction();

		fetch('./include/request.php', {
		  method: 'POST', // or 'PUT'
		  headers: {'Content-Type': 'application/json',},
		  body: JSON.stringify(object),
		})
		.then(response => response.json())
		.then(data => {
			console.log('Success:', data);
			if(!data.return){
				console.log(data.message);
			}else{
				console.log('Success:', data);
				modalHideLoading();
				const path = `campain-add-surveys?idcampain=${data.return}`;
				modalSetMessage(data.message);
				setTimeout(function(){
					closeModalFunction();
					window.location.href = path;
				},5000);
			}
		})
		.catch((error) => {
		  console.error('Error:', error);
		});
	}

	const campainForm = document.getElementById('campainForm');
	campainForm.addEventListener("submit",function(event){event.preventDefault()});

	const saveNewCampain = document.getElementById('saveNewCampain');
	saveNewCampain.addEventListener('click',function(){

		const submitCampain = document.getElementById('submitCampain');
		submitCampain.click();

		const name = campainForm.elements['nameCampain'];
		if(!name.checkValidity()){setError( name );return;}
		const description = campainForm.elements['descriptionCampain'];
		if(!description.checkValidity()){setError( description );return;}
		const numberSurveys = campainForm.elements['numberSurveys'];
		if(!numberSurveys.checkValidity()){setError( numberSurveys );return;}


		const formData = new FormData();
		formData.append('request', 'insertCampain');

		formData.append('name', 	name.value );
		formData.append('description', description.value);
		formData.append('numberSurveys', numberSurveys.value);

		insertCampain( formData );

	});