<?php 
    function enleverProduit(string $tableName, int $id){
        $pdo = new PDO('mysql:host=localhost;dbname=orderapp', 'root', 'tuchman64',[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        $deleteQuery = "DELETE FROM $tableName WHERE id = '$id' ";
        $remove = $pdo->query($deleteQuery);
        return $remove;
    }