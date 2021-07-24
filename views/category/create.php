<form action='<?= base_url?>category/save' method="POST" class=" col form bg-dark text-light">
    <div class="col-10 col-sm-6 p-2  ">
        <label for="category">Nombre</label>
        <input class="form-control form-control-sm " type="text" name="nombre" id="category" required>


        <input type="submit" class="btn d-block my-2 btn-outline-light btn-sm" value="Agregar">
    </div>
</form>