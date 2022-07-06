<!DOCTYPE html>
<html>
    <body>
        <script src="Utils.js"></script>
        <?php

        require_once("../Client.php");
        require_once("../Repository/Repo.php");
        require_once("../Model/Nota.php");
        require_once("../Model/Student.php");
        require_once("../Model/Materie.php");

        if (!isset($client)) {
            $client = new Client("http://localhost:8080/ServerJava/");
        }

        $resp = $client->apelServer("note", []);
        $stringResp = $resp->getResponse();
        $arrayResp = json_decode($stringResp);
        if (!isset($notaRepo)) {
            $notaRepo = new Repo();
        }

        ?>

        <table>
        <tr>
            <th>Mark</th>
            <th>Descriere</th>
        </tr>
            <?php
            
            for ($i=0; $i < count($arrayResp); $i++) { 
                echo "<tr>";
                echo "<form method='POST' action='helper.php'>";
                echo "<input type='hidden' name='method' value='PUT'>";
                echo "<input type='hidden' name='nID' value='".$arrayResp[$i]->nID."'>";
                echo "<td><input type='text' name='mark' value='".$arrayResp[$i]->mark."'></td>";
                echo "<td><input type='text' name='descriere' value='".$arrayResp[$i]->descriere."'></td>";
                echo "<td><input type='submit' value='Update'></td>";
                echo "</form>";
                echo "<form method='POST' action='helper.php'>";
                echo "<input type='hidden' name='method' value='DELETE'>";
                echo "<input type='hidden' name='nID' value='".$arrayResp[$i]->nID."'>";
                echo "<td><input type='submit' value='Remove'></td>";
                echo "</form>";
                echo "<form method='GET' action='notaDetalii.php'>";
                echo "<input type='hidden' name='method' value='GET'>";
                echo "<input type='hidden' name='nID' value='".$arrayResp[$i]->nID."'>";
                echo "<td><input type='submit' value='Details'></td>";
                echo "</form>";
                echo "</tr>";
                $nota = new Nota($arrayResp[$i]->nID, $arrayResp[$i]->mark, $arrayResp[$i]->descriere, $arrayResp[$i]->sID, $arrayResp[$i]->mID);
                $notaRepo->add($nota);
            }
                
            ?>
        </table>
        <br/>
        <form method='POST' action='helper.php'>
            <input type='hidden' name='method' value='POST'>
            <input type='hidden' name='clasa' value='nota'>
            Mark nota noua: <input type='text' name='mark'><br/>
            Descriere nota noua: <input type='text' name='descriere'><br/>
            Student nota noua: <input type='text' name='sID'><br/>
            Materie nota noua: <input type='text' name='mID'><br/>
            <input type='submit' value='Add'><br/>
        </form>
            
        
        <br>
        <input type='submit' value='Materii' onClick='goMaterii()'/>
        <input type='submit' value='Studenti' onClick='goStudenti()'/>
        <input type='submit' value='Catalog' onClick='goCatalog()'/>
    </body>
</html>