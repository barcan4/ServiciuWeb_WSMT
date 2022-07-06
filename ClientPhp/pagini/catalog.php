<!DOCTYPE html>
<html>
    <head>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>
    </head>
    <script src="Utils.js"></script>
    <?php

        require_once("../Client.php");
        require_once("../Repository/Repo.php");

        if (!isset($client)) {
            $client = new Client("http://localhost:8080/ServerJava/");
        }

        $resp = $client->apelServer("catalog", []);
        $stringResp = $resp->getResponse();
        $arrayResp = json_decode($stringResp);

        echo "<table><tr><th>Denumire materie</th><th>Profesor materie</th><th>Descriere</th><th>Nota</th><th>Nume Student</th><th>Grupa Student</th></tr>";
        for ($i=0; $i < count($arrayResp); $i++) { 
            $detailsArray = explode(" ", $arrayResp[$i]);
            echo "<tr><td>".$detailsArray[0]."</td>";
            echo "<td>".$detailsArray[1]."</td>";
            echo "<td>".$detailsArray[2]."</td>";
            echo "<td>".$detailsArray[3]."</td>";
            echo "<td>".$detailsArray[4]."</td>";
            echo "<td>".$detailsArray[5]."</td></tr>";
        }
        echo "</table><br>";
        echo "<input type='submit' value='Materii' onClick='goMaterii()'/>";
        echo "<input type='submit' value='Studenti' onClick='goStudenti()'/>";
        echo "<input type='submit' value='Note' onClick='goNote()'/>";

    ?>
</html>