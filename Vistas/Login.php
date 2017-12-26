<?php  
	use Controladores\LoginControlador;
	require_once 'header.php';
?>
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet"> 
<body class="bg-img-log">
<nav class="navbar navbar-dark bg-dark">
      
	<form action="./Login/procesarLogin" method="post" class="form-inline" >
		<label for="usuario" style="margin-right: 10px; margin-left: 10px"; >Usuario</label>
		<input type="text" id="usuario" name="usuario" class="form-control form-control-sm" required autofocus>
		
		<label for="contrasenia" style="margin-right: 10px; margin-left: 10px">Contraseña</label>
		<input type="password" id="contrasenia" name="contrasenia" class="form-control form-control-sm" required>
		
		<button class="btn btn-sm btn-black" type="submit" style="margin-left: 10px">Ingresar</button>

<a href="#" id="btn-registro" style=" font-size:5; margin-right: 10px; margin-left: 360px; color: #ffffff; "><h6>Todavia no tenes cuenta?</h6> Registrate</a>
	</form>
    <br>
    
       
</nav>

<br>


<br><center>
<font face="times, serif" size="1">
<div class="conteiner bg-white col-md-10"  style="opacity: 0.8; margin-top: 50px; color: black; ">
<h1 style="font-family: 'Bree Serif', serif; color: black; ">Schwein
<br>
Autentica tradicion cervecera
<br>
</h1>
<br>
</font>



	<h3 class="form-signin-heading text-center" style="font-family: 'Bree Serif', serif; color: black; ">Agua + Malta + Lupulo + Levadura</h3><br>
	<p>

“La cerveza forma parte de nuestras vidas. Siendo una de las bebidas más populares y consumidas en el mundo, en Cervecería Schwein buscamos la perfección para brindar una Auténtica Cerveza Artesanal. Contando con cervezas claras, oscuras, de trigo, de alta o baja fermentación, hemos seducido los paladares más exigentes. Quienes confían en nosotros, ven proyección, crecimiento sostenido en el tiempo y resultados efectivos.”
ETIENNE LEROUX

Director Schwein
 </p>
	<form action="../Usuario/darDeAlta" method="post">
		<br><h3><a href="#" id="btn-sucursales" style="color: black;">Veni a visitarnos!</a></h3>
		
	</form>
</div>
</center>












<center>
<div class="conteiner bg-dark col-md-8" id="registro" style="opacity: 0.8; margin-top: 70px;">
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
<center>
<section class="ubicacion" id="ubicacion">
			<div class="conteiner bg-white col-md-10"  style="opacity: 0.8; margin-top: 50px; color: black; ">
				<center><h1 class="titulo" style="font-family: 'Bree Serif', serif; ">Nuestras Sucursales</h1></center>
				
		<center><div class="horarios" style="font-family: 'Bree Serif', serif; ">
					<center><h2>Horarios</h2></center>
					<p class="entre-semana"><h3>Lunes a Jueves<br> 11:00am - 22:00pm</h3></p>
					<p class="finde-semana"><h3>Viernes Sabados y Domingos<br> 12:00pm - 02:00am</h3></p>
				</div>
			</div>
		</section>
</center>


<section class="redes-sociales">
				<div class="contenedor">
					<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
					<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
					<a href="#" class="you-tube"><i class="fa fa-youtube-play"></i></a>
					<a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
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