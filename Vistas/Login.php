<?php  
	use Controladores\LoginControlador;
	require_once 'header.php';
?>
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet"> 
<body class="bg-img-log">
<nav class="navbar navbar-dark bg-dark">
      
	<form action="./Login/procesarLogin" method="post" class="form-inline" >
		<label for="usuario" style="margin-right: 10px; margin-left: 10px; align:right"; >Usuario</label>
		<input type="text" id="usuario" name="usuario" class="form-control form-control-sm; align:right" required autofocus>
		
		<label for="contrasenia" style="margin-right: 10px; margin-left: 10px; align:right">Contraseña</label>
		<input type="password" id="contrasenia" name="contrasenia" class="form-control form-control-sm; align:right" required>
		
		<button class="btn btn-sm btn-black" type="submit" style="margin-left: 10px; align:right">Ingresar</button>
	</form>
    <br>
    <a href="#" id="btn-registro" style="color: #ffffff; ">Registrate aca!</a>
       
</nav>

<br>
<font face="times, serif" size="1">

<center><h1>Schwein
<br>
Autentica tradicion cervecera
<br>
</h1></center>
<br>
</font>

<center>
<div class="conteiner bg-dark col-md-8"  style="opacity: 0.8; margin-top: 40px;">
	<h3 class="form-signin-heading text-center" style="font-family: 'Bree Serif', serif;">Agua + Malta + Lupulo + Levadura</h3><br>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et tristique erat, sit amet congue leo. Ut egestas felis non commodo bibendum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed sagittis eros eu lectus placerat, vel consectetur lectus vestibulum. Suspendisse tortor est, interdum a eros ac, accumsan pulvinar tellus. Donec iaculis ligula id luctus volutpat. Morbi sapien turpis, egestas ac libero non, finibus pellentesque nisl. Donec aliquet urna nec lorem sagittis imperdiet. 
		Nulla ut lorem nunc. Nunc maximus lobortis sem, non sollicitudin ligula. </p>
	<form action="../Usuario/darDeAlta" method="post">
		<br><h3><a href="#" id="btn-sucursales" style="color:#ffffff;">Veni a visitarnos!</a></h3>
		
	</form>
</div>
</center>












<center>
<div class="conteiner bg-dark col-md-8" id="registro" style="opacity: 0.8; margin-top: 40px;">
	<h3 class="form-signin-heading text-center">Registro</h3><br>
	<form action="../Usuario/darDeAlta" method="post">
		<div class="form-row">
			<div class="form-group col-md-6">
		        <label for="nombre">Nombre</label>
		        <input type="text" id="nombre" name="nombre" class="form-control form-control-sm">
			</div>
			<div class="form-group col-md-6">
		        <label for="apellido">Apellido</label>
		        <input type="text" id="apellido" name="apellido" class="form-control form-control-sm">
			</div>
			<div class="form-group col-md-6">
			    <label for="domicilio">Domicilio</label>
			    <input type="text" id="domicilio" name="domicilio" class="form-control form-control-sm">
			</div>
		    <div class="form-group col-md-6">
		        <label for="telefono">Telefono</label>
		        <input type="number" id="telefono" name="telefono" class="form-control form-control-sm">
			</div>
			<div class="form-group col-md-6">
		        <label for="email">Email</label>
		        <input type="email" id="email" name="email" class="form-control form-control-sm">
			</div>
			<div class="form-group col-md-6">
		        <label for="usuario">Usuario</label>
		        <input type="text" name="usuario" class="form-control form-control-sm">
			</div>
			<div class="form-group col-md-6">
		        <label for="contrasenia">Contraseña</label>
		        <input type="password" name="contrasenia" class="form-control form-control-sm" required>
			</div>
			<div class="form-group col-md-6">
		        <label for="Ccontrasenia">Confirmar contraseña</label>
		        <input type="password" id="Ccontrasenia" name="Ccontrasenia" class="form-control form-control-sm" required><br>
			</div>
		        <button class="btn btn-sm btn-black btn-block" type="submit">Registrar</button>
		</div><br>
	</form>
</div>
</center>


<br>
<br>

<section class="ubicacion" id="ubicacion">
			<div class="contenedor">
				<center><h1 class="titulo">Nuestras Sucursales</h1></center>
				
		<center><div class="horarios">
					<center><h2>Horarios</h2></center>
					<p class="entre-semana">Lunes a Jueves<br> 11:00am - 22:00pm</p>
					<p class="finde-semana">Viernes Sabados y Domingos<br> 12:00pm - 02:00am</p>
				</div>
			</div>
		</section>

<script type="text/javascript">
	$(document).ready(function() {
		var registro = $('#registro').offset().top;
		var ubicacion = $('#ubicacion').offset().top;

		$('#btn-registro').on('click', function(e){
			e.preventDefault();
			$('html, body').animate({
					scrollTop: registro 
				},
				500
			);
		});

		$('#btn-sucursales').on('click', function(e){
			e.preventDefault();
			$('html, body').animate({
					scrollTop: ubicacion 
				},
				500
			);
		});
	});
</script>



<?php require_once 'MapaSucursales.php'; ?>
<?php require_once 'footer.php'; ?>