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
				<td colspan="8"><button type="submit" class="btn btn-primary"
						name="maj">
						<span class="glyphicon glyphicon-edit"></span> Mettre à Jour
					</button>
					<button type="submit" class="btn btn-success" name="ajouter">
						<span class="glyphicon glyphicon-plus"></span> Ajouter
					</button></td>


				<td colspan="8"></td>
				<td></td>
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
function formulaireAjoutPersonne()
{
    ?>

<h3>Ajout d'une nouvelle personne</h3>
<div class="col-lg-offset-4 col-lg-4">
	<form method="post" action="index.php?page=adherent">
		<fieldset>
			<legend>Informations à renseigner</legend>
			<div class="form-group">
				<label for="prenom">Prénom :</label> <input type="text"
					class="form-control" name="prenom" id="prenom">
			</div>
			<div class="form-group">
				<label for="nom">Nom :</label> <input type="text"
					class="form-control" name="nom" id="nomm">
			</div>
			<div class="form-group">
				<label for="dateNaissance">Date de naissance :</label> <input
					type="date" class="form-control" name="dateNaissance"
					id="dateNaissance">
			</div>
			<div class="form-group">
				<label for="rue">Rue :</label> <input type="text"
					class="form-control" name="rue" id="rue">
			</div>
			<div class="form-group">
				<label for="codePostal">Code Postale :</label> <input type="text"
					class="form-control" name="codePostal" id="codePostal">
			</div>
			<div class="form-group">
				<label for="ville">Ville :</label> <input type="text"
					class="form-control" name="ville" id="ville">
			</div>
			<div class="form-group">
				<label for="mel">Mel :</label> <input type="text"
					class="form-control" name="mel" id="mel">
			</div>
			<div class="form-group">
				<label for="numTel">Numéro de téléphone :</label> <input type="text"
					class="form-control" name="numTel" id="numTel">
			</div>

			<button type="submit" class="btn btn-success" name="ajouterPersonne">
				<span class="glyphicon glyphicon-plus"></span> Ajouter une Nouvelle
				Personne
			</button>

		</fieldset>

	</form>

</div>

<?php
}

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
    ?>
<div class="col-lg-offset-4 col-lg-4">

	<form method="post" action="index.php?page=adherents">

		<fieldset>
			<legend>Détails de l'adhérent</legend>
		<?php

    if (isset($_POST['idPersonne'])) {
        // print_r($_POST);
        $daoPersonne = new PersonneDAO();
        $daoAdherent = new AdherentDAO();
        $personne = $daoPersonne->read($_POST['idPersonne']);
        $coordonnee = $personne->getCoordonnees();
        $adherent = $daoAdherent->read($personne->getIdPersonne());
        // echo $coordonnee;
        // echo $personne;

        if (AdherentDAO::isAdherent($personne)) {
            if (adhesionExpiree($adherent)) {
                echo "<tr><td><font color=\"red\">Attention l'adhésion est expirée</tr></td></font>";
            }
        }
        PersonneDAO::estBeneficiaireDe($personne);

        ?>
			<div class="form-group">
				<label for="prenom">Prénom :</label> <input type="text"
					class="form-control" name="prenom" id="prenom"
					value="<?php echo $personne->getPrenom();?>">
					</div>

			<div><label><button type="submit" class="btn btn-primary" name="modifier"
					onclick="confirmation()">
					<span class="glyphicon glyphicon-edit"></span>Mettre à jour
				</button></label>
				</div>	


			<div>	<input type="hidden" name="idPersonne"
					value=<?php echo $personne->getIdPersonne();?>> <input
					type="hidden" name="idCoordonnees"
					value=<?php echo $personne->getCoordonnees()->getIdCoordonnees()?>>
			</div>
			<div class="form-group">
				<label for="nom">Nom :</label> <input type="text"
					class="form-control" name="nom" id="nom"
					value="<?php echo strtoupper($personne->getNom());?>">
			</div>
			
			<div><label><button type="submit" class="btn btn-danger" name="supprimer">
					<span class="glyphicon glyphicon-remove"></span>Supprimer
				</button></label>
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
        afficherFormulaireAdh($personne);
        afficherBeneficiaire($personne);
        ?>
			<div id="bouton">

				<button type="submit" class="btn btn-warning" name="retour"
					onclick="history.go(-1)">
					<span class="glyphicon glyphicon-backward"></span>
				</button>

				
			</div>
			<p></p>		
				<?php

        if (! AdherentDAO::isAdherent($personne) || adhesionExpiree($adherent)) {
            ?>
           
				<div id="onside">
				<button type="submit" class="btn btn-success" name="passerAdh">
					<span class="glyphicon glyphicon-plus"></span>Passer Adhérent
				</button>
			</div>
		
				<?php
        }
        if (AdherentDAO::isAdherent($personne) && ! adhesionExpiree($adherent)) {
            ?>
            <div id="bouton">
				<button type="submit" class="btn btn-success" name="gererBenef">
					<span class="glyphicon glyphicon-plus"></span>Gérer les
					bénéficiaires
				</button>

				<button type="submit" class="btn btn-danger" name="nEstPlusAdh">
					<span class="glyphicon glyphicon-remove"></span>Retirer statut
					Adhérent
				</button>
			</div>            
        <?php
        }
        ?>
        

			
			<?php
    } else {
        echo "<table><tr><td>Vous n'avez pas choisi de Personne à modifier <input type=\"button\" class=\"btn btn-warning\" value=\"Retour\" onclick=\"history.go(-1)\"></tr></td></table>";
    }
    ?>
   
	
	
	</fieldset>
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

