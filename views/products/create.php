<form action='<?= base_url?>product/save' method="POST" enctype="multipart/form-data" class=" col form bg-dark text-light">
    <div class="col-10 col-sm-6 p-2  ">
        <label for="product">Nombre</label>
        <input class="form-control form-control-sm " type="text" name="nombre" id="product" required>

        <label for="descripcion">Descripcion</label>
        <textarea id="descripcion" name="descripcion" cols="50" rows="5" required></textarea>

        <label for="precio">Precio</label>
        <input class="form-control form-control-sm " type="number" name="precio" id="precio" required>

        <div class="row  p-2 ">

            <div class="col-6 ">
                <label for="stock">Stock</label>
                <input class="form-control form-control-sm " type="number"  min="0" name="stock" id="stock" required>        
            </div>

            <div class="col-6 ">
                <label for="categoria">Categoria</label>

                <select id="categoria" name="categoria" class="form-control form-control-sm">
                    <?PHP $categorias = Utils::showCategory();?>
                    <?PHP while($categoria = mysqli_fetch_assoc($categorias)):?>                    
                        <option value="<?= $categoria['id']?>"><?= $categoria['nombre']?></option>
                    <?PHP endwhile?>
                </select>

            </div>

        </div>

        <label for="stock">Imagen</label>
        <input class="form-control form-control-sm " type="file" name="img" id="img" required>




        <input type="submit" class="btn d-block my-2 btn-outline-light btn-sm" value="Agregar">
    </div>
</form>