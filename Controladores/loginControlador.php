<?php 

namespace Controladores; 

use DAOs\BDUsuario;

class LoginControlador extends ControladorComun {

	public function index(){
		$usuario = $this->getUsuarioLogueado();
		if (is_null($usuario)) {
			require_once "Vistas/Login.php";	
		} else {
			if ($usuario->getAdmin() == 1) {
				header("Location: ".HOST."/administrador/menu");
			} else {
				header("Location: ".HOST."/cliente/menu");
			}
		}
	}

	public function procesarLogin($usuario, $contrasenia){

		try {
			$usuario = trim($usuario);
			if (strlen($usuario) == 0) {
				throw new \Exception('El usuario esta vacio');
			}

			$contrasenia = trim($contrasenia);
			if (strlen($contrasenia) == 0) {
				throw new \Exception('La contrasena esta vacia');
			}

			$modelo = BDUsuario::getInstance();
			$usuario = $modelo->getUsuarioPorUsername($usuario);
			
			if (is_null($usuario)) {
				throw new \Exception('El usuario no existe');
			}

			if ($usuario->getContrasenia() !== $contrasenia) {
				throw new \Exception('Contrasenia incorrecta');
			}

			$this->setUsuarioEnSession($usuario);

			if ($usuario->getAdmin() == 1) {
				header("Location: ".HOST."/administrador/menu");
				exit;
			} else {
				header("Location: ".HOST."/cliente/menu");
				exit;
			}

		} catch (\Exception $exception) {
        	echo '<script> alert("'.$exception->getMessage().'"); </script>';
        	require_once "Vistas/Login.php";
    	}			
	}

	protected function setUsuarioEnSession($usuario) {
		$_SESSION['USUARIO-LOGUEADO'] = $usuario;
	}

	public static function getUsuarioLogueado() {
		if (isset($_SESSION['USUARIO-LOGUEADO'])) {
			$usuario = $_SESSION['USUARIO-LOGUEADO'];
			return $usuario;
		} else {
			return null;
		}
	}
}
