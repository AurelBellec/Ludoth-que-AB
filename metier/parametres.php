<?php

namespace Parametre{
    
    class Reglement{
        
        private $designation;
        private $nbrJeux;
        private $duree;
        private $retardTolere;
        private $valeurCaution;
        private $coutAdhesion;
        
        function __construct($designation, $nbrJeux, $duree, $retardTolere, $valeurCaution, $coutAdhesion){
            $this->designation = $designation;
            $this->nbrJeux = $nbrJeux;
            $this->duree = $duree;
            $this->retardTolere = $retardTolere;
            $this->valeurCaution = $valeurCaution;
            $this->coutAdhesion =$coutAdhesion;
            
            
        }
        
        public function getDesignation()
        {
            return $this->designation;
        }
    
        public function getNbrJeux()
        {
            return $this->nbrJeux;
        }
    
        public function getDuree()
        {
            return $this->duree;
        }
    
        public function getRetardTolere()
        {
            return $this->retardTolere;
        }
    
        public function getValeurCaution()
        {
            return $this->valeurCaution;
        }
    
        public function getCoutAdhesion()
        {
            return $this->coutAdhesion;
        }
    
        public function setDesignation($designation)
        {
            $this->designation = $designation;
        }
    
        public function setNbrJeux($nbrJeux)
        {
            $this->nbrJeux = $nbrJeux;
        }
    
        public function setDuree($duree)
        {
            $this->duree = $duree;
        }
    
        public function setRetardTolere($retardTolere)
        {
            $this->retardTolere = $retardTolere;
        }
    
        public function setValeurCaution($valeurCaution)
        {
            $this->valeurCaution = $valeurCaution;
        }
    
        public function setCoutAdhesion($coutAdhesion)
        {
            $this->coutAdhesion = $coutAdhesion;
        }      
        
        function __toString()
        {
            $rep = "<table class=\"reglement\"><tr><td> $this->idReglement </td><td> $this->nbrJeux </td><td>
            $this->duree </td><td> $this->retardTolere </td><td> $this->valeurCaution </td><td> $this->coutAdhesion
            </td></tr></table>";
            return $rep;
        }
        
    }
}


?>