	const newURL = window.location.protocol + "/" + window.location.host + "/" + window.location.pathname + window.location.search;
	// console.log(newURL);
	const urlArray = newURL.split('/');
	const urlActive = urlArray[urlArray.length-1];

	if(urlActive.includes('user')){
		document.getElementsByClassName('menu')[0].classList.add('active');
	}else{
		if(urlActive.includes('campain')){
			document.getElementsByClassName('menu')[1].classList.add('active');
		}else{
			if(urlActive.includes('reports')){
				document.getElementsByClassName('menu')[2].classList.add('active');
			}else{
				if(urlActive.includes('realtime')){
					document.getElementsByClassName('menu')[3].classList.add('active');
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
	
	