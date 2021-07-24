<div class="col ml-md-1  my-1  ">
    <h2 class="text-center text-light">Gestionar Pedidos</h2>

<?PHP if($orders):?>
    <table class="table table-dark table-responsive-sm ">
        <thead>
            <tr>
                <th>id</th>
                <th>Precio</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?PHP 
            $ProductoId = null;
            while ($order = mysqli_fetch_assoc($orders)) : ?>

                <?PHP if($ProductoId != $order['id']):?>
                    <?PHP $ProductoId = $order['id']?>
                    <tr>
                        <td><?= $order['id']?></td>
                        <td>$<?= $order['coste']?></td>
                        <td><?= $order['fecha']?></td>
                        <td><a href="<?=base_url ?>order/details&id=<?= $order['id']?>">Detalles</a></td>
                        <td><?= $order['estado']?></td>
                    </tr>            
                <?PHP endif?>

            <?PHP endwhile; ?>
        </tbody>
        
    </table>
<?PHP else:?>
    <h2 class='text-light'>No hay Pedidos</h2>    
<?PHP endif?>
</div>