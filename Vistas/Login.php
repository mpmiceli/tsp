<?php  
	use Controladores\LoginControlador;
	require_once 'header.php';
?>
<body class="bg-img-log">
<nav class="navbar navbar-dark bg-dark">
      
	<form action="./Login/procesarLogin" method="post" class="form-inline" >
		<label for="usuario" style="margin-right: 10px; margin-left: 10px; align:right"; >Usuario</label>
		<input type="text" id="usuario" name="usuario" class="form-control form-control-sm; align:right" required autofocus>
		
		<label for="contrasenia" style="margin-right: 10px; margin-left: 10px; align:right">Contraseña</label>
		<input type="password" id="contrasenia" name="contrasenia" class="form-control form-control-sm; align:right" required>
		
		<button class="btn btn-sm btn-black" type="submit" style="margin-left: 10px; align:right">Ingresar</button>
	</form>
        	<br><a href="#" id="btn-registro">Registrate aca!</a>
       
</nav>
//////////////////////////////
<br>
//////////////////////
<br>
'
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>
'<br>




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

<script type="text/javascript">
	$(document).ready(function() {
		var registro = $('#registro').offset().top;

		$('#btn-registro').on('click', function(e){
			e.preventDefault();
			$('html, body').animate({
					scrollTop: registro 
				},
				500
			);
		});
	});
</script>

<?php require_once 'MapaSucursales.php'; ?>
<?php require_once 'footer.php'; ?>