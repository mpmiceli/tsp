<?php 

namespace Controladores;

use Config\Request;
use Modelos;
use Controladores;
use DAOs\BDCerveza;
use DAOs\BDUsuario;
use DAOs\BDEnvase;
use DAOs\BDSucursal;
use DAOs\BDLineaPedido;
use DAOs\BDPedido;
use DAOs\DAOLineaPedido;
use DAOs\DAOCerveza;
use DAOs\DAOEnvase;
use Vistas;

class PedidoControlador extends ControladorComun {

    private $datoPedido;
    private $datoSucursal;
    private $datoCerveza;
    private $datoEnvase;

    public function __construct()
    {
        $this->datoPedido = BDPedido::getInstance();
        $this->datoSucursal = BDSucursal::getInstance();
        $this->datoCerveza = BDCerveza::getInstance();
        $this->datoEnvase = BDEnvase::getInstance();
    }

    public function listar()
    {
        $sucursales = $this->datoSucursal->getLista();
        require_once('Vistas/Administrador.php');
        require_once 'Vistas/AdministradorPedido.php';
    }

    public static function getCarrito(){
        if (!isset($_SESSION['PEDIDO'])) {
            $pedido = new Modelos\Pedido();

            $cliente = $_SESSION['USUARIO-LOGUEADO'];
            $pedido->setUsuario($cliente);

            $_SESSION['PEDIDO'] = $pedido;
        }
        return $_SESSION['PEDIDO'];
    }

    public function agregarLinea($idCerveza, $idEnvase, $cantidad){
        $pedido = self::getCarrito();

        $cerveza = $this->datoCerveza->buscar($idCerveza);
        $envase = $this->datoEnvase->buscar($idEnvase);
        $precio = $cerveza->calcularPrecio($envase);

        $linea = new Modelos\LineaPedido();
        $linea->setCerveza($cerveza);
        $linea->setEnvase($envase);
        $linea->setPrecio($precio * $cantidad);
        $linea->setCantidad($cantidad);
        
        $pedido->setLineaPedido($linea);
        $montoParcial = 0;
        
        foreach ($pedido->getLineaPedido() as $lineaP) {
            $montoParcial = $montoParcial + $lineaP->getPrecio();
        }
        
        $pedido->setMontoFinal($montoParcial);

        $_SESSION['PEDIDO'] = $pedido;
        
        header("Location: ".HOST."/cliente/listarCerveza");
    }

    public function eliminarLinea($pos = 0){
        $pedido = $_SESSION['PEDIDO'];
        $nuevoArray = array();
        $lineasP = $pedido->getLineaPedido();
        for ($i=0; $i<count($lineasP); $i++){
            if($i != $pos){
                array_push($nuevoArray, $lineasP[$i]);
            }
        }
        $pedido->setAllLineaPedido($nuevoArray);
        $montoParcial = 0;
        foreach ($pedido->getLineaPedido() as $lineaP) {
            $montoParcial = $montoParcial + $lineaP->getPrecio();
        }
        $pedido->setMontoFinal($montoParcial);
        header("Location: ".HOST."/cliente/mostrarCarrito");
    }

    public function finalizarPedido($fecha_entrega, $tipo_entrega, $dato_entrega){

        $pedido = $_SESSION['PEDIDO'];

        try {

            if (empty($pedido->getLineaPedido())) {
                throw new \Exception("El carrito esta vacio");
            }

            // Domicilio
            if ($tipo_entrega == "1") {
                
                $cliente = $pedido->getUsuario();
                $datosSucursales = new Controladores\SucursalControlador();
                $sucursales = $datosSucursales->getListaSucursales();
                $distancia = 200;
                foreach ($sucursales as $sucursal) {
                    $temp = $this->getDistancia($sucursal->getDireccionCompleta(), $cliente->getDomicilio());
                    if($temp<$distancia){
                        $pedido->setSucursal($sucursal->getId());
                        $distancia = $temp;
                    }
                }
                $horario = $dato_entrega;
                $pedido->setHorario($horario);

            } else {
                $id_sucursal = $dato_entrega;
                $pedido->setSucursal($id_sucursal);
            }

            $pedido->setTipoEntrega($tipo_entrega);
            $pedido->setFechaEntrega($fecha_entrega);
            $pedido->setEstado(Modelos\Pedido::ESTADO_SOLICITADO);
            
            $this->datoPedido->agregar($pedido);

            $this->vaciarCarrito();

            header("Location: ".HOST."/cliente/menu");
        
        } catch(\Exception $exception) {
            echo '<script> alert("'.$exception->getMessage().'"); </script>';
            require_once "Vistas/Cliente.php";
        }
    }

