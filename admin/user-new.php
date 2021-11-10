<!DOCTYPE html>
<html>
<head>
	<title>SUB SENSE - New User</title>
	<?php include('header_meta.php');?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
</head>
<body>
	<?php include('header.php');?>
	<main id="main" class="main">
		<?php include('sidebar.php');?>
		<section id="userNewSection">
			<div class="titleContainer"><h1 class="title">Nuevo Panelista</h1></div>
			<div class="row buttonContainer">
				<a href="users"><button class="add"><i class="bi bi-arrow-left"></i> <span>Regresar</span></button></a>
				<button class="save" id="saveNewUser"><i class="bi bi-person-plus-fill"></i> <span>Guardar</span></button>
			</div>
			<div class="row formContainer">
				<form id="personalForm">
					<p class="title">Información Personal</p>
					<div class="formRow">
						<p>Folio</p>
						<input type="number" name="folio" placeholder="Minimo 4 dígitos" required minlength="4" />
					</div>
					<div class="formRow">
						<p>Nombre</p>
						<input type="text" name="firstname" placeholder=" " required minlength="2"/>
					</div>
					<div class="formRow">
						<p>Apellidos</p>
						<input type="text" name="lastname" placeholder=" " required minlength="2"/>
					</div>
					<div class="formRow">
						<p>Email</p>
						<input type="email" name="email" placeholder=" " required minlength="5"/>
					</div>
					<div class="formRow">
						<p>Fecha de nacimiento</p>
						<div class="thirdRow">
							<input type="number" name="day" placeholder="DD" required max="31" minlength="1" />
							<input type="number" name="month" placeholder="MM" required max="12" minlength="2" />
							<input type="number" name="year" placeholder="AAAA" required minlength="4" />
						</div>
					</div>
					<div class="formRow">
						<p id="edad">&nbsp;</p>
						<div class="halfRow">
							<input type="radio" name="sex" id="m" value="m" required/>
							<label for="m"><span>Mujer</span></label>
							<input type="radio" name="sex" id="h" value="h" required/>
							<label for="h"><span>Hombre</span></label>
						</div>
					</div>
					<br>
					<p class="title">Clasificación</p>
					<div class="formRow">
						<p>NSE</p>
						<select id="nse" required>
							<option value="A/B">A/B</option>
							<option value="C+">C+</option>
							<option value="C">C</option>
							<option value="C-">C-</option>
							<option value="D+">D+</option>
							<option value="D">D</option>
							<option value="E">E</option>
						</select>
					</div>
					<input type="submit" id="submitPersonal" name="submitPersonal">
				</form>
				<form id="addressForm">
					<p class="title">Dirección</p>
					<div class="formRow">
						<p>Calle y número</p>
						<input type="text" name="addressline1" placeholder=" " required minlength="5">
					</div>
					<div class="formRow">
						<p>Entre calles</p>
						<input type="text" name="betweenstreet1" placeholder=" " required minlength="2">
					</div>
					<div class="formRow">
						<p>y</p>
						<input type="text" name="betweenstreet2" placeholder=" " required minlength="2" />
					</div>
					<div class="formRow">
						<p>Colonia</p>
						<input type="text" name="zone" placeholder=" " required minlength="2" />
					</div>
					<div class="formRow">
						<p>C.P.</p>
						<div class="halfRow">
							<input type="number" name="zipcode" placeholder=" " required minlength="6" />
							<input type="text" name="state" value="CDMX" disabled/>
						</div>
					</div>
					<div class="formRow">
						<p>Delegación</p>
						<div class="halfRow">
							<select name="city" required>
								<option value="Álvaro Obregón" selected>Álvaro Obregón</option>
								<option value="Azcapotzalco">Azcapotzalco</option>
								<option value="Benito Juárez">Benito Juárez</option>
								<option value="Coyoacán">Coyoacán</option>
								<option value="Cuajimalpa">Cuajimalpa</option>
								<option value="Cuauhtémoc">Cuauhtémoc</option>
								<option value="Gustavo A. Madero">Gustavo A. Madero</option>
								<option value="Iztacalco">Iztacalco</option>
								<option value="Iztapalapa">Iztapalapa</option>
								<option value="Magdalena Contreras">Magdalena Contreras</option>
								<option value="Miguel Hidalgo">Miguel Hidalgo</option>
								<option value="Milpa Alta">Milpa Alta</option>
								<option value="Tláhuac">Tláhuac</option>
								<option value="Venustiano Carranza">Venustiano Carranza</option>
								<option value="Xochimilco">Xochimilco</option>
							</select>
							<input type="text" name="country" value="MEX" disabled />
						</div>
					</div>

					<br>
					<p class="title">Contacto</p>
					<div class="formRow">
						<p>Teléfono</p>
						<input type="text" name="phone" placeholder="10 dígitos" required minlength="10">
					</div>

					<input type="submit" id="submitContact" name="submitContact">
				</form>
			</div>
		</section>
	</main>
	<?php include('modal.php');?>
	<?php include('footer.php');?>
	<script type="text/javascript" src="script/user_new.js"></script>
</body>
</html>