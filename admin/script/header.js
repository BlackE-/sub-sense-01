	const newURL = window.location.protocol + "/" + window.location.host + "/" + window.location.pathname + window.location.search;
	const urlArray = newURL.split('/');
	const urlActive = urlArray[urlArray.length-1];
	const menuOptions = document.getElementsByClassName('menu');
	let userType = null;
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
				// console.log(data.return);
				userType = data.return;
				sessionStorage.setItem('userType', userType);
				setHeader();
			}
		})
		.catch((error) => {console.error('Error:', error);});
	}

	setHeader = () => {
		switch(userType){
			case '4':case '5':
				menuOptions[3].style.display="none";
				menuOptions[4].style.display="none";
				switch(urlActive){
					case "campains": case "users":
						document.getElementById("adminRow").style.display = "none";
					break;
				}
			break;
		}
		if(urlActive.includes('user')){
			menuOptions[1].classList.add('active');
		}else{
			if(urlActive.includes('campain')){
				menuOptions[2].classList.add('active');
			}else{
				if(urlActive.includes('reports')){
					menuOptions[3].classList.add('active');
				}else{
					if(urlActive.includes('realtime')){
						menuOptions[4].classList.add('active');
					}else{
						if(urlActive.includes('profile')){
							menuOptions[0].classList.add('active');
						}else{
							if(!urlActive.includes('?')){
								const liActive = '#nav_'+urlActive;
								const active = document.querySelector(liActive);
								if(active !== null){
									console.log(typeof active);
									active.classList.add('active');
								}
							}
						}
					}
				}
			}
			
		}
	}

	//entrevistador no puede ver reportes ni tiempo real
	checkUser = () =>{
		let user = new FormData();
		user.append( 'request' , 'checkUser' );
		fetchCall( user );
	}
	(userType == null) ? checkUser() : setHeader();