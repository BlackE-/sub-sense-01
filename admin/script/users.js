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

	getUsers = (type) =>{
		const requestData = { request: 'getUsersModerator',type:type };
		fetch('./include/request.php', {
		  method: 'POST', // or 'PUT'
		  headers: {'Content-Type': 'application/json',},
		  body: JSON.stringify(requestData),
		})
		.then(response => response.json())
		.then(data => {
			if(!data.return){
				document.getElementById('usersTable').innerHTML = `<p>${data.message}</p>`;
				return;
			}

			//tenemos información
			const users = data.return;
			console.log(users);
			let userHeadings = Object.keys(users[0]);
			userHeadings.pop();	//panelist
			userHeadings.pop();	//moderator
			userHeadings.pop();	//type
			userHeadings.pop();	//iduser

			let userData = users.map(item => {
				const today = new Date();
			    const birthDate = new Date(item.dob);
			    let age = today.getFullYear() - birthDate.getFullYear();
			    const m = today.getMonth() - birthDate.getMonth();
			    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {age--;}
				let arrayReturn = [item.folio,item.firstname,item.lastname,item.nse,item.sex];
				arrayReturn.splice(arrayReturn.length - 1, 0, `${item.dob}<br><span class="edad">${age} años</span>`);
				return arrayReturn;
			})


				
			console.log(userData);

			table = new simpleDatatables.DataTable("#usersTable", {
				data: {
					headings: userHeadings,
					data:userData
				}
			});

			// console.log(headings);
		 	// table = new simpleDatatables.DataTable("#usersTable", {
		  //       data: {
		  //         headings: headings,
		  //         data: users.map(item => Object.values(item)),
		  //       }
		  //   });

		 	

		    // table = new simpleDatatables.DataTable("#usersTable", 
		 //    {
		 //        data: {
		 //          headings: Object.keys(users[0]),
		 //          data: users.map(item => Object.values(item)),
		 //        },
		 //        // perPageSelect: [
		 //        // 					Math.ceil(data.length / 5),
		 //        // 					Math.ceil(data.length / 4),
		 //        // 					Math.ceil(data.length / 3),
		 //        // 					Math.ceil(data.length / 2),
		 //        // 					data.length
		 //        // 				],
		 //        // paging:false
		 //      });

		})
		.catch((error) => {
		  console.error('Error:', error);
		});
	}

	getUsers('5');

	const button = document.querySelector("#tabletoexcel");
	button.addEventListener("click", e => {
	  let table = document.querySelector("#usersTable");
	  TableToExcel.convert(table,{name: "SUB-Sense_users.xlsx"});
	});