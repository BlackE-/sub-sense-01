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
			const campains = data.return;
			let dataHeadings = ['Campaña','Nombre','Estatus','Fecha Creación'];
			let campainsData = campains.map(item =>{
				let arrayReturn = [`<a href="campain?idcampain=${item.idcampain}">${item.idcampain}</a>`,item.name];
				console.log(item.status);
				let s = (item.status === "1") ? "Activo": "Inactivo";
				arrayReturn.push(s);
				arrayReturn.push(item.date_created);
				return arrayReturn;
			});
			table = new simpleDatatables.DataTable("#campainTable", {data: {headings: dataHeadings,data:campainsData}});
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