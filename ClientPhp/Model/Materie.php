<?php

class Materie {
    private $mID;
    private $denumire;
    private $profesor;

    function __construct($mID, $denumire, $profesor) {
        $this->mID = $mID;
        $this->denumire = $denumire;
        $this->profesor = $profesor;
    }

    function getmID() {
        return $this->mID;
    }

    function getDenumire() {
        return $this->denumire;
    }
    
    function getProfesor() {
        return $this->profesor;
    }

    function setmID($mID) {
        $this->mID = $mID;
    }

    function setDenumire($denumire) {
        $this->denumire = $denumire;
    }

    function setProfesor($profesor) {
        $this->profesor = $profesor;
    }
    
}

?>