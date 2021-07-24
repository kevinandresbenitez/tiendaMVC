<!DOCTYPE html>
<html lang="ex">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url ?>public/styles/bootstrap-4.0.0/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url ?>public/styles/fondo.php">

    <!-- Fondo de pantalla en el body  -->
    <?PHP require_once('./public/styles/fondo.php') ?>

</head>

<body class="text-light">


    <nav class="navbar container px-0 mb-2">

        <div class="col-12 py-2 d-flex bg-dark align-items-center">
            <img src="<?= base_url ?>/assets/img/logo.png" class="d-none d-md-block" style="max-width:150px;" alt="">
            <h2>Tienda de camisetas</h2>
        </div>

        <ul class="col-12 nav justify-content-center d-flex bg-info p-2">
            <li class="nav-item "><a href="<?= base_url ?>" class=" mx-2 my-2 btn-success text-light nav-link  ">Inicio</a></li>
            <?PHP 
                $navbar_item = Utils::showCategory();                            
                while ($item = mysqli_fetch_assoc($navbar_item)) : ?>
                    <li class="nav-item"><a href="<?= base_url ?>product/showByCategory&id=<?= $item['id']?>" class=" mx-2 my-2 btn-success text-light nav-link "><?= $item['nombre'] ?></a></li>
                <?PHP endwhile 
            ?>

        </ul>
    </nav>

    <div class="container text-dark my-2">
        <div class="row">