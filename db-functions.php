<?php

function connexion() {
    $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::MYSQL_ATTR_INIT_COMMAND   => 'SET NAMES utf8',
    ];

    try {
        $bdd = new PDO ('mysql:host=localhost; dbname=appli; charset=utf8', 'root', '', $options);
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
    $reponse = connexion()->query("SELECT * FROM product WHERE id='".$id."'");
	return $reponse -> fetch();
}

function insertProduct($name, $descr, $price) {
    $requete= connexion()-> prepare("INSERT INTO product VALUES (NULL,
                                                     :name,
                                                     :descr,
                                                     :price,)
                                                     ");
                
                $requete->bindParam(':name', $name, PDO::PARAM_STR);
                $requete->bindParam(':descr', $descr, PDO::PARAM_STR);
                $requete->bindParam(':price', $price, PDO::PARAM_INT);
                
                $requete->execute();
}