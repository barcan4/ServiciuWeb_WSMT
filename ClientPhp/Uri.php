<?php

class Uri {
    public static function uriFields($uri) {

        $kPort = array("ftp://","mailto:","http://","https://","rmi://");
        $vPort = array("21",    "25",     "80",     "443",     "1099");
        $kRes = array("protocol","user","host","port","path","file","type","query","fragment");
        $port = array();
        $res = array();

        for ($i0 = 0; $i0 < count($kPort); $i0++)
            $port[$kPort[$i0]] = $vPort[$i0];
        for ($i0 = 0; $i0 < count($kRes); $i0++)
            $res[$kRes[$i0]] = "";
        if ($uri == null || strlen($uri) < 3)
            return $res;
        
        $indexFragment = strpos($uri, "#");
        if (!$indexFragment) {
            $indexFragment = -1;
        }
        if ($indexFragment > 0) {
            $res["fragment"] = substr($uri, $indexFragment + 1);
            $uri = substr($uri, 0, $indexFragment);
        }

        $indexQuery = strpos($uri, "?");
        if (!$indexQuery) {
            $indexQuery = -1;
        }
        if ($indexQuery > 0) {
            $res["query"] = substr($uri, $indexQuery + 1);
            $uri = substr($uri, 0, $indexQuery);
        }

        $indexProtocol1 = strpos($uri, ":");
        if (!$indexProtocol1) {
            $indexProtocol1 = -1;
        }
        $indexProtocol2 = strpos($uri, "://");
        if (!$indexProtocol2) {
            $indexProtocol2 = -1;
        }
        if ($indexProtocol2 > 0)
            $res["protocol"] = substr($uri, 0, $indexProtocol2 + 3);
        else if ($indexProtocol1 > 0)
            $res["protocol"] = substr($uri, 0, $indexProtocol1 + 1);
        $uri = substr($uri, strlen($res["protocol"]));
        
        $indexUser = strpos($uri, "@");
        if (!$indexUser) {
            $indexUser = -1;
        }
        if ($indexUser > 0) {
            $res["user"] = substr($uri, 0, $indexUser);
            $uri = substr($uri, strlen($res["user"]) + 1);
        }
        
        $indexPortPath = strpos($uri, ":/");          
        if (!$indexPortPath) {
            $indexPortPath = -1;
        }
        if ($indexPortPath == 1) {
            $indexPort = strpos($uri, ":", 3);
            $indexPath = strpos($uri, "/", 3);
        } else {
            $indexPort = strpos($uri, ":");
            $indexPath = strpos($uri, "/");
        }
        if (!$indexPort) {
            $indexPort = -1;
        }
        if (!$indexPath) {
            $indexPath = -1;
        }
        if ($indexPath > 0) {
            $res["path"] = substr($uri, $indexPath + 1);
            $uri = substr($uri, 0, $indexPath);
        }
        if (array_key_exists($res["protocol"], $port))
            $res["port"] = $port[$res["protocol"]];
        if ($indexPort > 0) {
            $res["port"] = substr($uri, $indexPort + 1);
            $uri = substr($uri, 0, $indexPort);
        }
        
        $res["host"] = $uri;
        $uri = $res["path"];
        $indexFile = strrpos($uri, "/");
        if (!$indexFile) {
            $indexFile = -1;
        }
        $indexFile++;
        $uri = substr($uri, $indexFile);
        $res["file"] = $uri;
        $indexType = strrpos($uri, ".");
        if (!$indexType) {
            $indexType = -1;
        }
        $indexType++;
        if ($indexType > 0)
            $res["type"] = substr($uri, $indexType);
        return $res;
    }
}

?>