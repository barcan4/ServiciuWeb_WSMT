<!DOCTYPE html>
<html>
    <body>
        <?php

        require_once("../Client.php");
        require_once("../Repository/Repo.php");
        require_once("../Model/Nota.php");
        require_once("../Model/Student.php");
        require_once("../Model/Materie.php");

        if (!isset($client)) {
            $client = new Client("http://localhost:8080/ServerJava/");
        }

        $resp = $client->apelServer("studenti", []);
        $stringResp = $resp->getResponse();
        $arrayResp = json_decode($stringResp);
        if (!isset($studentRepo)) {
            $studentRepo = new Repo();
        }

        for ($i=0; $i < count($arrayResp); $i++) { 
            $student = new Student($arrayResp[$i]->sID, $arrayResp[$i]->nume, $arrayResp[$i]->prenume, $arrayResp[$i]->grupa);
            $studentRepo->add($student);
        }    

        $resp = $client->apelServer("materii", []);
        $stringResp = $resp->getResponse();
        $arrayResp = json_decode($stringResp);
        if (!isset($materieRepo)) {
            $materieRepo = new Repo();
        }

        for ($i=0; $i < count($arrayResp); $i++) { 
            $materie = new Materie($arrayResp[$i]->mID, $arrayResp[$i]->denumire, $arrayResp[$i]->profesor);
            $materieRepo->add($materie);
        }

        $resp = $client->apelServer("note", []);
        $stringResp = $resp->getResponse();
        $arrayResp = json_decode($stringResp);
        if (!isset($notaRepo)) {
            $notaRepo = new Repo();
        }

        for ($i=0; $i < count($arrayResp); $i++) { 
            $nota = new Nota($arrayResp[$i]->nID, $arrayResp[$i]->mark, $arrayResp[$i]->descriere, $arrayResp[$i]->sID, $arrayResp[$i]->mID);
            $notaRepo->add($nota);
        }


        $nota = $notaRepo->get($_GET['nID']);
        $studentNota = $studentRepo->get($nota->getsID());
        $materieNota = $materieRepo->get($nota->getmID());
        
        if ($_GET['method'] === 'GET') {
            echo "Nota: <input type='text' value='".$nota->getMark()."' readonly='readonly'><br/>";
            echo "Descriere: <input type='text' value='".$nota->getDescriere()."' readonly='readonly'><br/>";
            echo "Student: <input type='text' value='".$studentNota->getNume().' '.$studentNota->getPrenume().' '.$studentNota->getGrupa()."' readonly='readonly'><br/>";
            echo "Materie: <input type='text' value='".$materieNota->getDenumire().' '.$materieNota->getProfesor()."' readonly='readonly'><br/>";
        }

        ?>
    </body>
</html>