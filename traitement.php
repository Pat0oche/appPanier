<?php
session_start();

if(isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

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

} else if (isset($_GET['action'])){
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
    }
}
else $_SESSION['msg'] = "Casse-toi, sale pirate du dimanche !";



header("Location:index.php");
