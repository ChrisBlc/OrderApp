<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>Order App</title>
</head>
<body>
    <header class="header">
        <?php require "vendor/autoload.php";
        require 'app/createForm.php';
        require 'app/toTableName.php';
        require 'app/addToSql.php';
        require 'app/enleverProduit.php';
        require 'app/pdo.php';
        ?>
         
        <nav >
            <a class="nav"  href=""> <img src="img/lock.png" style='height:40px' alt=""></a>
        </nav>
        <div class="title">
            <img class="logo_main" src="img/logogalway.png" alt="Logo du Galway" >
            <h1 class="title_main"> THE GALWAY</h1>
            <h2>Irish Pub</h2>
        </div>
    </header>
