<?php
	$idcampain = $_GET['idcampain'];
?>
<link rel="stylesheet" type="text/css" href="css/app.css">
<main id="mainPanelist">
	<section id="campainpanelist">
		<form id="selectPanelist">
			<input type="hidden" name="idcampain">
			<p>Elige un panelista para iniciar el cuestionario</p>
			<select name="panelist">

			</select>
			<input type="submit" name="submitPanelist" value="ELEGIR"/>
			<a id="back" onclick="window.history.go(-1); return false;"><button>REGRESAR</button></a>
		</form>
	</section>
</main>


<script type="text/javascript">
	
	const selectPanelist = document.getElementById('selectPanelist');
	getPanelists = ( dataFetch ) =>{
		let object = {};
        dataFetch.forEach((value, key) => object[key] = value);
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
				const users = data.return;
				users.forEach((item)=>{
					let opt = document.createElement("option");
					opt.value = item.iduser;
					opt.text = `${item.firstname} ${item.lastname}`;
					selectPanelist.elements['panelist'].add(opt, null);
				})
			}
		})
		.catch((error) => {
		  console.error('Error:', error);
		});
	}	

	getCampaindId = () =>{
		const url_string = window.location.href
		const url = new URL(url_string);
		return url.searchParams.get("idcampain"); 
	}

	const idcampain = getCampaindId();
	if(!idcampain){window.location.href = 'campains';}
	else{
		selectPanelist.elements['idcampain'].value = idcampain;
		let dataCampain = new FormData();
		dataCampain.append( 'request' , 'getUsersModerator' );
		dataCampain.append( 'type' , '5' );
		getPanelists( dataCampain );
	}

	selectPanelist.addEventListener('submit',function(event){
		event.preventDefault();
		const idpanelist = selectPanelist.elements['panelist'].value;
		window.location.href=`campain-answer?idcampain=${idcampain}&idpanelist=${idpanelist}&_order=1`;
	});

</script>