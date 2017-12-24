<body class="InitBody"> 
        <br><br>
        <div class="container">
        <table class="table table-sm">
            <thead>
            <tbody class="bg-dark" style="color: white">
                <tr>
                    <th scope="col" style="text-align:center;"></th>
                    <th scope="col" style="text-align:left;">Descripcion</th>
                    <th scope="col" style="text-align:center;">Precio x Litro</th>
                    <th scope="col" style="text-align:center;">Precio x Presentacion</th>
                    <th scope="col" style="text-align:center;">
                        <div class="trans text-center">Cantidad</div>
                    </th>
                    <th scope="col" style="text-align:center;"></th>
                </tr>
            </tbody>
            </thead>
            <thead>
            <tbody style="color: black;">
                <?php
                foreach ($datos->getListaCervezas() as $cerveza) : ?>
                    <form action="../pedido/agregarLinea" method="post">
                    <input type="hidden" name="cerveza" value="<?php echo $cerveza->getId(); ?>" >
                    <tr class="table-active">
                        <td>   
                            <div class="trans text-center">
                                <img src="../<?php echo $cerveza->getImagen(); ?>" style="height:100px; width: 100px; ">
                            </div>
                        </td> 
                        <td>
                            <b><?php echo $cerveza->getNombre(); ?></b>
                            <br>
                            <?php echo $cerveza->getDescripcion(); ?>
                        </td>
                        <td style="text-align:center;">
                            $<?php echo $cerveza->getPrecio(); ?>
                        </td> 
                        <td>
                            <div class="trans text-center">
                                <select name="envase">
                                <?php foreach ($cerveza->getEnvases() as $envase) : ?>
                                    <option value="<?php echo $envase->getId(); ?>">
                                        <?php echo $envase->getDescripcion(); ?> ($<?php echo $cerveza->calcularPrecio($envase); ?>)
                                    </option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="trans text-center">
                                <input type="number" name="cantidad" min="1" max="20" required>
                            </div>
                        </td>
                        <td>
                            <div class="trans text-center">
                                <button type="submit" class="btn btn-success" style="color:black;">Agregar</button>
                            </div>
                        </td>
                    </tr>
                    </form>
                <?php endforeach; ?>
            </tbody>
            </thead>
        </table>
        </div>