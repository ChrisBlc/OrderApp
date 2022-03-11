<?php
$pdo = new PDO('mysql:host=localhost;dbname=orderapp', 'root', 'tuchman64',[
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$categories = $pdo->query('SELECT categorie FROM categories')->fetchAll();
$diluants = $pdo->query('SELECT * FROM diluants')->fetchAll();