<?php
use DB\Connexion\Connexion;

function getMaxIdCoordonnees($objet)
{
    $sql = "SELECT MAX(idCoordonnees) FROM coordonnees";
    $stmt = Connexion::getInstance()->prepare($sql);
    $idCoordonnees = $objet->getIdCoordonnees();
    $stmt->bindParam(':idCoordonnees', $idCoordonnees);
    $stmt->execute();
}

?>