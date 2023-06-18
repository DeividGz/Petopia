<?php

function connection()
{
    $db_config = "mysql:host=localhost;dbname=petopia";
    $username = "root";
    $password = "";
    $conn = new PDO($db_config, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function dbError($error)
{
    $params = "";

    if (str_contains($error, "1062")) {
        $params = "erro=Chave duplicada";
    }

    if (str_contains($error, "1064")) {
        $params = "erro=Campo númerico com texto";
    }

    return $params;
}
