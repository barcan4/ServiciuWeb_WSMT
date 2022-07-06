<?php

class Student {
    private $sID;
    private $nume;
    private $prenume;
    private $grupa;

    function __construct($sID, $nume, $prenume, $grupa) {
        $this->sID = $sID;
        $this->nume = $nume;
        $this->prenume = $prenume;
        $this->grupa = $grupa;
    }

    function getsID() {
        return $this->sID;
    }

    function getNume() {
        return $this->nume;
    }
    
    function getPrenume() {
        return $this->prenume;
    }
    
    function getGrupa() {
        return $this->grupa;
    }

    function setsID($sID) {
        $this->sID = $sID;
    }

    function setNume($nume) {
        $this->nume = $nume;
    }

    function setPrenume($prenume) {
        $this->prenume = $prenume;
    }
    
    function setGrupa($grupa) {
        $this->grupa = $grupa;
    }
}

?>