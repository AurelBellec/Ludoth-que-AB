<?php
include_once ("../metier/adherents.php");
include_once ("../db/Daos.php");
use DAO\Personne\PersonneDAO;
use DAO\Adherent\AdherentDAO;
use Adherent\Adherent;

function afficherPersonnes()
{
    ?>

<div class="infoLudo">
	<h1>Betton Ludique</h1>

	<div class="section" style="overflow-y: scroll;">
		<form class="affichePersonne" method="post"
			action="index.php?page=adherents">
			<table style="width: 80%">
				<tr>

					<th><button type="submit" name="maj">Mettre à Jour</button></th>
					<th><button type="submit" name="ajouter">Ajouter</button></th>

					<td colspan="8"></td>
					<td></td>
				</tr>

				<tr>
					<th>n°</th>
					<th>Prénom Nom</th>
					<th>Date de Naissance</th>
					<th>Coordonnées</th>
					<th>mél</th>
					<th>Numéro Téléphone</th>
					<th>Choix</th>
					<th>Adh</th>

				</tr>

				<tr>
					<td colspan="8" style="overflow-y: scroll"></td>      
            <?php

    $personnes = \DAO\Personne\PersonneDAO::getPersonnes();

    foreach ($personnes as $personne) {

        $rep = "<tr><td>" . $personne->getIdPersonne();
        $rep .= "</td><td>" . $personne->getPrenom() . " " . $personne->getNom();
        $rep .= "</td><td>" . $personne->getDateNaissance();
        $rep .= "</td><td>" . $personne->getCoordonnees();
        $rep .= "</td><td>" . $personne->getMel();
        $rep .= "</td><td>" . $personne->getNumeroTelephone();
        $rep .= "</td><td><input type=\"radio\" name=\"idPersonne\" value=\"" . $personne->getIdPersonne() . "\" label for=\"idPersonne\">";
        if (AdherentDAO::isAdherent($personne)) {
            $rep .= "</td><td><img alt=\"rondVert\" src=\"../images/rondVert.jpg\" style=\"width:20px; height=20px;\"></td></tr>";
        } elseif (! AdherentDAO::isAdherent($personne)) {
            $rep .= "</td><td><img alt=\"rondVert\" src=\"../images/croixRouge.jpg\" style=\"width:22px; height=22px;\"></td></tr>";
        }

        echo $rep;
    }
    ?>
            <td></td>
			
			</table>
		</form>

	</div>
</div>
<?php
}

// =================================================================================================================
function formulaireAjoutPersonne()
{
    ?>

<div class="fenetreFormulaire">

	<form class="formulaireAjout" method="post"
		action="../controleur/accueilAdherents.php">
		<table>
			<tr>
				<td>Prénom:</td>
				<td><input type="text" name="prenom" />
			
			
			<tr>
			
			
			<tr>
				<td>Date de Naissance:</td>
				<td><input type="date" name="dateNaissance" /></td>
			</tr>

			<tr>
				<td>rue:</td>
				<td><input type="text" name="rue" /></td>
				<td>Code Postal:</td>
				<td><input type="text" name="codePostal" /></td>
				<td>Ville:</td>
				<td><input type="text" name="ville" /></td>
			</tr>

			<tr>
				<td>Mel:</td>
				<td><input type="text" name="mel" /></td>
			</tr>

			<tr>
				<td>Numéro de Téléphone:</td>
				<td><input type="text" name="numTel" /></td>
			</tr>
			<tr>
				<td colspan="2"><button type="submit" name="ajouterPersonne">Ajouter
						une Nouvelle Personne</button></td>
			</tr>
		</table>
	</form>

</div>

<?php
}

