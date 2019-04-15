<!-- Contenu HTML affichage des formulaires -->

<?php
include_once ("../metier/adherents.php");
include_once ("../db/Daos.php");

use DAO\Personne\PersonneDAO;
use DAO\Adherent\AdherentDAO;

function afficherPersonnes()
{
    ?>


<form method="post" action="index.php?page=adherents">
	<table class="table">
		<thead id="vue_adh">

			<tr>
				<td colspan="8">
					<button type="submit" class="btn btn-primary" name="maj">
						<span class="glyphicon glyphicon-edit"></span> Mettre à Jour
					</button>
					<button type="submit" class="btn btn-success" name="ajouter">
						<span class="glyphicon glyphicon-plus"></span> Ajouter
					</button>
				</td>
			</tr>


			<tr id="tab">
				<th id="idPersonne">n°</th>
				<th id="nom_adh">Prénom Nom</th>
				<th id="date_naissance">Date de Naissance</th>
				<th id="coordonnees">Coordonnées</th>
				<th id="mel">Mél</th>
				<th id="num_tel">Numéro Téléphone</th>
				<th id="choix">Choix</th>
				<th id="picto"></th>

			</tr>
		</thead>
		<tbody id="list_adh">
			
            <?php

    $personnes = \DAO\Personne\PersonneDAO::getPersonnes();
    if (array_key_exists(0, $personnes)) {
        foreach ($personnes as $personne) {

            $daoAdherent = new AdherentDAO();
            $adherent = $daoAdherent->read($personne->getIdPersonne());
            ?>
            <tr>
				<td id="container"><?php echo $personne->getIdPersonne();?>
			<td id="container"><a href=" " onclick=""><?php echo $personne->getPrenom() ." ". strtoupper($personne->getNom());?></a></td>
				<td id="container"><?php echo $personne->getDateNaissance();?></td>
				<td id="container"><?php echo $personne->getCoordonnees();?></td>
				<td id="container"><?php echo $personne->getMel();?></td>
				<td id="container"><?php echo $personne->getNumeroTelephone();?></td>
				<td id="container"><input type="radio" name="idPersonne"
					value=" <?php echo $personne->getIdPersonne();?>"></td>
				
				
            <?php

            if (AdherentDAO::isAdherent($personne) && ! adhesionExpiree($adherent)) {
                ?>
			
				
				<td id="container"><img alt="rondVert" src="../images/rondVert.jpg"
					style="width: 20px;"></td>
           <?php
            } elseif (! AdherentDAO::isAdherent($personne) || adhesionExpiree($adherent)) {

                ?>
           <td id="container"><img alt="rondVert"
					src="../images/croixRouge.jpg" style="width: 22px;"></td>
            
              <?php
            }
        }
    } else {
        ?>
		<tr>
				<td colspan="6">Aucun adhérent dans la base de données</td>
			</tr>
        <?php
    }

    ?>
            
		</tbody>
	</table>
</form>


<?php
}

// =================================================================================================================
function formulaireAjoutPersonne(){
    ?>

<h3>Ajout d'une nouvelle personne</h3>
<div class="col-lg-offset-4 col-lg-4">
	<form method="post" action="index.php?page=adherent">
		<fieldset>
			<legend>Informations à renseigner</legend>
			<div class="form-group">
				<input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="nom" id="nomm" placeholder="Nom">
			</div>
			<div class="form-group">
			 	<input type="date" class="form-control" name="dateNaissance" id="dateNaissance">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="rue" id="rue" placeholder="Rue">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="codePostal" id="codePostal" placeholder="Code Postale">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="ville" id="ville" placeholder="Ville">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="mel" id="mel" placeholder="Mel">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="numTel" id="numTel" placeholder="Numéro de Téléphone">
			</div>

			<button type="submit" class="btn btn-success" name="ajouterPersonne">
				<span class="glyphicon glyphicon-plus"></span> Ajouter une<br>Nouvelle
				Personne
			</button>

		</fieldset>

	</form>

</div>

<?php
}
//==============================================================================================================
function infoPersonne($idPersonne)

