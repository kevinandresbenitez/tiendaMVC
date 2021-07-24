<div class="col ml-md-1  my-1  ">
    <h2 class="text-center text-light">Gestionar Productos</h2>


    <table class="table table-dark table-responsive-sm">
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?PHP 
            
            while($product = mysqli_fetch_assoc($products)):?>
                <tr>
                    <td><?= $product['id']?></td>
                    <td><?= $product['nombre']?></td>
                    <td><?= $product['precio']?></td>
                    <td><?= $product['stock'] > 0 ? $product['stock']:'No hay Disponibles'?></td>
                    <td>
                        <a class="mx-1" href="<?= base_url?>product/delete&id=<?= $product['id']?>">Eliminar</a>
                        <a class="mx-1" href="<?= base_url?>product/edit&id=<?= $product['id']?>">Editar</a>
                    </td>
                </tr>
            <?PHP endwhile?>
        </tbody>
        
    </table>

    <a href='<?=base_url?>product/create' class="btn btn-sm btn-outline-light ">Agregar Producto</a>

</div>