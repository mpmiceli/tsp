<?php

namespace DAOs;

use Config\Singleton;
use Config\Connection;
use Controladores;
use Modelos;

class BDCerveza extends Singleton 
{
    public function agregar($cerveza)
    {
        $query = "
            INSERT INTO cervezas(nombre, descripcion, precio, imagen, activo)
            VALUES (:nombre, :descripcion, :precio, :imagen, :activo);
        ";

        $connection = new Connection();
        $pdo = $connection->connect();
        
        $command = $pdo->prepare($query);

        $nombre = $cerveza->getNombre();
        $descripcion = $cerveza->getDescripcion();
        $precio = $cerveza->getPrecio();
        $imagen = $cerveza->getImagen();
        if (empty($imagen)) {
            $imagen = '';
        }
        $activo = $cerveza->getActivo();

        $command->bindParam(':nombre', $nombre);
        $command->bindParam(':descripcion', $descripcion);
        $command->bindParam(':precio', $precio);
        $command->bindParam(':imagen', $imagen);
        $command->bindParam(':activo', $activo);
        
        $command->execute();

        $this->agregarEnvases($pdo->lastInsertId(), $cerveza->getEnvases());
    }

    public function getLista()
    {
        $query = "SELECT * FROM cervezas WHERE activo = 1;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->execute();

        $lista = array();
        while ($row = $command->fetch()) {
            $cerveza = new Modelos\Cerveza();

            $cerveza->setId($row['id']);
            $cerveza->setNombre($row['nombre']);
            $cerveza->setDescripcion($row['descripcion']);
            $cerveza->setPrecio($row['precio']);
            $cerveza->setEnvases($this->listarEnvases($cerveza->getId()));
            $cerveza->setImagen($row['imagen']);

            array_push($lista, $cerveza);
        }
        return $lista;
    }

    public function eliminar($id){

        $this->eliminarEnvases($id);

        $query = " UPDATE cervezas SET activo = 0
            WHERE id = :id;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':id', $id);
        $command->execute();

        $this->eliminarEnvases($id);
    }

    public function buscar($id){

        $query = "SELECT * FROM cervezas WHERE id = :id;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':id', $id);
        $command->execute();

        $row = $command->fetch();

        $cerveza = new Modelos\Cerveza();
        $cerveza->setId($row['id']);
        $cerveza->setNombre($row['nombre']);
        $cerveza->setDescripcion($row['descripcion']);
        $cerveza->setPrecio($row['precio']);
        $cerveza->setEnvases($this->listarEnvases($cerveza->getId()));
        $cerveza->setImagen($row['imagen']);

        return $cerveza;
    }

    public function buscarXnombre($nombre){

        $query = "SELECT * FROM cervezas WHERE nombre = :nombre;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':nombre', $nombre);
        $command->execute();

        $row = $command->fetch();

        $cerveza = new Modelos\Cerveza();
        $cerveza->setId($row['id']);
        $cerveza->setNombre($row['nombre']);
        $cerveza->setDescripcion($row['descripcion']);
        $cerveza->setPrecio($row['precio']);
        $cerveza->setEnvases($this->listarEnvases($cerveza->getId()));

        return $cerveza;
    }

    public function modificar($id, $parametros, $imagen){

        $miniQueryImagen = '';        
        if (!empty($imagen)) {
            $miniQueryImagen = "imagen = :imagen,";
        }

        $query = "
            UPDATE cervezas
            SET nombre = :nombre,
                descripcion = :descripcion,
                precio = :precio,
                ".$miniQueryImagen."
                activo = :activo
            WHERE id = :id;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $nombre = $parametros['nombre'];
        $descripcion = $parametros['descripcion'];
        $precio = $parametros['precio'];
        $activo = $parametros['activo'];
        
        $command->bindParam(':id', $id);
        $command->bindParam(':nombre', $nombre);
        $command->bindParam(':descripcion', $descripcion);
        $command->bindParam(':precio', $precio);
        $command->bindParam(':activo', $activo);
        if ($imagen) {
            $command->bindParam(':imagen', $imagen);
        }

        $command->execute();

        $envases = $parametros['envases'];
        $envasesC = array();

        foreach ($envases as $envase) {
            $datos = new Controladores\EnvaseControlador();
            $dato = $datos->buscarEnvase($envase);
            array_push($envasesC, $dato);
        }

        $this->eliminarEnvases($id);
        $this->agregarEnvases($id, $envasesC);

    }

    //////////ENVASESXCERVEZAS///////////////

    public function agregarEnvases($id_cerveza, $envases){
        
        foreach ($envases as $envase) {
            $query = "INSERT INTO envasesxcervezas(id_cerveza, id_envase)
            VALUES (:id_cerveza, :id_envase);";

            $connection = new Connection();
            $pdo = $connection->connect();
            $command = $pdo->prepare($query);

            $idCerveza = $id_cerveza;
            $idEnvase = $envase->getId();

            $command->bindParam(':id_cerveza', $idCerveza);
            $command->bindParam(':id_envase', $idEnvase);
            
            $command->execute();
        }

    }

    public function listarEnvases($id_cerveza){
        
        $envaseControl = new Controladores\EnvaseControlador();
        $envase = new Modelos\Envase();
        
        $query = "SELECT id_envase FROM envasesxcervezas WHERE id_cerveza = :id;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':id', $id_cerveza);
        $command->execute();

        $lista = array();
        while ($row = $command->fetch()) {
            
            $idEnvase = $row['id_envase'];

            $envase = $envaseControl->buscarEnvase($idEnvase);
            
            array_push($lista, $envase);
        }
        
        return $lista;
    }

    public function eliminarEnvases($id_cerveza){

        $query = "DELETE FROM envasesxcervezas WHERE id_cerveza = :id;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':id', $id_cerveza);
        $command->execute();
    }

    public function litrosVendidos($fecha, $fechados){
        $query = "SELECT nombre, sum(volumen*cantidad) as litros from `tpbeer`.`cervezas` 
                inner join `tpbeer`.`linea_pedidos` on id_cerveza = cervezas.id
                inner join `tpbeer`.`envases` on id_envase = envases.id
                inner join `tpbeer`.`pedidos` on id_pedido = pedidos.id
                where fecha_entrega between :fecha AND :fechados
                group by cervezas.nombre ;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':fecha', $fecha);
        $command->bindParam(':fechados', $fechados);
        $command->execute();

        $lista = array();
        $litros = array();
        while ($row = $command->fetch()) {
            $cerveza = new Modelos\Cerveza();

            $nombre = $row['nombre'];
            $cerveza = $this->buscarXnombre($nombre);

            $litro = $row['litros'];

            array_push($lista, $cerveza);
            array_push($litros, $litro);

        }
        $final = array();
        array_push($final, $lista);
        array_push($final, $litros);        
        return $final;
    }

}