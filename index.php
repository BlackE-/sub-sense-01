<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SUB Sense</title>
</head>
<body>
	<?php include('header_meta.php');?>
	<?php include('header.php');?>

	<main id="main" class="main">
		<section id="index">
			<figure class="logoContainer">
				<img loading="lazy" src="img/SUB-icon-subchecker.svg" class="logo"/>
			</figure>
			<h1>SUB SENSE</h1>
		</section>
	</main>
	<?php include('footer.php');?>

	<script>
		checkLogin = () =>{
			let data = sessionStorage.getItem('session');
			if(data === null){
				window.location.href="login";
			}
		}

		checkLogin();
		
	</script>

</body>
</html>