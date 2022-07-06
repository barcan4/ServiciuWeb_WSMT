<!DOCTYPE html>
<html>
    <body>
        <script src="Utils.js"></script>
        <?php

        require_once("../Client.php");
        require_once("../Repository/Repo.php");
        require_once("../Model/Student.php");

        if (!isset($client)) {
            $client = new Client("http://localhost:8080/ServerJava/");
        }

        $resp = $client->apelServer("studenti", []);
        $stringResp = $resp->getResponse();
        $arrayResp = json_decode($stringResp);
        if (!isset($studentRepo)) {
            $studentRepo = new Repo();
        }

        ?>

        <table>
        <tr>
            <th>Nume</th>
            <th>Prenume</th>
            <th>Grupa</th>
        </tr>
            <?php
            
            for ($i=0; $i < count($arrayResp); $i++) { 
                echo "<tr>";
                echo "<form method='POST' action='helper.php'>";
                echo "<input type='hidden' name='method' value='PUT'>";
                echo "<input type='hidden' name='sID' value='".$arrayResp[$i]->sID."'>";
                echo "<td><input type='text' name='nume' value='".$arrayResp[$i]->nume."'></td>";
                echo "<td><input type='text' name='prenume' value='".$arrayResp[$i]->prenume."'></td>";
                echo "<td><input type='text' name='grupa' value='".$arrayResp[$i]->grupa."'></td>";
                echo "<td><input type='submit' value='Update'></td>";
                echo "</form>";
                echo "<form method='POST' action='helper.php'>";
                echo "<input type='hidden' name='method' value='DELETE'>";
                echo "<input type='hidden' name='sID' value='".$arrayResp[$i]->sID."'>";
                echo "<td><input type='submit' value='Remove'></td>";
                echo "</form>";
                echo "</tr>";
                $student = new Student($arrayResp[$i]->sID, $arrayResp[$i]->nume, $arrayResp[$i]->prenume, $arrayResp[$i]->grupa);
                $studentRepo->add($student);
            }
                
            ?>
        </table>
        <br/>
        <form method='POST' action='helper.php'>
            <input type='hidden' name='method' value='POST'>
            <input type='hidden' name='clasa' value='student'>
            Nume student nou: <input type='text' name='nume'><br/>
            Prenume student nou: <input type='text' name='prenume'><br/>
            Grupa student nou: <input type='text' name='grupa'><br/>
            <input type='submit' value='Add'><br/>
        </form>
           
        
        <br>
        <input type='submit' value='Materii' onClick='goMaterii()'/>
        <input type='submit' value='Catalog' onClick='goCatalog()'/>
        <input type='submit' value='Note' onClick='goNote()'/>
    </body>
</html>