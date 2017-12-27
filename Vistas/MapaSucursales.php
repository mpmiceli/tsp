<center>
<?php foreach ($sucursales as $sucursal) : ?>
    <div style="padding: 20px; float: left; margin: 65px;" >
    <iframe
            width="500"
            height="450"
            frameborder="0"
            style="border:0"
            src="https://www.google.com/maps/embed/v1/place?q=Mar%20del%20Plata%2C%20Buenos%20Aires%20Province%2C%20Argentina%2C%20<?php echo $sucursal->getDireccion() ?>%20<?php echo $sucursal->getNumero() ?>&key=AIzaSyDQZKF8KTubT-wl6lnH9x4D1yAnHjcxZAw" allowfullscreen></iframe>
</div>

<?php endforeach; ?>
</center>

