<?php
include_once ("../db/Daos.php");
include_once ("../metier/emprunts.php");
include_once ("../metier/jeux.php");
include_once ("../metier/parametres.php");
include_once ("../metier/adherents.php");
include_once ("adherent/formulaireAdherent.php");

?>
<!DOCTYPE html>

<html>

<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="index.css">
<title><?php /* Afficher titre de la page */ ?></title>
</head>


<body>
<?php
$page = (isset($_GET['page'])) ? htmlentities($_GET['page']) : "adherents";
?>
<nav>
		<ul>
			<li><a href="index.php?page=adherents"><img alt="Adherents"
					src="../images/beneficiaire.png"><br />Gérer les Adhérents</a></li>
			<li><a href="index.php?page=jeux"><img alt="Jeux"
					src="../images/jeu.png"><br />Gérer les Jeux</a></li>
			<li><a href="index.php?page=emprunts"><img alt="Emprunts"
					src="../images/emprunt.png"><br />Gérer les Emprunts</a></li>
			<li><a href="index.php?page=parametres"><img alt="Ludotheque"
					src="../images/parametre.png"><br />Gérer Ludothèque</a></li>
		</ul>
	</nav>
	<div class="container">
<?php
switch ($page) {
    case "adherents":
        include ('../controleur/accueilAdherents.php');
        break;
    case "jeux":
        include ('../controleur/accueilJeux.php');
        break;
    case "emprunts":
        include ('../controleur/accueilEmprunts.php');
        break;
    case "parametres":
        include ('../controleur/accueilParametres.php');
        break;
    default:
        include ('../controleur/accueilAdherents.php');
        break;
}
?>
</div>

</body>

</html>