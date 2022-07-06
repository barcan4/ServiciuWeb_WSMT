<?php

require_once("Uri.php");
require_once("RestClient.php");

class Client {
    public $server;

    function __construct($urlServer) {
        $uri = Uri::uriFields($urlServer);
        $this->server = $urlServer;
        $urlServer = "http://".$uri["host"].":".$uri["port"];

        if (strlen($uri["path"]) > 0) {
            $urlServer .= "/".$uri["path"];
        }

        $this->apelServer("ceva", []);
        echo '<br>';
        $this->apelServer("catalog", []);
        echo '<br>';
        $this->apelServer("metoda gresita", []);
    }

    function apelServer($numeMetoda, $param) {

        $response;
        if (gettype($param) == "array") {
            switch ($numeMetoda) {
                case 'ceva':
                    $response = RestClient::get($this->server."ceva");
                    return $response;
                case 'catalog':
                    $response = RestClient::get($this->server."catalog");
                    return $response;
                case 'studenti':
                    $response = RestClient::get($this->server."studenti");
                    return $response;
                case 'materii':
                    $response = RestClient::get($this->server."materii");
                    return $response;
                case 'note':
                    $response = RestClient::get($this->server."note");
                    return $response;
                case 'add student':
                    $response = RestClient::post($this->server."studenti", json_encode($param), null, null, "application/json");
                    return $response;
                case 'add materie':
                    $response = RestClient::post($this->server."materii", json_encode($param), null, null, "application/json");
                    return $response;
                case 'add note':
                    $response = RestClient::post($this->server."note", json_encode($param), null, null, "application/json");
                    return $response;
                case 'update student':
                    $data = array(
                        "nume" => $param['nume'],
                        "prenume" => $param['prenume'],
                        "grupa" => $param['grupa']
                    );
                    $response = RestClient::put($this->server."student/".$param['sID'], json_encode($data), null, null, "application/json");
                    return $response;
                case 'update materie':
                    $data = array(
                        "denumire" => $param['denumire'],
                        "profesor" => $param['profesor']
                    );
                    $response = RestClient::put($this->server."materie/".$param['mID'], json_encode($data), null, null, "application/json");
                    return $response;
                case 'update nota':
                    $data = array(
                        "mark" => $param['mark'],
                        "descriere" => $param['descriere']
                    );
                    $response = RestClient::put($this->server."nota/".$param['nID'], json_encode($data), null, null, "application/json");
                    return $response;
                case 'remove student':
                    $response = RestClient::delete($this->server."student/".$param['sID']);
                    return $response;
                case 'remove materie':
                    $response = RestClient::delete($this->server."materie/".$param['mID']);
                    return $response;
                default:
                    $response = "Metoda nu exista";
                    return $response;
            }
        }
    }
}
?>