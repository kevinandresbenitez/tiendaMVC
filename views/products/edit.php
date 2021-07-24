<?PHP $producto =  mysqli_fetch_assoc($productos)?>


<form action="<?= base_url?>product/update&id=<?= $producto['id']?>" method="POST" enctype="multipart/form-data" class=" col form bg-dark text-light">
    <div class="col-10 col-sm-6 p-2  ">
        <label for="product">Nombre</label>

        <input class="form-control form-control-sm " value="<?= $producto['nombre']?>" type="text" name="nombre" id="product" required>

        <label for="descripcion">Descripcion</label>
        <textarea id="descripcion" name="descripcion" cols="50" rows="5" required> <?= $producto['descripcion']?></textarea>


        <label for="precio">Precio</label>
        <input class="form-control form-control-sm " value="<?= $producto['precio']?>" type="number" name="precio" id="precio" required>

        <div class="row  p-2 ">

            <div class="col-6 ">
                <label for="stock">Stock</label>
                <input class="form-control form-control-sm " value="<?= $producto['stock']?>" type="number"  min="0" name="stock" id="stock" required>        
            </div>

            <div class="col-6 ">
                <label for="categoria">Categoria</label>

                <select id="categoria" name="categoria" class="form-control form-control-sm">
                    <?PHP $categorias = Utils::showCategory();?>
                    <?PHP while($categoria = mysqli_fetch_assoc($categorias)):?>   

                        <?PHP if ($categoria['id'] == $producto['categoria_id']):?>

                            <option value="<?= $categoria['id']?>" selected ><?= $categoria['nombre']?></option>

                        <?PHP else :?>


                            <option value="<?= $categoria['id']?> " > <?= $categoria['nombre']?></option>
                            
                        <?PHP endif?>

                    <?PHP endwhile?>
                </select>

            </div>

        </div>

        <label for="stock">Imagen</label>
        <img class="img-fluid my-2" src="<?= base_url ?>assets/img/products/<?= $producto['img'] ? $producto['img'] : 'logo'; ?>.png" alt="Product">
        <input class="form-control form-control-sm " type="file" name="img" id="img" >




        <input type="submit" class="col-6  offset-3 btn d-block my-2 btn-outline-light btn-sm" value="Actualizar">
        <a href="<?= base_url?>product/index" class="col-6 offset-3 btn d-block my-2 btn-outline-light btn-sm ">Cancelar</a>
    </div>
</form>



<?PHP if ($categoria['id'] == $producto['categoria_id']):?>

<option value="<?= $categoria['id']?> selected "><?= $categoria['nombre']?></option>

<?PHP else :?>


<option value="<?= $categoria['id']?> " > <?= $categoria['nombre']?></option>

<?PHP endif?>