<?PHP $NumProduct = 0;?>
<?PHP $NumOrder = null;?>


<div class="col ml-md-1  my-1  ">

<?PHP while($order = mysqli_fetch_assoc($orders)):?>

        <?PHP if($NumProduct === 0):?>
        <?PHP $NumProduct= 1 ?>

            <div class="col-auto p-2  text-light m-0">
                <h2>Descripcion de el Pedido</h2>
                <p>Su pedio estara en espera haste que envie el monto requirido con el identificador de la orden
                Su pago sera procesado y luego se enviara el pedido</p>
            </div>

            <div class="col-auto p-2  text-light m-0">

                <p class="my-1"><strong>Id de el pedido : </strong><?=$order['pedido_id']?></p>
                <p class="my-1"><strong>Provincia: </strong><?=$order['provincia']?></p>
                <p class="my-1"><strong>Localidad: </strong><?=$order['localidad']?></p>
                <p class="my-1"><strong>Direccion: </strong><?=$order['direccion']?></p>
                <p class="my-1"><strong>Precio Total: $</strong><?=$order['coste']?></p>
                <p class="my-1"><strong>Estado: </strong><?=$order['estado']?></p>
                <p class="my-1"><strong>Fecha: </strong><?=$order['fecha']?></p>

                <?PHP if(Utils::IsAdmin()):?>
                    <h4>Cambiar el estado de el pedido</h4>
                    <a href="<?=base_url?>order/update&id=<?=$order['id']?>&option=En espera " class='btn btn-primary btn-sm '>En espera</a>
                    <a href="<?=base_url?>order/update&id=<?=$order['id']?>&option=Preparando" class='btn btn-primary btn-sm'>Preparando</a>
                    <a href="<?=base_url?>order/update&id=<?=$order['id']?>&option=Enviando" class='btn btn-primary btn-sm'>Enviando</a>
                    <a href="<?=base_url?>order/update&id=<?=$order['id']?>&option=Completado" class='btn btn-primary btn-sm'>Completado</a>
                <?PHP endif?>
            </div>





            <table class="table table-dark bg-light mb-0 text-dark table-responsive-sm">
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Imagen</td>
                        <td>Precio</td>
                        <td>Unidades</td>
                    </tr>
                </thead>
                <tbody>
        <?PHP endif?>

        <?PHP $producto = mysqli_fetch_assoc(Utils::showProductByID($order['producto_id'])) ?>
                <tr>
                    <td><?=$producto['nombre']?></td>
                    <td class=" w-25 p-2">
                        <img class="img-fluid " style="max-width: 200px;" src="<?= base_url ?>assets/img/products/<?= $producto['img'] ? $producto['img'] : 'logo'; ?>.png" alt="Product">
                    </td>    
                    <td>$<?=$producto['precio']?></td>
                    <td><?=$order['unidades']?></td>
                </tr>


<?PHP endwhile?>
        </tbody>
</table>
</div>