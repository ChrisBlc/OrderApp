<?php require 'elements/header.php';?>

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
                    <form action="" method="post">
                        <?php if (isset($produit['prix'])):?>
                            <label  ><?=  $produit['prix']?>€:</label>
                            <input class='item_quantity' type="number" min="0" max='50'>
                        <?php endif ?>
                        <?php if (isset($produit['prixDemi'])):?>
                            <label  >25cl | <?=  $produit['prixDemi']?>€:</label>
                            <input class='item_quantity' type="number" min="0" max='50' >
                        <?php endif ?>
                        <?php if (isset($produit['prixPinte'])):?>
                            <label >50cl| <?=$produit['prixPinte']?>€:</label>
                            <input class='item_quantity' type="number" min="0" max='50' >
                        <?php endif ?>
                        <?php if (isset($produit['prix2cl'])):?>
                            <label  >2cl| <?=$produit['prix2cl']?>€:</label>
                            <input class='item_quantity' type="number" value="0" min="0" >
                        <?php endif ?>
                        <?php if (isset($produit['prix4cl'])):?>
                            <label  >4cl| <?=$produit['prix4cl']?>€:</label>
                            <input class='item_quantity' type="number" value="0" min="0" max='50' >
                        <?php endif ?>
                        <?php if (isset($produit['tranche']) && $produit['tranche']==1 ):?>
                            <label >Tranche?</label>
                            <input type="checkbox" id="soft_tranche" value="softTranche" >
                        <?php endif ?>
                        <?php if (isset($produit['diluant'])):?>
                            <label for="diluant">Diluant</label>
                            <?php $diluants = $pdo->query("SELECT * FROM diluants")->fetchAll();?>
                            <select name='diluant' >
                                <?php foreach( $diluants as $diluant):?>
                                    <?php $diluant = $diluant['diluant'];?>
                                    <option name='diluant' style="color: black; font-family:'Bree Serif', serif"> <?=$diluant?> </option>
                                <?php endforeach?>
                            </select>
                        <?php endif ?>
                        <?php if (isset($produit['glace']) && $produit['glace']==1):?>
                            <label >Glace?</label>
                            <input type="checkbox" id="soft_tranche" value="softTranche" >
                        <?php endif ?>
                        <?php if (isset($produit['chantilly'])  && $produit['chantilly']==1):?>
                            <label >Chantilly? (1€)</label>
                            <input type="checkbox" id="soft_tranche" value="softTranche" >
                        <?php endif ?>
                        
                        <button class="menu_choice" onclick="">Ajouter</button>
                    </form>
                </div>
            </div>
        <?php endforeach ?>
    </div>
           
<?php require 'elements/footer.php' ?>