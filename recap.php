<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Récapitulatif des produits</title>
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
        <div class="row text-center">
            <h1>Récapitulatif des produits</h1>
        </div>
        <div class="row mt-5">

    <?php 
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])) {
            echo "<p>Aucun produit en session...</p>";
        } else {
            echo "<table class='table table-striped text-center'>",            
                    "<thead>",
                        "<tr>",
                            "<th>#</th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            '<th>Quantité</th>',
                            "<th class='text-end'>Total</th>",
                            '<th>Supprimer</th>',
                    "</tr>",
                "</thead>",
                "<tbody>";
            $totalGeneral = 0; 
            foreach($_SESSION['products'] as $index => $product) {
                if ($product['qtt'] < 10) {
                    $product['qtt'] = '0'.$product['qtt'];
                }
                echo "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product['name']."</td>",
                        "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        '<td><a type="button" href="traitement.php?action=rem&id='.$index.'" class="btn btn btn-outline-dark me-2">-</a>'.$product['qtt'].'<a type="button" href="traitement.php?action=add&id='.$index.'" class="btn btn btn-outline-dark ms-2">+</a></td>',
                        "<td class='text-end'>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        '<td><a type="button" href="traitement.php?action=del&id='.$index.'" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a></td>',
                        "</tr>";
            $totalGeneral += $product['total'];
            }

            echo "<tr>",
                        "<td class='fw-bold text-start' colspan=4>Total général : </td>",
                        "<td class='text-end'><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                        "<td></td>",
                        "</tr>",
                "</tbody>",
            "</table>";
        }
        // echo "<pre>";
        // var_dump($_SESSION['products']);
        // echo"</pre>";
    ?>

        </div>
                <div class="row mt-5 text-center">
                    <a type="button" href="traitement.php?action=clear" class="btn btn-danger">Vider le panier</a>
                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>