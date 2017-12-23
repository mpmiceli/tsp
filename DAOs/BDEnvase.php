<?php

namespace DAOs;

use Config\Singleton;
use Config\Connection;

use Modelos;

class BDEnvase extends Singleton
{
    public function agregar($envase)
    {
        $query = "
            INSERT INTO envases(volumen, factor, descripcion, imagen, activo)
            VALUES (:volumen, :factor, :descripcion, :imagen, :activo);
        ";

        $connection = new Connection();
        $pdo = $connection->connect();
        
        $command = $pdo->prepare($query);

        $volumen = $envase->getVolumen();
        $factor = $envase->getFactor();
        $descripcion = $envase->getDescripcion();
        $imagen = $envase->getImagen();
        if (is_null($imagen)) {
            $imagen = '';
        }
        $activo = $envase->getActivo();

        $command->bindParam(':volumen', $volumen);
        $command->bindParam(':factor', $factor);
        $command->bindParam(':descripcion', $descripcion);
        $command->bindParam(':imagen', $imagen);
        $command->bindParam(':activo', $activo, \PDO::PARAM_INT);

        $command->execute();
    }

    public function getLista()
    {
        $query = " SELECT * FROM envases WHERE activo = 1;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->execute();

        $lista = array();
        while ($row = $command->fetch()) {
            $envase = new Modelos\Envase();

            $envase->setId($row['id']);
            $envase->setVolumen($row['volumen']);
            $envase->setFactor($row['factor']);
            $envase->setDescripcion($row['descripcion']);
            $envase->setImagen($row['imagen']);

            array_push($lista, $envase);
        }

        return $lista;
    }

    public function eliminar($id){

        $query = " UPDATE envases SET activo = 0
            WHERE id = :id;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':id', $id);
        $command->execute();
    }

    public function buscar($id){

        $query = "SELECT * FROM envases WHERE id = :id;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':id', $id);
        $command->execute();

        $row = $command->fetch();

        $envase = new Modelos\Envase();
        $envase->setId($row['id']);
        $envase->setVolumen($row['volumen']);
        $envase->setFactor($row['factor']);
        $envase->setDescripcion($row['descripcion']);
        $envase->setImagen($row['imagen']);

        return $envase;
    }

    public function buscarXdescripcion($descripcion){

        $query = "SELECT * FROM envases WHERE descripcion = :descripcion AND activo = 1;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':descripcion', $descripcion);
        $command->execute();

        $row = $command->fetch();

        $envase = new Modelos\Envase();
        $envase->setId($row['id']);
        $envase->setVolumen($row['volumen']);
        $envase->setFactor($row['factor']);
        $envase->setDescripcion($row['descripcion']);

        return $envase;
    }

    public function buscarPorVolumen($volumen){

        $query = "
            SELECT *
            FROM envases
            WHERE volumen = :volumen;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':volumen', $volumen);
        $command->execute();

        $row = $command->fetch();
        
        return $this->cargarModelo($row);
    }

    protected function cargarModelo($row)
    {
        if (!empty($row)) {
            $envase = new Modelos\Envase();
            $envase->setId($row['id']);
            $envase->setVolumen($row['volumen']);
            $envase->setFactor($row['factor']);
            $envase->setDescripcion($row['descripcion']);
            $envase->setActivo($row['activo']);

            return $envase;
        } else {
            return null;
        }
    }
    
    public function modificar($id, $parametros, $foto){
        $query = "
            UPDATE envases
            SET volumen = :volumen, factor = :factor, descripcion = :descripcion, activo = :activo
            WHERE id = :id;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $volumen = $parametros['volumen'];
        $factor = $parametros['factor'];
        $descripcion = $parametros['descripcion'];
        $activo = $parametros['activo'];
        
        $command->bindParam(':id', $id);
        $command->bindParam(':volumen', $volumen);
        $command->bindParam(':factor', $factor);
        $command->bindParam(':descripcion', $descripcion);
        $command->bindParam(':activo', $activo);
        
        // Aca actualizo la imagen nomas
        if (!is_null($foto)){
            $query = "UPDATE envases SET imagen = :imagen WHERE id = :id;";
            $command = $pdo->prepare($query);
            $command->bindParam(':id', $id);
            $command->bindParam(':imagen', $foto);
            $command->execute();
        }

        $command->execute();
    }
}