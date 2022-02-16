<?php

session_start();

require 'db-functions.php';
require 'functions.php';

if(isset($_GET['produit'])) {
    $product=findOneById($_GET['produit']);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title><?=$product['name'] ?? null ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark py-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Appli</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="recap.php">Récapitulatif</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto me-3">
                    <li class="nav-item">

                        <a type="button" class="btn btn-light position-relative" href="recap.php">
                            <i class="bi bi-cart-fill"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                <?php
                                if(isset($_SESSION['products'])) {
                                    echo count($_SESSION['products']);
                                } else {
                                    echo '0';
                                }
                                ?>
                                <span class="visually-hidden">Articles dans le panier</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <a href="index.php">Retour</a>
        <h1 class="text-center"><?=$product['name']?></h1>
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title display-2"><?=$product['name']?></h5>
                        <p class="card-text"><?=$product['description']?></p>
                        <p class="card-text h2 text-danger"><?=number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€"?></p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="traitement.php?action=addCart&id=<?=$product['id']?>" type="button" class="btn btn-outline-dark">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>