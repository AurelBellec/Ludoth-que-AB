<?php
//session_start();
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>Ludothèque</title>
<link rel="shortcut icon" type="image/x-icon"
	href="../images/logo_ludo.jpg" />
</head>


<body>

	<div id="navigation">
		<ul style="list-style-type: none">

			<li class="personne"><a href="adherent.php"><img alt="Personne"
					src="../images/personne.png" style="width: 50px; height: 50px;"><br/>Gérer
					les Adhérents</a></li>
			<li class="jeux"><a href="jeux.php"><img alt="Jeux"
					src="../images/jeu.png" style="width: 50px; height: 50px;"><br/>Gérer
					les Jeux</a></li>
			<li class="emprunt"><a href="emprunts.php"><img alt="Emprunts"
					src="../images/emprunt.png" style="width: 50px; height: 50px;"><br/>Gérer
					les Emprunts</a></li>
			<li class="setup"><a href="parametres.php"><img
					alt="Gestion Ludothèque" src="../images/setup.png"
					style="width: 50px; height: 50px;"><br/>Gérer Ludothéque</a></li>
			<li class="home"><a href="index.php"><img alt="Accueil"
					src="../images/home.png" style="width: 50px; height: 50px;"><br/>Accueil</a></li>
		</ul>
	</div>

	<div class="infoLudo">
		<h1>Betton Ludique</h1>
		<div class="fenetreInfo" style="overflow-y: scroll;">
			<form class="affichePersonne" method="post"
				action="formulaireModifJeu.php">
				<table>
					<tr>
						<td colspan="6"></td>

					</tr>
					<tr style="width:100%">
						<th>Identifiant</th>
						<th>Titre</th>
						<th>Auteur</th>
						<!-- <th>Editeur</th> -->
						<th>Année de Sortie</th>
						<th>Catégorie</th>
						<th>Univers</th>
						
						
						
						
						<th><input type="submit" name="modifier" value="Modifier Jeu"
							style="width: 150px; height: 50px" class="gestionBouton2"> </th>

					</tr>
				       
            <?php
            // On gère les include dès le début du programme
            // include ("../db/connexion.php");
            include ("../metier/jeux/jeux.php");
            include ("../db/Daos.php");
            $jeux = \DAO\Jeu\JeuDAO::getJeux();
            foreach ($jeux as $jeu) {
                $rep = "<tr><td>" . $jeu->getIdJeu();
                $rep .= "</td><td>" . $jeu->getTitre();
                $rep .= "</td><td>" . $jeu->getAuteur();
                //$rep .= "</td><td>" . $jeu->getIdEditeur();
                $rep .= "</td><td>" . $jeu->getAnneeSortie();
                $rep .= "</td><td>" . $jeu->getCategorie();
                $rep .= "</td><td>" . $jeu->getUnivers();
               
                $rep .= "</td><td><input type=\"radio\" name=\"idJeu\" value=\"" . $jeu->getIdJeu() . "\" label for=\"idJeu\"></td></tr>";

                echo $rep;
            }
            ?>
            
				</table>
			</form>

		</div>
	</div>

	<div>
		<form class="gestionBouton" action="formulaireAjoutJeu.php">
			<input type="submit" value="Ajouter Jeu"
				style="width: 150px; height: 50px">
		</form>
	</div>


</body>

</html>