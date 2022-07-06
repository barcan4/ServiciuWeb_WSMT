<!DOCTYPE html>
<html>
    <body>
        <script src="Utils.js"></script>
        
        <?php

        require_once("../Client.php");
        require_once("../Repository/Repo.php");
        require_once("../Model/Materie.php");

        if (!isset($client)) {
            $client = new Client("http://localhost:8080/ServerJava/");
        }

        $resp = $client->apelServer("materii", []);
        $stringResp = $resp->getResponse();
        $arrayResp = json_decode($stringResp);
        if (!isset($materieRepo)) {
            $materieRepo = new Repo();
        }

        ?>

        <table>
        <tr>
            <th>Denumire</th>
            <th>Profesor</th>
        </tr>
            <?php
            
            for ($i=0; $i < count($arrayResp); $i++) { 
                echo "<tr>";
                echo "<form method='POST' action='helper.php'>";
                echo "<input type='hidden' name='method' value='PUT'>";
                echo "<input type='hidden' name='mID' value='".$arrayResp[$i]->mID."'>";
                echo "<td><input type='text' name='denumire' value='".$arrayResp[$i]->denumire."'></td>";
                echo "<td><input type='text' name='profesor' value='".$arrayResp[$i]->profesor."'></td>";
                echo "<td><input type='submit' value='Update'></td>";
                echo "</form>";
                echo "<form method='POST' action='helper.php'>";
                echo "<input type='hidden' name='method' value='DELETE'>";
                echo "<input type='hidden' name='mID' value='".$arrayResp[$i]->mID."'>";
                echo "<td><input type='submit' value='Remove'></td>";
                echo "</form>";
                echo "</tr>";
                $materie = new Materie($arrayResp[$i]->mID, $arrayResp[$i]->denumire, $arrayResp[$i]->profesor);
                $materieRepo->add($materie);
            }
            
            ?>
        </table>
        <br/>
        <form method='POST' action='helper.php'>
            <input type='hidden' name='method' value='POST'>
            <input type='hidden' name='clasa' value='materie'>
            Denumire materie noua: <input type='text' name='denumire'><br/>
            Profesor materie noua: <input type='text' name='profesor'><br/>
            <input type='submit' value='Add'><br/>
        </form>

        <br>
        <input type='submit' value='Catalog' onClick='goCatalog()'/>
        <input type='submit' value='Studenti' onClick='goStudenti()'/>
        <input type='submit' value='Note' onClick='goNote()'/>
            
    </body>
</html>