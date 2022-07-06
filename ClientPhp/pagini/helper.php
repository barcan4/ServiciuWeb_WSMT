<?php

require_once("../Client.php");

if (isset($_POST['method'])) {
    if ($_POST['method'] === 'PUT' && !empty($_POST['sID'])) {
        $data = array (
            "sID" => $_POST['sID'],
            "nume" => $_POST['nume'],
            "prenume" => $_POST['prenume'],
            "grupa" => $_POST['grupa']
        );
        if (!isset($client))
            $client = new Client("http://localhost:8080/ServerJava/");
        $resp = $client->apelServer("update student", $data);
        echo "<script> location.href='studenti.php'; </script>";
    }
    if ($_POST['method'] === 'DELETE' && !empty($_POST['sID'])) {
        $data = array (
            "sID" => $_POST['sID'],
        );
        if (!isset($client))
            $client = new Client("http://localhost:8080/ServerJava/");
        $resp = $client->apelServer("remove student", $data);
        echo "<script> location.href='studenti.php'; </script>";
    }
    if ($_POST['method'] === 'POST' && $_POST['clasa'] === 'student') {
        $data = array (
            "nume" => $_POST['nume'],
            "prenume" => $_POST['prenume'],
            "grupa" => $_POST['grupa']
        );
        if (!isset($client)) {
            $client = new Client("http://localhost:8080/ServerJava/");
        }
        $resp = $client->apelServer("add student", $data);
        echo "<script> location.href='studenti.php'; </script>";
    }

    
    
    if ($_POST['method'] === 'PUT' && !empty($_POST['mID'])) {
        $data = array (
            "mID" => $_POST['mID'],
            "denumire" => $_POST['denumire'],
            "profesor" => $_POST['profesor'],
        );
        if (!isset($client))
            $client = new Client("http://localhost:8080/ServerJava/");
        $resp = $client->apelServer("update materie", $data);
        echo "<script> location.href='materii.php'; </script>";
    }
    if ($_POST['method'] === 'DELETE' && !empty($_POST['mID'])) {
        $data = array (
            "mID" => $_POST['mID'],
        );
        if (!isset($client))
            $client = new Client("http://localhost:8080/ServerJava/");
        $resp = $client->apelServer("remove materie", $data);
        echo "<script> location.href='materii.php'; </script>";
    }
    if ($_POST['method'] === 'POST' && $_POST['clasa'] === 'materie') {
        $data = array (
            "denumire" => $_POST['denumire'],
            "profesor" => $_POST['profesor']
        );
        if (!isset($client)) {
            $client = new Client("http://localhost:8080/ServerJava/");
        }
        $resp = $client->apelServer("add materie", $data);
        echo "<script> location.href='materii.php'; </script>";
    }

    

    if ($_POST['method'] === 'PUT' && !empty($_POST['nID'])) {
        $data = array (
            "nID" => $_POST['mID'],
            "mark" => $_POST['mark'],
            "descriere" => $_POST['descriere'],
        );
        if (!isset($client))
            $client = new Client("http://localhost:8080/ServerJava/");
        $resp = $client->apelServer("update nota", $data);
        echo "<script> location.href='note.php'; </script>";
    }
    if ($_POST['method'] === 'POST' && $_POST['clasa'] === 'nota') {
        $data = array (
            "mark" => $_POST['mark'],
            "descriere" => $_POST['descriere'],
            "sID" => $_POST['sID'],
            "mID" => $_POST['mID']
        );
        if (!isset($client)) {
            $client = new Client("http://localhost:8080/ServerJava/");
        }
        $resp = $client->apelServer("add nota", $data);
        echo "<script> location.href='note.php'; </script>";
    }
}


?>