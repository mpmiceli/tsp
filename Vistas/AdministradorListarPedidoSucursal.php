<body class="InitBody"> 
    <br><br>
    <center><h2>Sucursal: <?php echo $sucursal->getDireccionCompleta(); ?></h2></center>
    <?php $i = 1; ?>
    <?php foreach ($listaPedidos as $pedido) { ?>
    <br><br>
    <center><label><h2>Pedido <?php echo $i; ?> - Monto: $<?php echo $pedido->getMontoFinal() ?> - Cliente: <?php echo $pedido->getUsuario()->getUsername() ?></h2></label></center>
    <div class="trans text-center">
        <a class="btn btn-danger btn-sm align-center" href="<?php echo HOST; ?>/pedido/eliminarPedido/<?php echo $pedido->getId(); ?>">Eliminar</a>
    </div><br>
    <div class="container">
    <table class="table table-sm"><tr><th>
    <center>

        <label><b>Fecha Entrega:</b> </label>
        <?php echo $pedido->getFechaEntrega(); ?>
        <br>

        <?php $estados = array('Solicitado', 'Procesado', 'Enviado', 'Finalizado'); ?>
        
        <label><b>Estado:</b> </label>
        <?php echo $estados[$pedido->getEstado()]; ?>
        <br>

        <form action="../pedido/modificarEstadoSucursal" method="post">
            <input type="hidden" name="id" value="<?php echo $pedido->getId(); ?>" >
            <input type="hidden" name="sucursal" value="<?php echo $sucursal->getId(); ?>" >
            <label for="estado"><strong><h5>Cambiar estado: </h5></strong></label>

            <?php
                foreach($estados as $id => $estado) : ?>
                    <input
                        type="radio"
                        name="estado"
                        value="<?php echo $id; ?>"
                        <?php if ($id == $pedido->getEstado()) : ?>
                            checked="checked"
                        <?php endif; ?>

                        <?php if ($id < $pedido->getEstado()) : ?>
                            disabled="disabled"
                        <?php endif; ?>
                    />
                    <label for="<?php echo $estado; ?>"><?php echo $estado; ?></label>
            <?php endforeach; ?>
            <input type="submit" value="Cambiar" >
        </form>


        <label><b>Tipo Entrega:</b> </label>
        <?php if ($pedido->getTipoEntrega() == 0) : ?>
            Retira de sucursal
        <?php else : ?>
            Envio a domicilio
        <?php endif; ?>
        <br>
    </center>
    </th></tr></table>
    <div class="container">
    <table class="table table-sm">
        <thead>
        <tbody class="bg-dark" style="color: white">
            <tr>
                <th scope="col">Cerveza</th>
                <th scope="col">Envase</th>
                <th scope="col">Cantidad</th>
                <th scope="col">MontoParcial</th>
            </tr>
        </tbody>
        </thead>
        <thead>
        <tbody style="color: black;">
            <?php foreach ($pedido->getLineaPedido() as $linea) { ?>
                <tr class="table-active">
                    <th>   
                        <?php echo $linea->getCerveza()->getNombre(); ?>
                    </th> 
                    <th>   
                        <?php echo $linea->getEnvase()->getDescripcion(); ?>
                    </th> 
                    <th>
                        <?php echo $linea->getCantidad(); ?>
                    </th> 
                    <th>
                        <?php echo $linea->getPrecio(); ?>
                    </th>
                </tr>
            <?php }; ?>
        </tbody>
        </thead>
    </table>
    </div>
<?php $i = $i + 1; }; ?>