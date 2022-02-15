<?php
    session_start();

    require('functions.php');

    if(isset($_SESSION['msg'])) {
        echo "<script>
        window.addEventListener('load', ()=>{
            myModal.show();
        }) 
        </script>";
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
    <link rel="stylesheet" href="style.css">
    <title>Ajout produit</title>
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
        <h1 class="text-center">Ajout produit</h1>
        <form action="traitement.php" method="post" class="text-center mt-5">
            <p>
                <label class="form-label">Nom du produit :
                    <input type="text" class="form-control" name="name">
                </label>
            </p>
            <p>
                <label class="form-label">Prix du produit :
                    <input type="number" class="form-control" step="any" name="price">
                </label>
            </p>
            <p>
                <label class="form-label">Description :
                    <textarea class="form-control" name="descr" rows="3"></textarea>
                </label>
            </p>
            <p>
                <input type="submit" class="btn btn-outline-dark" name="submit" value="Ajouter le produit">
            </p>
        </form>
    </div>
    </div>
    <div class="modal" id="myModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yop !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><?php
                    echo afficherMsg();
                    unset($_SESSION['msg']);?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'))
    </script>
</body>

</html>