<?php

include ("../../db/Daos.php");
include ("../../metier/jeux/jeux.php");
include ("../../metier/adherent/adherents.php");

use Adherent\Coordonnees;
use Jeu\Jeu;
use Jeu\Editeur;
//use Jeu\Regle;

use DAO\Coordonnees\CoordonneesDAO;
use DAO\Jeu\JeuDAO;
use DAO\Editeur\EditeurDAO;
//use DAO\Regle\RegleDAO;


if (htmlspecialchars(isset($_POST['ajouter']))) {
    print_r($_POST);
    $titre = htmlspecialchars($_POST['titre']);
    $anneeSortie = htmlspecialchars($_POST['anneeSortie']);
    $auteur = htmlspecialchars($_POST['auteur']);
    $nomEditeur= htmlspecialchars($_POST['nomEditeur']);
    $regle = htmlspecialchars($_POST['regle']);
    $contenuInitial='Complet';
    
    $rue = htmlspecialchars($_POST['rue']);
    $codePostal = htmlspecialchars($_POST['codePostal']);
    $ville = htmlspecialchars($_POST['ville']);
    
    $categorie = htmlspecialchars($_POST['categorie']);
    $univers = htmlspecialchars($_POST['univers']);
    
    /*$regleJeu = new Regle("", $regle);
    $daoRegle = new RegleDAO();
    $daoRegle->create($regleJeu);*/

    $coordonnees = new Coordonnees("", $rue, $codePostal, $ville);
    $daoCoordonnees = new CoordonneesDAO();
    $daoCoordonnees->create($coordonnees);
    
    $editeur = new Editeur("", $nomEditeur, $coordonnees);
    $daoEditeur = new EditeurDAO();
    $daoEditeur->create($editeur);

    if ($titre != "" && $anneeSortie != "" && $auteur != "" && $editeur != "" && $categorie != "" && $univers != ""  && $rue != "" 
        && $codePostal!= "" && $ville !="" && $regle !="") {
        $jeu = new Jeu($regle, $titre, $anneeSortie, $auteur, $editeur, $categorie, $univers, 
        $coordonnees, $contenuInitial);
        $daoJeu = new JeuDAO();
        $daoJeu->create($jeu);

        echo " <p><b> Le jeu " . $titre . " a bien été ajouté!<a href=\"..\..\vue\jeux.php\">Retour</a></p>";
    }

    if ($titre = "" || $anneeSortie = "" || $auteur = "" || $editeur = "" || $categorie =  "" ||  $univers = ""  || $rue = "" 
        || $codePostal = "" || $ville ="" || $regle ="") {
        echo "Veuillez saisir les champs vides";
    }
}

if(htmlspecialchars(isset ($_POST['supprimer'])) && isset ($_POST['personne'])){
    $idPersonne = htmlspecialchars($_POST['personne']);
    $personne->read($idPersonne);
    $daoPersonne->delete($personne);
    echo "La personne a bien été supprimée";
}

if (htmlspecialchars(isset($_POST['Modifier Personne'])) && isset ($_POST['personne'])) {
    $idPersonne = htmlspecialchars($_POST['personne']);
    $personne->read($idPersonne);
    $daoPersonne->update($personne);
    echo "La personne a bien été modifiée";
}

else{
    afficherPersonne();
}

?>