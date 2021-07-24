
<form action='<?= base_url?>order/save' method="POST"  class=" col form bg-dark text-light">
    <div class="col-10 col-sm-6 p-2  ">

    <div>
        <h2>A nombre de <?=$_SESSION['user']->nombre?></h2>
    </div>

    <label for="provincia">Provincia</label>
    <input type="text" class="form-control" name="provincia" >

    <label for="localidad">Localidad</label>
    <input type="text" class="form-control" name="localidad" >

    <label for="direccion">direccion</label>
    <input type="text" class="form-control" name="direccion" >

    <div>
        <strong>Coste : $<?= Utils::trolleyCash() ? Utils::trolleyCash():0?> </strong>
    </div>

        <input type="submit" class="btn d-block my-2 btn-outline-light btn-sm" value="Realizar pedido">
    </div>

    <div>
        <a href="<?=base_url?>trolley/index">Ver Productos del pedido</a>
    </div>

</form>