{
    $daoPersonne = new PersonneDAO();
    $personne = $daoPersonne->read($idPersonne);
    $coordonnee = $personne->getCoordonnees();
    ?>
<fieldset>

	<div class="form-group">
		<label for="prenom">Prénom :</label><?php echo $personne->getPrenom();?>
    </div>
	<div class="form-group">
		<label for="nom">Nom :</label><?php echo strtoupper($personne->getNom());?>
	</div>
	<div class="form-group">
		<label for="dateNaissance">Date de naissance :</label> <?php echo $personne->getDateNaissance();?>
	</div>
	<div class="form-group">
		<label for="rue">Rue :</label><?php echo $coordonnee->getRue();?>
	</div>
	<div class="form-group">
		<label for="codePostal">Code Postale :</label><?php echo $coordonnee->getCodePostal();?> 
	</div>
	<div class="form-group">
		<label for="ville">Ville :</label><?php echo $coordonnee->getVille();?> 
	</div>
	<div class="form-group">
		<label for="mel">Mel :</label> <?php echo $personne->getMel();?>
	</div>
	<div class="form-group">
		<label for="numTel">Numéro de téléphone :</label><?php echo $personne->getNumeroTelephone();?>
	</div>
</fieldset>
<?php
}

// =================================================================================================================
function formulaireModifPersonnes()
{
    if (isset($_POST['idPersonne'])) 
    {
        //print_r($_POST);
        $daoPersonne = new PersonneDAO();
        $daoAdherent = new AdherentDAO();
        $personne = $daoPersonne->read($_POST['idPersonne']);
        $coordonnee = $personne->getCoordonnees();
        $adherent = $daoAdherent->read($personne->getIdPersonne());
        // echo $coordonnee;
        // echo $personne;
        
        
        PersonneDAO::estBeneficiaireDe($personne);
    
    	?>
	    	<div class="formulaireAdherent_container">
				<div class="formulaireAdherent_stiker">
					<h4>Informations liées au compte</h4>
					<?php 
						if(isset($adherent)){
							//affiche les dates d'adhésion, à défaut un message d'alerte dit que la personne n'est pas adhérente
							afficherInfoCompte($adherent);
							if(AdherentDAO::isAdherent($personne) && ! adhesionExpiree($adherent)){
								//affiche le règlement souscrit par l'adhérent
								afficherFormulaireAdh($personne);
							}
						}	
						elseif (AdherentDAO::isAdherent($personne)) {
							//affiche les bénéficiaires de l'adhérent, à défaut un message informe si il n'en a pas.
						        	afficherBeneficiaire($personne);
						}
					?>
				</div>
				
				<div class="formulaireAdherent_form">
					<form method="post" action="index.php?page=adherents">
						<div class="formulaireAdherent_form-container">
							<div class="formulaireAdherent_form-bouton">
								<button id="click" type="submit" class="btn btn-warning" name="retour" onclick="history.go(-1)">
									<span class="glyphicon glyphicon-backward"></span> Retour
								</button>
								<button id="click" type="submit" class="btn btn-primary" name="modifier">
									<span class="glyphicon glyphicon-edit"></span> Mettre à jour
								</button>

									<?php 
										if (isset ($adherent)){
											if(AdherentDAO::isAdherent($personne) && !adhesionExpiree($adherent)){
												afficherBoutonGestionAdh();}
											elseif (!AdherentDAO::isAdherent($personne)) {
												afficherBoutonPasserAdh();}
											elseif (adhesionExpiree($adherent)) {
												afficherBoutonAdhesionExpiree($adherent);
											}
										}
									?>
							</div>

							<div class="formulaireAdherent_form-label">
								<legend>Détails de l'adhérent</legend>
									<div class="form-group">
										<label for="prenom">Prénom :</label> <input type="text"
											class="form-control" name="prenom" id="prenom"
											value="<?php echo $personne->getPrenom();?>">
									</div>
									<div>
										<input type="hidden" name="idPersonne"
											value=<?php echo $personne->getIdPersonne();?>> <input
											type="hidden" name="idCoordonnees"
											value=<?php echo $personne->getCoordonnees()->getIdCoordonnees()?>>
									</div>
									<div class="form-group">
										<label for="nom">Nom :</label> <input type="text"
											class="form-control" name="nom" id="nom"
											value="<?php echo strtoupper($personne->getNom());?>">
									</div>

									<div class="form-group">
										<label for="dateNaissance">Date de naissance :</label> <input
											type="date" class="form-control" name="dateNaissance"
											id="dateNaissance"
											value="<?php echo $personne->getDateNaissance();?>">
									</div>
									<div class="form-group">
										<label for="rue">Rue :</label> <input type="text"
											class="form-control" name="rue" id="rue"
											value="<?php echo $coordonnee->getRue();?>">
									</div>
									<div class="form-group">
										<label for="codePostal">Code Postale :</label> <input type="text"
											class="form-control" name="codePostal" id="codePostal"
											value="<?php echo $coordonnee->getCodePostal();?>">

									</div>
									<div class="form-group">
										<label for="ville">Ville :</label> <input type="text"
											class="form-control" name="ville" id="ville"
											value="<?php echo $coordonnee->getVille();?>">
									</div>
									<div class="form-group">
										<label for="mel">Mel :</label> <input type="text"
											class="form-control" name="mel" id="mel"
											value="<?php echo $personne->getMel();?>">
									</div>
									<div class="form-group">
										<label for="numTel">Numéro de téléphone :</label> <input type="text"
											class="form-control" name="numTel" id="numTel"
											value="<?php echo $personne->getNumeroTelephone();?>">
									</div>		
			<?php
			}

				else if(!isset($_POST['idPersonne'])){
				echo "<table><tr><td>Vous n'avez pas choisi de Personne à modifier <input type=\"button\" class=\"btn btn-warning\" value=\"Retour\" onclick=\"history.go(-1)\"></tr></td></table>";
				}
					?>
										
							</div>
				
						</div>
					</form>
				</div>
			</div>
	<?php
    
}

