<?php 
  use Modelos\Usuario;
  use Controladores\LoginControlador;
  $usuario = LoginControlador::getUsuarioLogueado();
  require_once 'header.php';
?>
<body class="InitBody bg-img-adm">
<div class="container-fluid admin-header">
  <h1 class="display-4">Administración</h1><br>
</div>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
	<a class="navbar-brand" href="#"><?php echo $usuario->getUsername();  ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
	    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cervezas</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="<?php echo HOST; ?>/cerveza/listar">Listar</a>
          <a class="dropdown-item" href="<?php echo HOST; ?>/cerveza/alta">Agregar</a>
          <a class="dropdown-item" href="<?php echo HOST; ?>/administrador/botonLitrosFechas">Litros Vendidos</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sucursales</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="<?php echo HOST; ?>/sucursal/listar">Listar</a>
          <a class="dropdown-item" href="<?php echo HOST; ?>/sucursal/alta">Agregar</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Envases</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="<?php echo HOST; ?>/envase/listar">Listar</a>
          <a class="dropdown-item" href="<?php echo HOST; ?>/envase/alta">Agregar</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clientes</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="<?php echo HOST; ?>/usuario/listar">Listar</a>
          <a class="dropdown-item" href="<?php echo HOST; ?>/usuario/alta">Agregar</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item  float-right">
        <a class="nav-link active" href="<?php echo HOST; ?>/pedido/listar">Pedidos<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item  float-right">
        <a class="nav-link active" href="<?php echo HOST; ?>/login/logout">LogOut<span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>

<?php  
	require_once 'footer.php';
?>