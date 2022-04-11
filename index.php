<?php   session_start();
       if (!isset($_SESSION['panier'])){
            $_SESSION['panier']= array();
            $_SESSION['panier']['name']= array();
            $_SESSION['panier']['quantity']= array();
            $_SESSION['panier']['price']= array();
            $_SESSION['panier']['diluant']= array();
            $_SESSION['panier']['tranche']= array();
            $_SESSION['panier']['glace']= array();
            $_SESSION['panier']['chantilly']= array();
       }
        require 'elements/header.php';
        require_once 'app/fonctionspaniers.php'
?>
<div class="main_menu">
    <form action="index.php#ancre" id='ancre' method="get">
    <?php foreach($categories as $categorie):?>
        <?php $categorie = $categorie['categorie'];?>
        <?php if ($categorie !== 'Diluants'):?>
            <button class="menu_choice <?php if(isset($_GET['cat']) && ($_GET['cat'] == toTableName($categorie))){ echo"active";}?>" name='cat' value='<?=toTableName($categorie)?>'> <?=$categorie?> </button>
        <?php endif?>
    <?php endforeach ?>
    </form>
</div>

<?php if(!isset($_GET['cat'])):?>
    <?php $tablename = 'bierespressions';
         $produits = $pdo->query("SELECT * FROM $tablename")->fetchAll();
    ?>
<?php else:?>
    <?php 
        $tablename = toTableName(htmlentities($_GET['cat']));
        $produits = $pdo->query("SELECT * FROM $tablename")->fetchAll();
    ?>
<?php endif ?>
<?php if (!empty($_POST)):?>
       <?php if (ajout($_POST)):?>
        <div class="alert alert-success">
            Produit ajouté au panier!
        </div>
        <?php endif ?>
