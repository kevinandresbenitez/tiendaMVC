<div class="col ml-md-1  my-1  ">
    <h2 class="text-center text-light">Gestionar Categorias</h2>


    <table class="table table-dark table-responsive-sm">
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Accion</th>
            </tr>
        </thead>

        <tbody>
            <?PHP 
            
            while($categoria = mysqli_fetch_assoc($categorias)):?>
                <tr>
                    <td><?= $categoria['id']?></td>
                    <td><?= $categoria['nombre']?></td>
                    <td><a href="<?= base_url?>category/delete&id=<?= $categoria['id']?>" >Eliminar</a></td>
                </tr>
            <?PHP endwhile?>
        </tbody>
        
    </table>

    <a href='<?=base_url?>category/create' class="btn btn-sm btn-outline-light ">Crear Categoria</a>

</div>