// ========================================================================================================
function afficherFormulaireAdh($personne){
    $daoAdherent = new AdherentDAO();
    // print_r($_POST);


        // if ($daoAdherent->isAdherent($personne)) {
        $idAdherent = $_POST['idPersonne'];
        // echo $idAdherent;
        $adherent = $daoAdherent->read($idAdherent);
        // echo $adherent;
        // echo $adherent->getDateAdhesion();
        ?>


	<h4>Détails du règlement</h4>
		<label for="reglement"></label> <select id="reglement"
			name="reglement">

			<option value="<?php echo $adherent->getReglement();?>" selected><?php echo $adherent->getReglement();?></option>
		<?php

        $reglements = \DAO\Reglement\ReglementDAO::getReglement();
        foreach ($reglements as $reglement) {
            $designation = $reglement->getDesignation();
            if ($designation != $adherent->getReglement()) {
                echo "<option value=\"$designation\">$designation</option>";
            }
        }
        ?>
			
		</select>
<?php
    
}

// =============================================================================================
function afficheMessageDeConfirmation(){
    $daoPersonne = new PersonneDAO();
    $personne = $daoPersonne->read($_POST['idPersonne']);
    ?>
<tr>
			<?php

    echo "Etes-vous sûr de supprimer " . $personne->getPrenom() . " " . strtoupper($personne->getNom()) . " ?";

    ?>
				<td><button type="submit" class="btn btn-warning" name="retour"
						onclick="history.go(-1)">
						<span class="glyphicon glyphicon-backward">Retour</span>
					</button>
				</td>
				<td>
					<button type="submit" name="nEstPlusAdh" class="btn btn-danger"><span class="glyphicon glyphicon-trash"  name="supprimer" formmethod="post" formaction="index.php?page=adherents"></span>Supprimer<br>Abonné</button>
				</td>

</tr>

<?php
}

