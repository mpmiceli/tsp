
<body class="InitBody"> 
    <br><br>
    <div class="container">
    <table class="table table-sm">
        <thead>
        <tbody class="bg-dark" style="color: white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Precio</th>
                <th scope="col">Envases</th>
                <th scope="col">Imagen</th>
                <th scope="col">
                    <div class="trans text-center">
                        Modificar
                    </div>
                </th>
                <th scope="col">
                    <div class="trans text-center">
                        Eliminar
                    </div>
                </th>
            </tr>
        </tbody>
        </thead>
        <thead>
        <tbody style="color: black;">
            <?php foreach ($this->getListaCervezas() as $cerveza) : ?>
                <tr class="table-active">
                    <th>   
                        <?php echo $cerveza->getID(); ?>
                    </th> 
                    <th>   
                        <?php echo $cerveza->getNombre(); ?>
                    </th> 
                    <th>
                        <?php echo $cerveza->getDescripcion(); ?>
                    </th> 
                    <th>
                        <?php echo $cerveza->getPrecio(); ?>
                    </th> 
                    <th>
                        <ul>
                            <?php foreach ($cerveza->getEnvases() as $envase) :?>
                                <li><?php echo $envase->getDescripcion() ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </th>
                    <th>
                        <div class="trans text-center">
                            <img src="../<?php echo $cerveza->getImagen(); ?>" style="height:100px; width: 100px; ">
                        </div>
                    </th> 
                    <th>
                        <div class="trans text-center">
                            <a class="btn btn-warning btn-sm" href="modificar/<?php echo $cerveza->getId(); ?>">Modificar</a>
                        </div>
                    </th>
                    <th>
                        <div class="trans text-center">
                            <a class="btn btn-danger btn-sm" href="../cerveza/baja/<?php echo $cerveza->getId(); ?>">Eliminar</a>
                        </div>
                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </thead>
    </table>
    </div>