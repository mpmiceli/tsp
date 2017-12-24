<body class="InitBody"> 
    
    <?php
        $pedido = $_SESSION['PEDIDO'];
        $pedido->getLineaPedido();

        if (empty($pedido->getLineaPedido())) : ?>
            El carrito esta vacio...
        <?php else: ?>

            <br><br>
            <div class="container">
            <table class="table table-sm">
                <thead>
                <tbody class="bg-dark" style="color: white">
                    <tr>
                        <th scope="col">Cerveza</th>
                        <th scope="col">Envase</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">MontoParcial</th>
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
                    <?php for ($i=0; $i<count($lineas); $i++) { ?>
                        <tr class="table-active">
                            <td>   
                                <?php echo $lineas[$i]->getCerveza()->getNombre(); ?>
                            </td> 
                            <td>   
                                <?php echo $lineas[$i]->getEnvase()->getDescripcion(); ?>
                            </td> 
                            <td>
                                <?php echo $lineas[$i]->getCantidad(); ?>
                            </td> 
                            <td>
                                <?php echo $lineas[$i]->getPrecio(); ?>
                            </td>
                            <td>
                                <div class="trans text-center">
                                    <a class="btn btn-danger btn-sm" href="../pedido/eliminarLinea/<?php echo $i; ?>">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
                </thead>
            </table>
            </div>
            
            <center><h3>Monto total: <?php echo $pedido->getMontoFinal(); ?></h3></center><br>

            <div class="container">
                <table class="table table-sm"><tr><th>
                <center><br>
                <h2>Completar datos de entrega</h2><br>
                <form action="../pedido/finalizarPedido" method="post">

                    <label for="fecha_entrega"><strong><h5>Fecha de entrega: </h5></strong></label>
                    <input type="text" id="datepicker" name="fecha_entrega" />                

                    <br><br>
                            
                    <label for="tipo_entrega"><strong><h5>Tipo de entrega: </h5></strong></label>
                    
                    <br>
                    <input type="radio" name="tipo_entrega" id="radio_domicilio" value="1" checked="checked">
                    <label for="domicilio">Envio a Domicilio</label>
                    <select name="horario" id="envio-domicilio-horario">
                        <option value="0">
                            Ma&ntilde;ana (9 a.m. a 12 a.m.)
                        </option>
                        <option value="1">
                            Tarde (15 p.m. a 18 p.m.)
                        </option>
                    </select>

                    <br>
                    <input type="radio" name="tipo_entrega" id="radio_sucursal" value="0" >
                    <label for="tipo_entrega">Retiro de sucursal</label>
                    <select name="id_sucursal" id="envio-domicilio-direccion" disabled="disabled">
                        <?php foreach ($sucursales as $sucursal) : ?>
                            <option value="<?php echo $sucursal->getId()?>">
                                <?php echo $sucursal->getDireccion().' '.$sucursal->getNumero(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                           
                    <br><br>

                    <input type="submit" value="FINALIZAR COMPRA" >
                    <br><br>
                    
                </form>
                </center>
                </th></tr></table>
            </div>
            
            <script type="text/javascript">
                $(document).ready(function () {
                    var date = new Date();
                    var currentMonth = date.getMonth();
                    var currentDate = date.getDate();
                    var currentYear = date.getFullYear();

                    $('#datepicker').datepicker({
                        minDate: new Date(currentYear, currentMonth, currentDate),
                        dateFormat: 'yy-mm-dd'
                    });

                    $('#radio_sucursal').on('click', function(e) {
                        $('#envio-domicilio-horario').prop('disabled', true);
                        $('#envio-domicilio-direccion').prop('disabled', false);
                    });

                    $('#radio_domicilio').on('click', function(e) {
                        $('#envio-domicilio-direccion').prop('disabled', true);
                        $('#envio-domicilio-horario').prop('disabled', false);
                    });
                });
            </script>

        <?php endif; ?>

            
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php require_once 'footer.php'; ?>