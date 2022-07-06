<?php

class Nota {
    private $nID;
    private $mark;
    private $descriere;
    private $sID;
    private $mID;

    function __construct($nID, $mark, $descriere, $sID, $mID) {
        $this->nID = $nID;
        $this->mark = $mark;
        $this->descriere = $descriere;
        $this->sID = $sID;
        $this->mID = $mID;
    }

    function getnID() {
        return $this->nID;
    }

    function getMark() {
        return $this->mark;
    }
    
    function getDescriere() {
        return $this->descriere;
    }

    function getsID() {
        return $this->sID;
    }

    function getmID() {
        return $this->mID;
    }

    function setnID($nID) {
        $this->nID = $nID;
    }

    function setMark($mark) {
        $this->mark = $mark;
    }

    function setDescriere($descriere) {
        $this->descriere = $descriere;
    }
    
    function setsID($sID) {
        $this->sID = $sID;
    }

    function setmID($mID) {
        $this->mID = $mID;
    }
}

?>