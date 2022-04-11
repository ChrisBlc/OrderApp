<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
         
        <nav class="nav" >
            <a href="index.php"> <img src="img/home.svg" style='height:40px' alt=""></a>
            <a href="panier.php"> <img src="img/cart.svg" style='height:40px' alt=""></a>
            <a href="staff.php"> <img src="img/gear.svg" style='height:40px' alt=""></a>

        </nav>
        <div class="title">
            <a href="index.php"><img class="logo_main" src="img/logogalway.png" alt="Logo du Galway" ></a>
            <h1 class="title_main"> THE GALWAY</h1>
            <h2>Irish Pub</h2>
        </div>
    </header>