// ===============================================================================================================
function formulaireAjoutAdherent(){
    // print_r($_POST);
    $daoPersonne = new PersonneDAO();
    $date = date("Y-m-d");
    $dateFin = date("Y-m-d", strtotime("+1 year"));
    // echo $date;
    // echo $dateFin;

    if (isset($_POST['idPersonne'])) {

        // echo $idAdherent;
        $personne = $daoPersonne->read($_POST['idPersonne']);

        ?>

<div id="onside">

	<form method="post" action="index.php?page=adherents">

		<fieldset>
			<table>
				<tr>
					<td>Nom:</td>
					<td><input type="text" name="nom"
						value="<?php echo $personne->getNom()?>" /></td>
					<td>Prénom:</td>
					<td><input type="text" name="prenom"
						value="<?php echo strtoupper($personne->getNom())?>" /></td>
					<td><input type="hidden" name="idPersonne"
						value="<?php echo $personne->getIdPersonne()?>" /></td>
				<tr>
					<td>Date Adhésion:</td>
					<td><input type="text" name="datePremiereAdhesion"
						value="<?php echo $date?>" /></td>
					<td>Date Fin adhésion:</td>
					<td><input type="text" name="DateFinAdhesion"
						value="<?php echo $dateFin?>" /></td>
				</tr>
				<tr>

					<td><label for="reglement">Réglement</label> <select id="reglement"
						name="reglement">
							<option value="">--Choisir un réglement--</option>
		<?php

        $reglements = \DAO\Reglement\ReglementDAO::getReglement();
        foreach ($reglements as $reglement) {
            $designation = $reglement->getDesignation();

            echo "<option value=\"$designation\">$designation</option>";
        }
        ?>
			
	</select></td>

				</tr>
				<div class="bouton">
					<button type="submit" class="btn btn-success" name="validerAdh">
						<span class="glyphicon glyphicon-plus">Passer Adherent</span>
					</button>
				</div>

			</table>
		</fieldset>
	</form>

</div>

<?php
    }
}

// ======================================================================================================
    function afficherInfoCompte($adherent){
    	if (adhesionExpiree($adherent)) {
    		echo "<tr><td><font-size: 10px;><font color=\"red\">Attention l'adhésion est expirée</font></tr></td>";
    	}

    	elseif(!adhesionExpiree($adherent)){
    		?>
    		<p>Date Adhésion:<a><?php echo $adherent->getDatePremiereAdhesion();?></a></p> 
    		
    		<p>Date Fin adhésion:<a><?php echo $adherent->getDateFinAdhesion();?></a></p> 

    		<?php
    	}
    }

// ===============================================================================================================
function GererBeneficiaire(){
    ?>
<div class="fenetreFormulaire">
	<form class="formulaireAjout" method="post"
		action="index.php?page=adherents">
		<table>

		    <?php
		    $daoPersonne = new PersonneDAO();
		    $personne = $daoPersonne->read($_POST['idPersonne']);
		    // echo $personne;

		    /*if (! PersonneDAO::aBeneficaire($personne)) {
		        formulaireAjouterBenf();
		    } 
		    elseif (PersonneDAO::aBeneficaire($personne)) {
		        afficherBeneficiaire($personne);
		        formulaireAjouterBenf();
		    }*/
		    formulaireAjouterBenf();

		    ?>
	
	</table>
	</form>
</div>


<?php
}
//========================================================================================================
function afficherBeneficiaire($personne){
    $daoPersonne = new PersonneDAO();
    $personne = $daoPersonne->read($_POST['idPersonne']);
    
        if (! PersonneDAO::aBeneficaire($personne)) {
            echo "Cet adhérent n'a pas de bénéficiaire";
        }
        elseif (PersonneDAO::aBeneficaire($personne)) {

            ?>

<table>
	<tr>
		<!-- <th>n°</th> -->
		<th>Bénéficiaire</th>
		<th>Numéro Téléphone</th>
	</tr>
	<tr>
		<td colspan="2"></td> 
				<?php
            $beneficiaires = PersonneDAO::getBeneficiaire($personne->getIdPersonne());
            foreach ($beneficiaires as $beneficiaire) {
                // $rep = "<tr><td>" . $beneficiaire->getIdPersonne();
                $rep = "<tr><td id=\"benef\">" . $beneficiaire->getPrenom() . " " . strtoupper($beneficiaire->getNom());
                $rep .= "</td><td>"." ". $beneficiaire->getNumeroTelephone() . "</td></tr>";
                echo $rep;
                ?>
</table>
<?php
            }
        }
    }