// =================================================================================================================
function formulaireModifPersonnes()
{
    ?>
<div class="fenetreFormulaire">

	<form class="formulaireModif" method="post"
		action="../controleur/accueilAdherents.php">
		<?php

    if (isset($_POST['idPersonne'])) {
        // print_r($_POST);
        $daoPersonne = new PersonneDAO();
        $personne = $daoPersonne->read($_POST['idPersonne']);
        $coordonnee = $personne->getCoordonnees();
        // echo $coordonnee;
        // echo $personne;

        ?>
			<table>
			<tr>
				<td>Prénom:</td>
				<td><input type="text" name="prenom"
					value="<?php echo $personne->getPrenom();?>" /></td>
				<!-- 					<td>Id :</td> -->
				<td><input type="hidden" name="idPersonne"
					value="<?php echo $personne->getIdPersonne();?>" /></td>
				<!-- 					<td>IdAdresse :</td> -->
				<td><input type="hidden" name="idCoordonnees"
					value="<?php echo $personne->getCoordonnees()->getIdCoordonnees()?>" />
				</td>
			</tr>

			<tr>
				<td>Nom:</td>
				<td><input type="text" name="nom"
					value="<?php echo $personne->getNom();?>" /></td>
			</tr>

			<tr>
				<td>Date de Naissance:</td>
				<td><input type="date" name="dateNaissance"
					value="<?php echo $personne->getDateNaissance();?>" /></td>
			</tr>

			<tr>
				<td>Rue:</td>
				<td><input type="text" name="rue"
					value="<?php echo $coordonnee->getRue();?>" /></td>
				<td>Code Postal:</td>
				<td><input type="text" name="codePostal"
					value="<?php echo $coordonnee->getCodePostal();?>" /></td>
				<td>Ville:</td>
				<td><input type="text" name="ville"
					value="<?php echo $coordonnee->getVille();?>" /></td>
			</tr>

			<tr>
				<td>Mel:</td>
				<td><input type="text" name="mel"
					value="<?php echo $personne->getMel()?>" /></td>
			</tr>

			<tr>
				<td>Numéro de Téléphone:</td>
				<td><input type="text" name="numTel"
					value="<?php echo $personne->getNumeroTelephone()?>" /></td>
			</tr>
			<?php
        afficherFormulaireAdh($personne);
        afficherBeneficiaire($personne);
        ?>
			<tr>
				<td><input type="button" value="Retour" onclick="history.go(-1)"></td>
				<td><button type="submit" name="modifier">Mettre à jour</button></td>
				<td><button type="submit" name="supprimer">Supprimer</button></td>
					
				<?php

        if (! AdherentDAO::isAdherent($personne)) {
            ?>
				<td><button type="submit" name="passerAdh">Passer Adhérent</button></td>
			
				<?php
        }
        if (AdherentDAO::isAdherent($personne)) {
            ?>
            <td><button type="submit" name="gererBenef">Gérer les
						bénéficiaires</button></td>
				<td><button type="submit" name="nEstPlusAdh">Retirer statut Adhérent</button></td>            
        <?php
        }
        ?>
        </tr>

		</table>
			<?php
    } else {
        echo "Vous n'avez pas choisi de Personne à modifier";
    }
    ?>
   </form>
</div>
<?php
}

// ========================================================================================================
function afficherFormulaireAdh($personne)
{
    $daoAdherent = new AdherentDAO();
    // print_r($_POST);
    if (AdherentDAO::isAdherent($personne)) {

        // if ($daoAdherent->isAdherent($personne)) {
        $idAdherent = $_POST['idPersonne'];
        // echo $idAdherent;
        $adherent = $daoAdherent->read($idAdherent);
        // echo $adherent;
        // echo $adherent->getDateAdhesion();
        ?>
<div class="fenetreFormulaire">

	<form class="formulaireModif" method="post"
		action="../controleur/accueilAdherents.php">
		<table>
			<tr>
				<td>Règlement :</td>
				<td><label for="reglement"></label> <select id="reglement"
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
			
	</select></td>

				<td>Date Adhésion:</td>
				<td><?php echo $adherent->getDatePremiereAdhesion();?></td>
				<td>Date Fin adhésion:</td>
				<td><?php echo $adherent->getDateFinAdhesion();?></td>
				
	<?php
	if(adhesionExpiree($adherent)){
	    echo "<tr><td><font color=\"red\">Attention l'adhésion est expirée</tr></td></font>";
	    ?>
            <td><button type="submit" name="renouvelerAdh">Renouveler
						Adhésion</button></td><?php
        }

        ?>
        
        </tr>
		</table>
	</form>
</div>


<?php
    }
}

// =============================================================================================
function afficheMessageDeConfirmation()
{
    $daoPersonne = new PersonneDAO();
    $personne = $daoPersonne->read($_POST['idPersonne']);
    ?>



<tr>
			<?php

    echo "Etes-vous sûr de supprimer" . $personne->getPrenom() . " " . $personne->getNom() . " ?";

    ?>
				<td><input type="hidden" name="idPersonne"
		value="<?php echo $personne->getIdPersonne();?>" /></td>
	<td colspan="2"><input type="button" value="Retour"
		onclick="history.go(-1)"></td>
	<td colspan="2"><button type="submit" name="nEstPlusAdh">Supprimer
			Abonnement</button></td>

</tr>

<?php
}

?>
<?php

