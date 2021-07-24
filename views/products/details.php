<?PHP while ($producto = mysqli_fetch_assoc($productos)) : ?>

    <article class="col ml-md-1  my-1 ">
            <div class="row">
                <div class="col-8 mx-auto my-1 text-light ">
                <img class="card-img-top p-2" src="<?= base_url ?>assets/img/products/<?= $producto['img'] ? $producto['img'] : 'logo'; ?>.png" alt="Product">
                    <div class="card-body text-white">
                        <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                        <p class="card-text"><strong>Descripcion :</strong> <?= $producto['descripcion'] ?></p>
                        <p class="card-text"><strong>Precio :</strong> <?= $producto['precio'] ?></p>
                        <p ><strong>Stock :</strong> <?= $producto['stock'] > 0 ? $producto['stock']:'No hay Disponibles'?></p>
                        <?PHP if($producto['stock'] > 0 ):?>
                        <a href="<?= base_url ?>trolley/add&id=<?=$producto['id']?>" class="btn btn-primary " ?>Agregar al carrito</a>
                        <?PHP else :?>
                            <button class="btn btn-primary  disabled" disabled?>Agregar al carrito</a>
                        <?PHP endif?>                    
                    </div>
                </div>
            </div>
    </article> 
    
<?PHP endwhile ?>