//===============================================================================================================
function afficherBoutonGestionAdh(){
 
    ?>
      	<button id="click" type="submit" class="btn btn-success" name="gererBenef">
		<span class="glyphicon glyphicon-plus"></span> Gérer les<br>bénéficiaires</button>
						
		<button id="click" type="submit" class="btn btn-danger" name="nEstPlusAdh">
		<span class="glyphicon glyphicon-remove" style="font-size: 10px;"></span> Retirer statut<br> Adhérent</button>
	
	<?php 	

}
//===============================================================================================================
function afficherBoutonPasserAdh(){
    
        ?>
   			<button id="click" type="submit" class="btn btn-success" name="passerAdh">
					<span class="glyphicon glyphicon-plus"></span>Passer Adhérent</button>
      <?php       
}
//==================================================================================================================
function afficherBoutonAdhesionExpiree($adherent){
    if (adhesionExpiree($adherent)) {
        
        ?>
            <button id="click" type="submit" class="btn btn-info"
			name="renouvelerAdh">
			<span class="glyphicon glyphicon-exclamation-sign"></span>Renouveler<br>Adhésion</button><?php
        }
}
// =============================================================================================================
function formulaireAjouterBenf(){
    $daoPersonne = new PersonneDAO();
    $personne = $daoPersonne->read($_POST['idPersonne']);
?>
<div id="info">
	<?php afficherBeneficiaire($personne);?>
</div>
<form class="formulaireAjouterBenef" method="post" action="index.php?page=adherents">
	<h4 id="adh">
		<font color="red">Adhérent Principal : <?php echo $personne->getPrenom() ." ". strtoupper($personne->getNom())?></font>
		<input type="hidden" name="idPersonne" value=<?php echo $personne->getIdPersonne();?>>
	</h4>
	<div id="bouton">
		<button type="submit" class="btn btn-warning" name="retour"	onclick="history.go(-1)">
			<span class="glyphicon glyphicon-backward"> Retour</span>
		</button>
	</div>
	<table id="adh" class="table">
		<thead id="adh2">
			<tr>
				<th id="element">n°</th>
				<th id="element">Nom Prénom</th>
				<th id="element">Numéro Téléphone</th>
				<th id="element">Choix</th>

			</tr>
		</thead>
		<tbody>
			<tr>

				<td colspan="4"></td> 
				<?php
    // echo $personne->getIdPersonne();
    $beneficiaires = PersonneDAO::getPersonneNonAdh();

    foreach ($beneficiaires as $beneficiaire) {?>      
		<tr id="adh2">
				<td id="element"><?php echo $beneficiaire->getIdPersonne();?></td>
				<td id="element"><?php echo $beneficiaire->getPrenom() ." ". strtoupper($beneficiaire->getNom());?> </td>
				<td id="element"><?php echo $beneficiaire->getNumeroTelephone();?></td>
				<td id="element"><button type="submit" class="btn btn-success" name="associerBenef" value="<?php echo $beneficiaire->getIdPersonne();?>">
						<span class="glyphicon glyphicon-plus"></span> Associer à<br>l'adhérent</button>
			</tr>		
    <?php }?>
		<tr>
			</tr>
		</tbody>
	</table>
</form>


<?php
}
//======================================================================================================
function adhesionExpiree($adherent){
    $rep = false;
    $date = date("Y-m-d");
    $dateFinAdhesion = $adherent->getDateFinAdhesion();
    if ($date > $dateFinAdhesion) {
        $rep = true;
    }
    return $rep;
}

//=======================================================================================================
function aujourdhui(){
	$date = date("d");
	$jourEN = date("l");
	$moisEN = date("F");
	$annee= date("Y");
	$heure = date("H:m");

	switch ($jourEN) {
    	case "Sunday": $jourFR="Dimanche"; break;
    	case "Monday": $jourFR="Lundi"; break;
    	case "Tuesday": $jourFR="Mardi"; break;
    	case "Wednesday": $jourFR="Mercredi"; break;
    	case "Thursday": $jourFR="Jeudi"; break;
    	case "Friday": $jourFR="Vendredi"; break;
    	case "Saturday": $jourFR="Samedi"; break;
	}

	switch ($moisEN) {
	    case 'January': $moisFR="Janvier"; break;
	    case 'February': $moisFR="Février"; break;
	    case 'March': $moisFR="Mars"; break;
	    case 'April': $moisFR="Avril"; break;
	    case 'May': $moisFR="Mai"; break;
	    case 'June': $moisFR="Juin"; break;
	    case 'July': $moisFR="Juillet"; break;
	    case 'August': $moisFR="Août"; break;
	    case 'September': $moisFR="Septembre"; break;
	    case 'October': $moisFR="Octobre"; break;
	    case 'November': $moisFR="Novembre"; break;
	    case 'December': $moisFR="Decembre"; break;
		
	}


	?>
	<div id="jour">
		<?php echo $jourFR ." ".$date ." ". $moisFR ." ". $annee; ?>
	</div>
	<div id="heure">
		<?php echo $heure; ?>
	</div>
<?php
 }
 ?>
