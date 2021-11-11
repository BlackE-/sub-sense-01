	getCampains = () =>{
		const requestData = { request: 'getCampains' };
		fetch('./include/request.php', {
		  method: 'POST', // or 'PUT'
		  headers: {'Content-Type': 'application/json',},
		  body: JSON.stringify(requestData),
		})
		.then(response => response.json())
		.then(data => {
			if(!data.return){
				document.getElementById('campainTable').innerHTML = `<p>${data.message}</p>`;
				return;
			}

			//tenemos información
			const campains = data.return;
			console.log(campains);
			let dataHeadings = ['Campaña',...Object.keys(campains[0])];
			dataHeadings.pop();	//idcapain
			console.log(dataHeadings);


			let campainsData = campains.map(item =>{
				let arrayReturn = [`<a href="campain?idcampain=${item.idcampain}">${item.idcampain}</a>`,item.name,item.status,item.date_created];
				return arrayReturn;
				
			});

			console.log(campainsData);

			table = new simpleDatatables.DataTable("#campainTable", {
				data: {
					headings: dataHeadings,
					data:campainsData
				}
			});

		})
		.catch((error) => {
		  console.error('Error:', error);
		});
	}

	getCampains();

	const button = document.querySelector("#tabletoexcel");
	button.addEventListener("click", e => {
	  let table = document.querySelector("#usersTable");
	  TableToExcel.convert(table,{name: "SUB-Sense_campains.xlsx"});
	});