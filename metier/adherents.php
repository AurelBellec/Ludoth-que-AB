<?php
namespace Adherent
{

    class Personne
    {

        private $idPersonne;

        private $nom;

        private $prenom;

        private $dateNaissance;

        private $numeroTelephone;

        private $mel;

        private $coordonnees;

        function __construct($nom, $prenom, $dateNaissance, $numeroTelephone, $mel, $coordonnees)
        {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->dateNaissance = $dateNaissance;
            $this->numeroTelephone = $numeroTelephone;
            $this->mel = $mel;
            $this->coordonnees = $coordonnees;
        }

        public function getIdPersonne()
        {
            return $this->idPersonne;
        }

        public function getNom()
        {
            return $this->nom;
        }

        public function getPrenom()
        {
            return $this->prenom;
        }

        public function getDateNaissance()
        {
            return $this->dateNaissance;
        }

        public function getNumeroTelephone()
        {
            return $this->numeroTelephone;
        }

        public function getMel()
        {
            return $this->mel;
        }

        public function getCoordonnees()
        {
            return $this->coordonnees;
        }

        public function setIdPersonne($idPersonne)
        {
            $this->idPersonne = $idPersonne;
        }

        public function setNom($nom)
        {
            $this->nom = $nom;
        }

        public function setPrenom($prenom)
        {
            $this->prenom = $prenom;
        }

        public function setDateNaissance($dateNaissance)
        {
            $this->dateNaissance = $dateNaissance;
        }

        public function setNumeroTelephone($numeroTelephone)
        {
            $this->numeroTelephone = $numeroTelephone;
        }

        public function setMel($mel)
        {
            $this->mel = $mel;
        }

        public function setCoordonnees($coordonnees)
        {
            $this->coordonnees = $coordonnees;
        }

        function __toString()
        {
            $rep = "<table class=\"personne\"><tr><td> $this->idPersonne </td><td> $this->nom </td><td> $this->prenom </td><td> 
            $this->dateNaissance </td><td> $this->mel </td><td> $this->coordonnees       
            </td></tr></table>";
            return $rep;
        }
    }

    class Adherent extends Personne
    {

        private $reglement;

        private $datePremiereAdhesion;

        private $dateFinAdhesion;

        function __construct($nom, $prenom, $dateNaissance, $numeroTelephone, $mel, $coordonnees, $reglement, $datePremiereAdhesion, $dateFinAdhesion)
        {
            parent::__construct($nom, $prenom, $dateNaissance, $numeroTelephone, $mel, $coordonnees);
            $this->reglement = $reglement;
            $this->datePremiereAdhesion = $datePremiereAdhesion;
            $this->dateFinAdhesion = $dateFinAdhesion;
        }

        public function getReglement()
        {
            return $this->reglement;
        }

        public function getDatePremiereAdhesion()
        {
            return $this->datePremiereAdhesion;
        }

        public function getDateFinAdhesion()
        {
            return $this->dateFinAdhesion;
        }

        public function setReglement($reglement)
        {
            $this->reglement = $reglement;
        }

        public function setDatePremiereAdhesion($datePremiereAdhesion)
        {
            $this->datePremiereAdhesion = $datePremiereAdhesion;
        }

        public function setDateFinAdhesion($dateFinAdhesion)
        {
            $this->dateFinAdhesion = $dateFinAdhesion;
        }

        function __toString()
        {
            $rep = parent::__toString() . $this->reglement . $this->datePremiereAdhesion . "</td><td>" . $this->dateFinAdhesion . "</td></tr></table>";
            return $rep;
        }
    }

    class Coordonnees
    {

        private $idCoordonnees;

        private $rue;

        private $codePostal;

        private $ville;

        function __construct($idCoordonnees, $rue, $codePostal, $ville)
        {
            $this->idCoordonnees = $idCoordonnees;
            $this->rue = $rue;
            $this->codePostal = $codePostal;
            $this->ville = $ville;
        }

        public function getIdCoordonnees()
        {
            return $this->idCoordonnees;
        }

        public function getRue()
        {
            return $this->rue;
        }

        public function getCodePostal()
        {
            return $this->codePostal;
        }

        public function getVille()
        {
            return $this->ville;
        }

        public function setIdCoordonnees($idCoordonnees)
        {
            $this->idCoordonnees = $idCoordonnees;
        }

        public function setRue($rue)
        {
            $this->rue = $rue;
        }

        public function setCodePostal($codePostal)
        {
            $this->codePostal = $codePostal;
        }

        public function setVille($ville)
        {
            $this->ville = $ville;
        }

        function __toString()
        {
            $rep = $this->rue . " " . $this->codePostal . " " . $this->ville;
            return $rep;
        }
    }
}

?>