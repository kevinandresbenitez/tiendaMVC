<aside class="col-10 col-sm-8 col-md-4 mx-auto ml-md-0 mr-md-1 p-0 position-sticky bg-info h-100" style="max-width: 350px;">
    <?PHP if (!Utils::IsUser()) : ?>

        <form action="<?=base_url ?>user/login" method="POST" class="form-group bg-light m-1 p-2 ">
            <h3>Iniciar sesion</h3>
            <label for="email_login" class="m-0">
                <p>Email</p>
            </label>
            <input type="email" name="email" id="email_login" required class="form-control  form-control-sm">

            <label for="password_login" class="m-0">
                <p>Contraseña</p>
            </label>
            <input type="password" name="contrasena" id="password_login" required class="form-control form-control-sm">

            <div class="d-flex">
                <input type="submit" value="Ingresar" class="btn btn-sm mx-auto my-2 btn-success text-light border border-primary rounded-0">
            </div>
        </form>

        <form action="<?=base_url ?>user/save" method="POST" class="form-group bg-light mx-1 my-2 p-2">
            <h3>Registrarse</h3>

            <label for='nombre'>Nombre</label>
            <input type="text" name="nombre" required id="nombre" class="form-control  form-control-sm">

            <label for="email_register" class="m-0">
                <p>Email</p>
            </label>
            <input type="email" name="email" required id="email_register" class="form-control  form-control-sm">

            <label for="password_register" class="m-0">
                <p>Contraseña</p>
            </label>
            <input type="password" name="contrasena" required id="password_register" class="form-control form-control-sm">

            <div class="d-flex">
                <input type="submit" value="Registrarse" class="btn btn-sm mx-auto my-2 btn-success text-light border border-primary rounded-0">
            </div>
        </form>

    <?PHP elseif (Utils::IsUser()) : ?>

        <div class="bg-light mx-1 my-2 p-2">
            <h2>Bienvenido <?= $_SESSION['user']->nombre?></h2>
        </div>


        <div class="form-group bg-light mx-1 my-2 p-2">
            <h3>Configuraciones</h3>
            <ul>
                <?PHP if(Utils::IsAdmin()):?>
                    <li><a href="<?=base_url?>order/index">Gestionar Pedidos</a></li>
                    <li><a href="<?=base_url?>category/index">Gestionar Categorias</a></li>
                    <li><a href="<?=base_url?>product/index">Gestionar Productos</a></li>
                <?PHP endif?>
                <li><a href="<?=base_url?>order/show">Mis Pedidos</a></li>
                <li><a href="<?=base_url?>user/logout">Cerrar Sesion</a></li>
            </ul>
        </div>
    <?PHP endif ?>

    <div class="form-group bg-light mx-1 my-2 p-2">
            <h3>Carrito</h3>
            <ul>
                <li><a href="<?= base_url?>trolley/index">Carrito</a></li>
                <li>Productos en el Carrito <strong><?= Utils::trolleyCount() ?  Utils::trolleyCount() : 0 ?></strong></li>
                <li>Total a pagar <strong>$<?= Utils::trolleyCash() ?  Utils::trolleyCash(): 0 ?></strong> </li>
            </ul>
        </div>


</aside>