<div id="onside">
	<fieldset>
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
	</fieldset>
</div>

<div id="info">
	<fieldset>
		<label for="dateAdhesion">Date Adhésion:</label> <label><?php echo $adherent->getDatePremiereAdhesion();?></label>
		<label for="dateFinAdhesion">Date Fin adhésion:</label> <label><?php echo $adherent->getDateFinAdhesion();?></label>
	</fieldset>
</div>

<div id="bouton">
	<fieldset>		
	<?php
        if (adhesionExpiree($adherent)) {

            ?>
            <button type="submit" class="btn btn-info"
			name="renouvelerAdh">
			<span class="glyphicon glyphicon-exclamation-sign"></span>Renouveler
			Adhésion
		</button><?php
        }

        ?>
      </fieldset>
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

    echo "Etes-vous sûr de supprimer" . $personne->getPrenom() . " " . strtoupper($personne->getNom()) . " ?";

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
				<label class="bouton">
				
				<tr>
					<button type="submit" class="btn btn-success" name="validerAdh">
						<span class="glyphicon glyphicon-plus">Passer Adherent</span>
					</button>
				</tr>
				</label>
			</table>
		</fieldset>
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
            echo "<table><tr><td>Cet adhérent n'a pas de bénéficiaire</td></tr>";
        } elseif (PersonneDAO::aBeneficaire($personne)) {

            ?>

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
                $rep = "<tr><td>" . $beneficiaire->getPrenom() . " " . strtoupper($beneficiaire->getNom());
                $rep .= "</td><td>" . $beneficiaire->getNumeroTelephone() . "</td></tr>";

                echo $rep;
                ?>
 	
	
	
	
	
	
	
	
	
	
	
	
	
	<tr>

		<td><button type="submit" name="supprimerBenef">Dissocier de
				l'adhérent</button></td>
	</tr>
</table>

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
	<form class="formulaireAjout" method="post"
		action="index.php?page=adherents">
		<table>

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
	
	
	</table>
	</form>
</div>


<?php
}

// =============================================================================================================
function formulaireAjouterBenf()
{
    $daoPersonne = new PersonneDAO();
    $personne = $daoPersonne->read($_POST['idPersonne']);
    ?>

<form class="formulaireAjouterBenef" method="post"
	action="index.php?page=adherents">


	<h4>
		<font color="red">Adhérent Principal : <?php echo $personne->getPrenom() . " ". strtoupper($personne->getNom())?></font>
		<input type="hidden" name="idPersonne"
			value=<?php echo $personne->getIdPersonne();?>>
	</h4>
	<table class="table">
		<thead id="vue_adh">
			<tr>
				<th>n°</th>
				<th>Nom Prénom</th>
				<th>Numéro Téléphone</th>
				<th>Choix</th>

			</tr>
		</thead>
		<tbody>
			<tr>

				<td colspan="4"></td> 
				<?php
    // echo $personne->getIdPersonne();
    $beneficiaires = PersonneDAO::getPersonneNonAdh();

    foreach ($beneficiaires as $beneficiaire) {
        $i = 0;
        ?>
		
			
			
			
			
			
			
			
			
			
			
			
			<tr>
				<td><?php echo $beneficiaire->getIdPersonne();?></td>
				<td><?php echo $beneficiaire->getPrenom() ." ". strtoupper($beneficiaire->getNom());?> </td>
				<td><?php echo $beneficiaire->getNumeroTelephone();?> </td>
				<td><button type="submit" class="btn btn-success"
						name="associerBenef">
						<span class="glyphicon glyphicon-plus"></span> Associer à
						l'adhérent
					</button>
			
			</tr>
			
			
    <?php }?>
		<tr>

				<td>
					<button type="submit" class="btn btn-warning" name="retour"
						onclick="history.go(-1)">
						<span class="glyphicon glyphicon-backward"></span>
					</button>
				</td>
			</tr>

		</tbody>

	</table>
</form>


<?php
}

function adhesionExpiree($adherent)
{
    $rep = false;
    $date = date("Y-m-d");
    $dateFinAdhesion = $adherent->getDateFinAdhesion();
    if ($date > $dateFinAdhesion) {
        $rep = true;
    }
    return $rep;
}

?>
<script>

function confirmation($idPersonne){
	if(confirm("Les modifications ont bien éte prises en compte")){
		document.location.href="..\vue\index.php?page=adherents";
		
}
	else{
		"Les modification ont été annulées";
	}

	}
</script>