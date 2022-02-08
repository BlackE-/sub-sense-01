    const checkPassword = (pwd) =>{
        const re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{0,9}$/;
        return re.test(pwd);
    }

    fetchCall = ( answerData ) =>{
        openModalFunction();
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
                modalHideLoading();
                modalSetMessage(data.message);
                setTimeout(function(){closeModalFunction();},2000);
                return;
			}else{
                setTimeout(function(){closeModalFunction();window.location.href="login";},2000);
			}
		})
		.catch((error) => {console.log('Error:', error);});
	}

    const _type = document.getElementById('type');
    _type.addEventListener("change",function(){
        switch(_type.value){
            case '5':case '4':
                document.querySelector('.panelistRow').style.display="block";
                document.querySelector(".regularRow").style.display="none";
            break;
            default:
                document.querySelector('.panelistRow').style.display="none";
                document.querySelector(".regularRow").style.display="block";
            break;
        }
    });

    const formulario = document.getElementById('form1');
    formulario.addEventListener('submit', (event) =>{
        event.preventDefault();
        let registro = new FormData();
		registro.append( 'request' , 'registerUser' );
		registro.append( '_type' , _type.value );
        let username = '';
        let email = '';
        switch(_type.value){
            case '5':case '4':  username=formulario.elements['username'].value; break;
            default:  email = formulario.elements['email'].value;  break;
        }
        registro.append( 'username' ,  username);
        registro.append( 'email' , email );
        registro.append( 'password' , formulario.elements['pass1'].value );
		fetchCall( registro );
    });