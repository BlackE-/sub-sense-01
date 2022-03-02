	let userTypeForUsers;
	const usersType = '5';
	getAge = (dateString) => {
	    const today = new Date();
	    const birthDate = new Date(dateString);
	    const age = today.getFullYear() - birthDate.getFullYear();
	    const m = today.getMonth() - birthDate.getMonth();
	    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
	        age--;
	    }
	    return age;
	}

	fetchCall = ( answerData ) => {
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
					case 'checkUser':
						userTypeForUsers = data.return;
						getUsers();
					break;
					case 'getUsersModerator':
						if(!data.return){
							document.getElementById('usersTable').innerHTML = `<p>${data.message}</p>`;
							return;
						}
						//tenemos información
						const users = data.return;
						let userData = users.map(item => {
							const today = new Date();
							const birthDate = new Date(item.dob);
							let age = today.getFullYear() - birthDate.getFullYear();
							const m = today.getMonth() - birthDate.getMonth();
							if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {age--;}
							let arrayReturn = [item.folio,item.firstname,item.lastname,item.nse,item.sex];
							arrayReturn.splice(arrayReturn.length - 1, 0, `${item.dob}<br><span class="edad">${age} años</span>`);
							return arrayReturn;
						});
						table = new simpleDatatables.DataTable("#usersTable", {
							data: {
								headings: ["Folio","Nombre","Apellidos","NSE","Fecha de nacimiento","Genero"],
								data:userData
							}
						});
					break;
				}
			}
		})
		.catch((error) => {
		console.error('Error:', error);
		});
	}

	getUsers = () =>{
		let datos = new FormData();
		datos.append( 'request' , 'getUsersModerator' );
		datos.append( 'type' , usersType );
		// datos.append( 'userType' , userTypeForUsers );
		datos.append( 'userType' , sessionStorage.getItem('userType') );
		fetchCall(datos);
	}
	
	// checkUserType = () =>{
	// 	let user = new FormData();
	// 	user.append( 'request' , 'checkUser' );
	// 	fetchCall( user );
	// }
	// checkUserType();

	const button = document.querySelector("#tabletoexcel");
	button.addEventListener("click", e => {
	  let table = document.querySelector("#usersTable");
	  TableToExcel.convert(table,{name: "SUB-Sense_users.xlsx"});
	});

	fetchPost = (formData) =>{
		fetch('./include/uploadFile.php', {
		  method: 'POST',
		  body: formData
		})
		.then(response => response.json())
		.then(result => {
		  console.log(result);
		  window.location.reload();
		})
		.catch(error => {
		  console.error(`Error:  ${error}`);
		});
	}


	const importUsers = document.getElementById("importUsers");
	importUsers.addEventListener("change",(file)=>{
		openModalFunction();

		let formData = new FormData();
		formData.append('request','importUsers');
		formData.append('file',file.target.files[0]);
		fetchPost(formData);
	});