// ===============================================================================================================
function formulaireAjoutAdherent()
{
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

<div class="fenetreFormulaire">

	<form class="formulaireAjout" method="post"
		action="../controleur/accueilAdherents.php">
		<table>
			<tr>
				<td>Nom:</td>
				<td><input type="text" name="nom"
					value="<?php echo $personne->getNom()?>" /></td>
				<td>Prénom:</td>
				<td><input type="text" name="prenom"
					value="<?php echo $personne->getPrenom()?>" /></td>
				<td><input type="hidden" name="idPersonne"
					value="<?php echo $personne->getIdPersonne()?>" /></td>
			
			
			<tr>
				<td>D ate Adhésion:</td>
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
			<tr>

				<td><button type="submit" name="validerAdh">Passer Adherent</button></td>
			</tr>
		</table>
	</form>

</div>

<?php
    }
}

// ======================================================================================================
function afficherBeneficiaire($personne)
{
    $daoPersonne = new PersonneDAO();
    $personne = $daoPersonne->read($_POST['idPersonne']);

    if (AdherentDAO::isAdherent($personne)) {

        if (! PersonneDAO::aBeneficaire($personne)) {
            echo "<tr><td>Cet adhérent n'a pas de bénéficiaire</td></tr>";
        } elseif (PersonneDAO::aBeneficaire($personne)) {

            ?>
<div class="fenetreFormulaire">
	<form class="formulaireAjout" method="post"
		action="../controleur/accueilAdherents.php">
		<table>
			<tr>
				<!-- <th>n°</th> -->
				<th>Bénéficiaire</th>
				<th>Numéro Téléphone</th>


			</tr>
			<tr>
				<td colspan="3"></td> 
				<?php
            $beneficiaires = PersonneDAO::getBeneficiaire($personne->getIdPersonne());

            foreach ($beneficiaires as $beneficiaire) {

                // $rep = "<tr><td>" . $beneficiaire->getIdPersonne();
                $rep = "<tr><td>" . $beneficiaire->getPrenom() . " " . $beneficiaire->getNom();
                $rep .= "</td><td>" . $beneficiaire->getNumeroTelephone() . "</td></tr>";

                echo $rep;
                ?>

             		
			<tr>

				<td><button type="submit" name="supprimerBenef">Dissocier de
						l'adhérent</button></td>
			</tr>
		</table>
	</form>
</div>
<?php
            }
        }
    }
}

// ===============================================================================================================
function GererBeneficiaire()
{
    ?>
<div class="fenetreFormulaire">
    <?php
    $daoPersonne = new PersonneDAO();
    $personne = $daoPersonne->read($_POST['idPersonne']);
    // echo $personne;

    if (! PersonneDAO::aBeneficaire($personne)) {
        formulaireAjouterBenf();
    } elseif (PersonneDAO::aBeneficaire($personne)) {
        afficherBeneficiaire($personne);
        formulaireAjouterBenf();
    }

    ?>
	
	
	</div>


<?php
}

// =============================================================================================================
function formulaireAjouterBenf()
{
    ?>
<div class="fenetreFormulaire">
	<form class="formulaireAjouterBenef" method="post"
		action="../controleur/accueilAdherents.php">
		<table>
			<tr>
				<th>n°</th>
				<th>Nom Prénom</th>
				<th>Numéro Téléphone</th>
				<th>Choix</th>

			</tr>
			<tr>
				<td colspan="4"></td> 
				<?php
    // echo $personne->getIdPersonne();
    $beneficiaires = PersonneDAO::getPersonneNonAdh();

    foreach ($beneficiaires as $beneficiaire) {

        $rep = "<tr><td>" . $beneficiaire->getIdPersonne();
        $rep .= "</td><td>" . $beneficiaire->getNom() . " " . $beneficiaire->getPrenom();
        $rep .= "</td><td>" . $beneficiaire->getNumeroTelephone();
        $rep .= "</td><td><input type=\"checkbox\" name=\"idPersonne\" value=\"" . $beneficiaire->getIdPersonne() . "\" label for=\"idPersonne\"></td></tr>";

        echo $rep;
    }

    ?>
		
			
			
			<tr>
				<td colspan="2"><input type="button" value="Retour"
					onclick="history.go(-1)"></td>
				<td><button type="submit" name="ajouterBenef">Associer à l'adhérent</button></td>

			</tr>
		</table>
	</form>
</div>

<?php
}

function adhesionExpiree($adherent){
    
    $rep = false;
    $date = date("Y-m-d");
    $dateFinAdhesion = $adherent->getDateFinAdhesion();
    if ($date > $dateFinAdhesion) {
        $rep= true;
    }
    return $rep;
}


?>