    public function listarPedidos(){
        $cliente = $_SESSION['USUARIO-LOGUEADO'];
        $listaPedidos = $this->datoPedido->listarPedidos($cliente);
        return $listaPedidos;
    }

    public function listarPedidosUsuario($usuario){
        $datosUsuarios = BDUsuario::getInstance();
        $cliente = $datosUsuarios->getUsuarioPorUsername($usuario);
        if ($cliente != null) {
            $listaPedidos = $this->datoPedido->listarPedidos($cliente);
            require_once('Vistas/Administrador.php');
            require_once('Vistas/AdministradorListarPedidoUsuario.php');
        }else{
            $datosSucursal = new Controladores\SucursalControlador();
            $sucursales = $datosSucursal->getListaSucursales();
            require_once('Vistas/Administrador.php');
            require_once 'Vistas/AdministradorPedido.php';
        }
    }

    public function listarPedidosSucursales($id_sucursal){
        $listaPedidos = $this->datoPedido->listarPedidoSucursal($id_sucursal);
        $datosSucursal = new Controladores\SucursalControlador();
        $sucursal = $datosSucursal->buscarSucursal($id_sucursal);
        require_once('Vistas/Administrador.php');
        require_once('Vistas/AdministradorListarPedidoSucursal.php');
    }

    public function listarPedidosFechas($fecha){
        $listaPedidos = $this->datoPedido->listarPedidoFecha($fecha);
        require_once('Vistas/Administrador.php');
        require_once('Vistas/AdministradorListarPedidoFecha.php');
    }

    public function modificarEstadoUsuario($id, $usuario, $estado = 0){
        $this->datoPedido->modificarEstado($estado, $id);
        header("Location: ".HOST."/pedido/listarPedidosUsuario/" . $usuario); 
    }

    public function modificarEstadoSucursal($id, $id_sucursal, $estado = 0){
        //$pepe = [$estado, $id];



        $this->datoPedido->modificarEstado($estado, $id);
        
        header("Location: ".HOST."/pedido/listar"); 
    }

    public function modificarEstadoFecha($id, $fecha, $estado = 0){
        $this->datoPedido->modificarEstado($estado, $id);
        header("Location: ".HOST."/pedido/listarPedidosFechas/" . $fecha); 
    }

    public function eliminarPedido($id){
        $this->datoPedido->eliminar($id);
        header("Location: ".HOST."/administrador/listarPedidos"); 
    }

    protected function vaciarCarrito(){
        $pedido = new Modelos\Pedido();
        $cliente = $_SESSION['USUARIO-LOGUEADO'];
        $pedido->setUsuario($cliente);
        $_SESSION['PEDIDO'] = $pedido;
    }

    protected function getDistancia($addressFrom, $addressTo){
        //Change address format
        $formattedAddrFrom = str_replace(' ','+',$addressFrom);
        $formattedAddrTo = str_replace(' ','+',$addressTo);
        
        //Send request and receive json data
        $geocodeFrom = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false');
        $outputFrom = json_decode($geocodeFrom);
        $geocodeTo = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false');
        $outputTo = json_decode($geocodeTo);
        
        //Get latitude and longitude from geo data
        $latitudeFrom = $outputFrom->results[0]->geometry->location->lat;
        $longitudeFrom = $outputFrom->results[0]->geometry->location->lng;
        $latitudeTo = $outputTo->results[0]->geometry->location->lat;
        $longitudeTo = $outputTo->results[0]->geometry->location->lng;
        
        //Calculate distance from latitude and longitude
        $theta = $longitudeFrom - $longitudeTo;
        $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return ($miles * 1.609344);
    }


}
