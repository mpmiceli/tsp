<?php

namespace DAOs;

use Config\Singleton;
use Config\Connection;

use Modelos;

class BDSucursal extends Singleton 
{
    public function agregar($sucursal)
    {
        $query = "
            INSERT INTO sucursales (direccion, numero)
            VALUES (:direccion, :numero)
        ";

        $connection = new Connection();
        $pdo = $connection->connect();
        
        $command = $pdo->prepare($query);

        $direccion = $sucursal->getDireccion();
        $numero = $sucursal->getNumero();
        

        $command->bindParam(':direccion', $direccion);
        $command->bindParam(':numero', $numero);
        
        $command->execute();
    }

    public function getLista()
    {
        $query = "SELECT * FROM sucursales WHERE activo = 1;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->execute();

        $lista = array();
        while ($row = $command->fetch()) {
            $sucursal = new Modelos\Sucursal();

            $sucursal->setId($row['id']);
            $sucursal->setDireccion($row['direccion']);
            $sucursal->setNumero($row['numero']);

            array_push($lista, $sucursal);
        }

        return $lista;
    }

    public function eliminar($id){

        $query = " UPDATE sucursales SET activo = 0
            WHERE id = :id;";


        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':id', $id);
        $command->execute();
    }

    public function buscar($id){

        $query = "SELECT * FROM sucursales WHERE id = :id;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':id', $id);
        $command->execute();

        $row = $command->fetch();

        $sucursal = new Modelos\Sucursal();
        $sucursal->setId($row['id']);
        $sucursal->setDireccion($row['direccion']);
        $sucursal->setNumero($row['numero']);

        return $sucursal;
    }

    public function modificar($id, $parametros){
        $query = "
            UPDATE sucursales
            SET
                direccion = :direccion,
                numero = :numero,
                activo = :activo

            WHERE id = :id;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $direccion = $parametros['direccion'];
        $numero = $parametros['numero'];
        $activo = $parametros['activo'];

        $command->bindParam(':id', $id);
        $command->bindParam(':direccion', $direccion);
        $command->bindParam(':numero', $numero);
        $command->bindParam(':activo', $activo);
        
        $command->execute();
    }

    public function buscarPorDireccionCompleta($direccion, $numero) {
        
        $query = "
            SELECT *
            FROM sucursales
            WHERE direccion = :direccion AND numero = :numero;";

        $connection = new Connection();
        $pdo = $connection->connect();
        $command = $pdo->prepare($query);

        $command->bindParam(':direccion', $direccion);
        $command->bindParam(':numero', $numero);

        $command->execute();

        $row = $command->fetch();

        return $this->cargarModelo($row);           
    }

    protected function cargarModelo($row) {
        
        if ($row) {
            $sucursal = new Modelos\Sucursal();
            $sucursal->setId($row['id']);
            $sucursal->setDireccion($row['direccion']);
            $sucursal->setNumero($row['numero']);
            $sucursal->setActivo($row['activo']);
            return $sucursal;
        }
        
        return null;   
    }
}