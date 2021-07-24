<div class="col ml-md-1  my-1  ">
    <h2 class="text-center text-light">Gestionar Carrito</h2>

<?PHP

if($productos):?>
    <table class="table table-dark bg-light mb-0 text-dark table-responsive-sm ">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Accion</th>
            </tr>
        </thead>

        <tbody>

            <?PHP
            $precioFinal=null;
             while($producto = mysqli_fetch_assoc($productos)):?>
                <tr>
                    <td class=" w-25 p-2">
                        <img class="img-fluid " src="<?= base_url ?>assets/img/products/<?= $producto['img'] ? $producto['img'] : 'logo'; ?>.png" alt="Product">
                    </td>                    
                    <td><?= $producto['nombre']?></td>
                    

                    <?PHP 
                        $count = null;
                        foreach($productNums as $key => $obj){
                            if($obj == $producto['id']){
                                $count ++;
                            }

                        }
                    ?>

                    <td><?=$count?></td>
                    <td>$<?= $producto['precio'] * $count ?></td>
                    <td>
                        <a href="<?= base_url?>trolley/delete&id=<?= $producto['id']?>" >Eliminar</a>
                        <a href="<?= base_url?>trolley/add&redirect=true&id=<?= $producto['id']?>" >Aumentar</a>
                    </td>

                </tr>
            <?PHP endwhile;?>


        </tbody>
        
    </table>

    <div class="col-12  bg-light mb-2 p-3">
        <p class="d-flex justify-content-between m-auto">
            <strong>Precio Final</strong>
            <strong>$<?= Utils::trolleyCash()?></strong>            
        </p>
    </div>

    <a href='<?=base_url?>trolley/destroy' class="btn btn-sm btn-outline-light ">Quitar Todos</a>
    <a href='<?=base_url?>order/create' class="btn btn-sm btn-outline-light ">Hacer Pedido</a>

<?PHP else:?>
    <div class="col-auto p-4 h-100 text-light m-0">
            <h2 class="text-light">Su carrito esta vacio</h2>
    </div>
<?PHP endif ?>


</div>