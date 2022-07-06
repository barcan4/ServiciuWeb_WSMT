<?php

class Repo {
    private $repo;

    function __construct() {
        $this->repo = array();
    }

    function add($object) {
        $this->repo[] = $object;
    }

    function get($index) {
        for ($i=0; $i < $this->getSize(); $i++) {
            if (get_class($this->repo[$i]) == 'Student') {
                if ($this->repo[$i]->getsID() == $index) {
                    return $this->repo[$i];
                }
            }
            if (get_class($this->repo[$i]) == 'Materie') {
                if ($this->repo[$i]->getmID() == $index) {
                    return $this->repo[$i];
                }
            }
            if (get_class($this->repo[$i]) == 'Nota') {
                if ($this->repo[$i]->getnID() == $index) {
                    return $this->repo[$i];
                }
            }
        }
        return null;
    }

    function delete($index) {
        $objectDel = $this->get($index);
        unset($objectDel);
    }

    function update($index, $object) {
        $objectUpd = $this->get($index);
        $objectUpd = $object;
    }

    function getRepo() {
        return $this->repo;
    }

    function getSize() {
        return count($this->repo);
    }
}

?>