<?php endif ?>
<div class="menu_container" style="display: block">
    <?php foreach($produits as $produit):?>
        <?php 
            $name = $produit['name'];
            $description = $produit['description'];
            $image = $produit['image'];
        ?>
        <div class="menu_item">
            <div class="item_description">
                <img src="photosProduits/<?=$image?>" alt="<?=$name?>" class="item_picture ">
                <h3 class="item_title"><?= $name?></h3>
                <p><?= $description?></p>  
            </div>
            <div class="item_selections">
                <div class="row">
                <?php if (isset($produit['prix'])):?>
                    <form action="#" class='col'  method="post">
                    <label  ><?=  $produit['prix']?>€:</label>
                    <input type="hidden" name="name" value="<?= $produit['name']?>">
                    <input type="hidden" name="price" value="<?= $produit['prix']?>">
                    <input type="hidden" name="glace" value="false">
                    <input type="hidden" name="diluant" value="false">
                    <input type="hidden" name="tranche" value="false">
                    <input type="hidden" name="chantilly" value="false">
                    <input class='item_quantity' name="quantity" type="number" min="0" max='50'>
                    <?php if (isset($produit['tranche']) && $produit['tranche']==1 ):?>
                        <label >Tranche?</label>
                        <input type="hidden" name="tranche" value="false">
                        <input type="checkbox" name="tranche" id="soft_tranche" value="true" >
                    <?php endif ?>
                    <?php if (isset($produit['glace']) && $produit['glace']==1):?>
                        <label >Glace?</label>
                        <input type="hidden" name="glace" value="false">
                        <input type="checkbox" name="glace" value="true">
                    <?php endif ?>
                    <?php if (isset($produit['chantilly'])  && $produit['chantilly']==1):?>
                        <label >Chantilly?</label>
                        <input type="hidden" name="chantilly" value="false">
                        <input type="checkbox" name="chantilly" value="true" >
                    <?php endif ?>
                    <button type='submit' class="menu_choice">Ajouter</button>
                    </form>
                <?php endif ?>
                <?php if (isset($produit['prixDemi'])):?>
                    <form action="" class='col' method="post">
                    <label  >25cl | <?=  $produit['prixDemi']?>€:</label>
                    <input type="hidden" name="name" value="<?= $produit['name'].' demi'?>">
                    <input type="hidden" name="price" value="<?= $produit['prixDemi']?>">
                    <input type="hidden" name="glace" value="false">
                    <input type="hidden" name="diluant" value="false">
                    <input type="hidden" name="tranche" value="false">
                    <input type="hidden" name="chantilly" value="false">
                    <input class='item_quantity' name="quantity" type="number" min="0" max='50' >
                    <button type='submit' class="menu_choice">Ajouter</button>
                    </form>
                <?php endif ?>
                <?php if (isset($produit['prixPinte'])):?>
                    <form action="" class='col' method="post">
                    <label >50cl| <?=$produit['prixPinte']?>€:</label>
                    <input type="hidden" name="name" value="<?= $produit['name'].' pinte'?>">
                    <input type="hidden" name="price" value="<?= $produit['prixPinte']?>">
                    <input class='item_quantity' name="quantity" type="number" min="0" max='50' >
                    <input type="hidden" name="glace" value="false">
                    <input type="hidden" name="diluant" value="false">
                    <input type="hidden" name="tranche" value="false">
                    <input type="hidden" name="chantilly" value="false">
                    <button type='submit' class="menu_choice">Ajouter</button>
                    </form>
                <?php endif ?>
                <?php if (isset($produit['prix2cl'])):?>
                    <form action="" class='col' method="post">
                    <label  >2cl| <?=$produit['prix2cl']?>€:</label>
                    <input type="hidden" name="glace" value="false">
                    <input type="hidden" name="diluant" value="false">
                    <input type="hidden" name="tranche" value="false">
                    <input type="hidden" name="chantilly" value="false">
                    <input type="hidden" name="name" value="<?= $produit['name'].' 2cl'?>">
                    <input type="hidden" name="price" value="<?= $produit['prix2cl']?>">
                    <input class='item_quantity' name="quantity" type="number"  min="0" >
                    <?php if (isset($produit['glace']) && $produit['glace']==1):?>
                        <label >Glace?</label>
                        <input type="checkbox" name="glace" value="true">
                    <?php endif ?>
                    <?php if (isset($produit['diluant'])):?>
                        <label for="diluant">Diluant</label>
                        <?php $diluants = $pdo->query("SELECT * FROM diluants")->fetchAll();?>
                        <select name='diluant' >
                            <?php foreach( $diluants as $diluant):?>
                                <?php $diluant = $diluant['diluant'];?>
                                <option name="diluant" style="color: black; font-family:'Bree Serif', serif"> <?=$diluant?> </option>
                            <?php endforeach?>
                        </select>
                    <?php endif ?>
                    <button type='submit' class="menu_choice">Ajouter</button>
                    </form>
                <?php endif ?>
                <?php if (isset($produit['prix4cl'])):?>
                    <form action="" class='col' method="post">
                    <label  >4cl| <?=$produit['prix4cl']?>€:</label>
                    <input type="hidden" name="name" value="<?= $produit['name'].' 4cl'?>">
                    <input type="hidden" name="price" value="<?= $produit['prix4cl']?>">
                    <input class='item_quantity' name="quantity" type="number" min="0" > 
                    <input type="hidden" name="glace" value="false">
                    <input type="hidden" name="diluant" value="false">
                    <input type="hidden" name="tranche" value="false">
                    <input type="hidden" name="chantilly" value="false">
                    <?php if (isset($produit['glace']) && $produit['glace']==1):?>
                        <label >Glace?</label>
                        <input type="checkbox" name="glace" value="true">
                    <?php endif ?>
                    <?php if (isset($produit['diluant'])):?>
                        <label for="diluant">Diluant</label>
                        <?php $diluants = $pdo->query("SELECT * FROM diluants")->fetchAll();?>
                        <select name='diluant' >
                            <?php foreach( $diluants as $diluant):?>
                                <?php $diluant = $diluant['diluant'];?>
                                <option name="diluant" style="color: black; font-family:'Bree Serif', serif"> <?=$diluant?> </option>
                            <?php endforeach?>
                        </select>
                    <?php endif ?>
                    <button type='submit' class="menu_choice">Ajouter</button>
                    </form>
                <?php endif ?>
                </div>                       
            </div>
        </div>
    <?php endforeach ?>
</div>
<aside>
    <a href="panier.php" class="boutonPanier" <?php if(!empty($_SESSION['panier']['name'])){echo"style='display:block'";}?>></a>
</aside>

 <?php require 'elements/footer.php' ?>