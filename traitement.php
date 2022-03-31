<?php
session_start();

require 'db-functions.php';

if(isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $descr = filter_input(INPUT_POST, "descr", FILTER_DEFAULT);

    if($name && $price && $descr) {
        $lastId = insertProduct($name, $descr, $price);
        echo $lastId;
        $_SESSION['msg'] = "Produit ajouté !";
        header("Location:admin.php");
        die;
    } else {
        $_SESSION['msg'] = "Formulaire mal rempli !";
    }

} 

else if (isset($_GET['action'])){
    switch ($_GET['action']) {
      
        case "del":
            if (isset($_GET['id'])) { 
                $_SESSION['msg'] = "Les <strong>".$_SESSION['products'][$_GET['id']]["name"]."</strong> ont été supprimés du panier";
                unset($_SESSION['products'][$_GET['id']]);
            }
            header("Location:recap.php");
            die;
        break;
        
        case "clear":
            $_SESSION['msg'] = "Tous les produits ont été supprimés du panier";
            unset($_SESSION['products']);
        break;

        case "add":
            if (isset($_GET['id'])) { 
                $_SESSION['products'][$_GET["id"]]["qtt"]++;
                $_SESSION['products'][$_GET["id"]]["total"] = $_SESSION['products'][$_GET["id"]]["price"]*$_SESSION['products'][$_GET["id"]]["qtt"];
            }
            header("Location:recap.php");
            die;
        break;

        case "rem":
            if (isset($_GET['id'])) { 
                $_SESSION['products'][$_GET["id"]]["qtt"]--;
                $_SESSION['products'][$_GET["id"]]["total"] = $_SESSION['products'][$_GET["id"]]["price"]*$_SESSION['products'][$_GET["id"]]["qtt"];
            }
            header("Location:recap.php");
            die;
        break;

        case "addCart":
            if (isset($_GET['id'])) { 

                $product = findOneById($_GET['id']);
                $name = $product['name'];
                $price = $product['price'];
                $qtt = 1;

            if($name && $price && $qtt) {
                $product = [
                    "name" => $name,
                    "price" => $price,
                    "qtt" => $qtt,
                    "total" => $price*$qtt,
                ];

                $_SESSION['products'][] = $product;
                $_SESSION['msg'] = "Produit ajouté !";
            }
    else $_SESSION['msg'] = "Formulaire mal rempli !";
            }
            header("Location:recap.php");
            die;
        break;
    }
}
else $_SESSION['msg'] = "Casse-toi, sale pirate du dimanche !";



header("Location:index.php");
