<?php
namespace Emprunt{
    
    class Emprunt{
        
        private $idJeuPhysique;
        private $idAdherent;
        private $dateEmprunt;
        private $dateRetourEffectif;
        private $idAlerte;
        

        function __construct($idJeuPhysique, $idAdherent, $dateEmprunt, $dateRetourEffectif, $idAlerte){
            $this->idJeuPhysique = $idJeuPhysique;
            $this->idAdherent = $idAdherent;
            $this->dateEmprunt = $dateEmprunt;
            $this->dateRetourEffectif = $dateRetourEffectif;
            $this->idAlerte = $idAlerte;
        }
        
        public function getIdJeuPhysique(){
            return $this->idJeu;
        }
    
        public function getIdAdherent(){
            return $this->idAdherent;
        }   
     
        public function getDateEmprunt(){
            return $this->dateEmprunt;
        }

        public function getDateRetourEffectif(){
            return $this->dateRetourEffectif;
        }
        
        public function getIdAlerte(){
            return $this->idAlerte;
        }
        
        public function setIdJeuPhysique($idJeuPhysique){
            $this->idJeuPhysique = $idJeuPhysique;
        }
        
        public function setIdAdherent($idAdherent){
            $this->idAdherent = $idAdherent;
        }
        
        public function setDateEmprunt($dateEmprunt){
            $this->dateEmprunt = $dateEmprunt;
        }
        
        public function setDateRetourEffectif($dateRetourEffectif){
            $this->dateRetourEffectif = $dateRetourEffectif;
        }
        
        public function setIdAlerte($idAlerte){
            $this->idAlerte = $idAlerte;
        }
    }
}
?>