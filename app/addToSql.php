<?php

/**
 * AddToSql ajoute le contenu du formulaire sur la table correspondante
 *
 * @param  string $table nom de la table 
 * @param  array $data =  $_post contenant les infos  
 * @return boolean success or not 
 */

function addToSql(string $table, array $data)
{
    $pdo = new PDO('mysql:host=localhost;dbname=orderapp', 'root', 'tuchman64',[
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    $donneesEntrees =  '"'.implode('","', array_values($data)).'"';
    $query = "INSERT INTO $table VALUES (null, $donneesEntrees)";
    $add = $pdo->query($query);
    return $add;
}