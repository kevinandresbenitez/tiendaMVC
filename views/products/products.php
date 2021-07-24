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
    <?PHP break ?>
<?PHP endwhile ?>

<article class="col-12 ml-md-1  my-1 "">
        <h1 class=" text-light text-center mb-4">
            <?PHP 
                if(isset($categorias)){
                    $categoria = mysqli_fetch_assoc($categorias);
                }
                
                echo  isset($categoria) ? $categoria['nombre']:'Productos Destacados'
                
            ?>
        </h1>
    <div class="row justify-content-around">

        <?PHP while ($producto = mysqli_fetch_assoc($productos)) : ?>

            <div class="card mx-1 my-2" style="max-width: 15rem;">
                <a href="<?= base_url ?>product/showById&id=<?=$producto['id'] ?>" class=" btn-outline-light border-sm  p-1">
                    <img class="card-img-top p-2" src="<?= base_url ?>assets/img/products/<?= $producto['img'] ? $producto['img'] : 'logo'; ?>.png" alt="Product">            
                </a>

                <div class="card-body ">
                    <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                    <p ><strong>Precio :</strong> <?= $producto['precio'] ?></p>
                    <p ><strong>Stock :</strong> <?= $producto['stock'] > 0 ? $producto['stock']:'No hay Disponibles'?></p>
                    
                    <?PHP if($producto['stock'] > 0 ):?>
                     <a href="<?= base_url ?>trolley/add&id=<?=$producto['id']?>" class="btn btn-primary btn-sm" ?>Agregar al carrito</a>
                    <?PHP else :?>
                        <button class="btn btn-primary btn-sm disabled" disabled?>Agregar al carrito</a>
                    <?PHP endif?>


                </div>
            </div>

        <?PHP endwhile ?>

    </div>
</article>