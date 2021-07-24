<div class="col ml-md-1  my-1  ">



    <div class="col ">
        <?PHP if (isset($_SESSION['confirmation']) && $_SESSION['confirmation']) : ?>
            <?PHP unset($_SESSION['confirmation']) ?>
            <div class="col-auto p-2 h-100 text-light">
                <h1>Tu pedido a sido registrado correctamente</h1>
                <p>Este estara en espera hasta que se realize el deposito , una vez echo se enviara</p>
            </div>
        <?PHP endif ?>

        <div class="col-auto p-2 h-100 text-light m-0">
            <h2>Pedidos</h2>
            <p>Su pedio estara en espera haste que envie el monto requirido con el identificador de la orden
                Su pago sera procesado y luego se enviara el pedido</p>
        </div>
    </div>





    <?PHP if($orders): ?>
    <div class="col-12    my-1  text-light">
        <?PHP $numOrder = null; ?>
        <?PHP $numorderUser = null; ?>

        <div class="col ml-md-1  my-1  ">
            <h2 class="text-center text-light table-responsive-sm">Mis Pedidos</h2>


            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Precio</th>
                        <th>Fecha</th>
                        <th>Accion</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody>
                    <?PHP
                    $ProductoId = null;
                    while ($order = mysqli_fetch_assoc($orders)) : ?>

                        <?PHP if ($ProductoId != $order['id']) : ?>
                            <?PHP $ProductoId = $order['id'] ?>
                            <tr>
                                <td><?= $order['id'] ?></td>
                                <td><?= $order['coste'] ?></td>
                                <td><?= $order['fecha'] ?></td>
                                <td><a href="<?= base_url ?>order/details&id=<?= $order['id'] ?>">Detalles</a></td>
                                <td><?= $order['estado'] ?></td>
                            </tr>
                        <?PHP endif ?>

                    <?PHP endwhile; ?>
                </tbody>

            </table>
        </div>
    </div>

    <?PHP else:?>
        <div class="col-auto p-4 h-100 text-light m-0">
            <h2 class="text-light">No hay pedidos</h2>
        </div>
    <?PHP endif?>
</div>
</div>