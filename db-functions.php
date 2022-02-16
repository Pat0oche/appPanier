<?php

function connexion() {
    $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::MYSQL_ATTR_INIT_COMMAND   => 'SET NAMES utf8',
    ];

    try {
        $bdd = new PDO ('mysql:host=localhost; dbname=store; charset=utf8', 'root', '', $options);
        return $bdd;
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }  
}

function findAll() {  
    $reponse = connexion()->query("SELECT * FROM product");
	return $reponse -> fetchAll();
}

function findOneById($id) {
    $reponse = connexion()->prepare("SELECT * FROM product WHERE id=:id");
    $reponse->bindParam("id", $id, PDO::PARAM_INT);
    $reponse->execute();
	return $reponse -> fetch(PDO::FETCH_ASSOC);
}

function insertProduct($name, $descr, $price) {
    $conn = connexion();
    $requete= $conn-> prepare("INSERT INTO product 
                                        (name, description, price) 
                                        VALUES 
                                        (:name, :descr, :price)");
                
    $requete->bindParam(':name', $name, PDO::PARAM_STR);
    $requete->bindParam(':descr', $descr, PDO::PARAM_STR);
    $requete->bindParam(':price', $price, PDO::PARAM_STR);
    
    $requete->execute();
    
    return $conn->lastInsertId();
}