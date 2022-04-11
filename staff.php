<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>Order App</title>
</head>
<body style='background: rgb(4, 68, 12)'>
    <header class="header">
        <?php require "vendor/autoload.php";
        require 'app/createForm.php';
        require 'app/toTableName.php';
        require 'app/addToSql.php';
        require 'app/enleverProduit.php';
        require 'app/pdo.php';
        $admin = [
            'id' => 'master',
            'password' => 'motdepasse']; 
        ?>
         
        <nav class="nav">
            <a href="app/disconnect.php"> <img src="img/door.svg" style='height:40px' alt=""></a>
        </nav>
        <div class="title">
            <img class="logo_main" src="img/logogalway.png" alt="Logo du Galway" >
            <h1 class="title_main"> THE GALWAY</h1>
            <h2>Irish Pub</h2>
        </div>
    </header>   

    <?php
        if (!isset($_SESSION['id'])){
            require 'login.php';
        } else if (($_SESSION['id']== $admin['id']) && ($_SESSION['password']== $admin['password'])){
            $loggedUser = true;
        }else {require 'login.php';
        }
    ?>



<body>
    <?php if(isset($loggedUser)): ?>
        <div class="container mt-3 mb-3">
            <form action="#" class="form-control mb-3" method="get">
                <label for="cat">Choisissez une catégorie:</label>
                <select name='cat' class="form-select" value="<?=htmlentities($_GET['cat']?? '')?>">
                    <?php foreach($categories as $categorie):?>
                    <option <?php if(isset($_GET['cat']) && ($_GET['cat'] == $categorie['categorie'])){ echo"selected";} ?>>
                    <?= $categorie['categorie']?>
                    </option>
                    <?php endforeach?>
                </select>
            <button class="btn btn-info mb-3 mt-3">Valider</button>
            </form>


            <?php if (!empty($_GET['cat'])):?>
                <?php $tableName = toTableName(noAccent(($_GET['cat'])));?>
                <?php if (($_GET['cat']) === 'Diluants'):?>
                    <form action='' class='form-control' method='POST'>
                    <label for='diluants'>Diluants</label>
                    <input class='me-4' type='text' name='diluants' placeholder='Diluants disponible' required>
                    <button class='btn btn-info mb-3 mt-3'>Valider</button>
                    </form>";
                    <?php  if (!empty($_POST)){
                        $query = "INSERT INTO diluants (id,diluant) VALUES (null,'$_POST[diluants]')";
                        $add = $pdo->query($query);
                    }?>
                <?php else : ?>
                        <?php 
                            if (!empty($_GET['cat'])){
                                echo createForm($tableName);
                                if (!empty($_POST)){
                                $add = addToSql($tableName, $_POST);
                                }
                            }
                        ?>               
                        <br>
                        <button class="btn btn-info mb-3 mt-3">Valider</button>
                    </form> 
                <?php endif?>
            <?php endif?>


            <?php if(isset($add)):?>
                <div class="alert alert-success">Produit ajouté</div>
            <?php endif?>
            
            <?php if(isset($_GET['id'])):?>
                <?php enleverProduit($tableName, $_GET['id'])?>
                <div class="alert alert-danger">Produit supprimé</div>
            <?php endif ?>
            
            
            <?php if (!empty($_GET)):?>
                <?php $tableName = toTableName($_GET['cat']);
                    $donnees = $pdo->query("SELECT * FROM $tableName")->fetchAll();
                    $titres = $pdo->query("SELECT COLUMN_NAME
                    FROM INFORMATION_SCHEMA.COLUMNS
                    WHERE TABLE_NAME = '$tableName' order by ORDINAL_POSITION ")->fetchAll();
                ?>
                <table class="table table-dark table-striped">
                        <thead>
                            <h2 style='color: white;'> MES <?= htmlentities( strtoupper(noAccent($_GET['cat'])))?> </h2>
                            <tr>
                                <?php foreach($titres as $titre):?>
                                    <th><?= $titre['COLUMN_NAME'] ?></th>
                                <?php endforeach ?>
                                <th></th>
                            </tr>
                        </thead>
                    <tbody>
                            <?php foreach($donnees as $donnee):?>
                                <tr>
                                    <?php foreach($titres as $titre):?>
                                        <td><?=$donnee[$titre['COLUMN_NAME']]?></td>
                                    <?php endforeach ?>  
                                    <td>
                                        <form action="" method="get">
                                            <input type="hidden" name="cat" value="<?php echo $_GET['cat']; ?>">
                                            <button class='btn btn-danger' name='id' value='<?= $donnee['id']?>'>Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach?>
                    </tbody>
                </table>
            <?php endif ?>
    
        </div>
    <?php endif ?>
</body>
</html>











