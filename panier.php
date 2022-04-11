<?php   session_start();
        require 'elements/header.php';
        require_once 'app/fonctionspaniers.php';
        require_once 'app/nomDansLePanier.php';

        $nbProduit = count($_SESSION['panier']['name']);
?>
<div class="container mt-3 mb-3">
    <?php if(isset($_POST['supprime'])):?>
       <?php  if ($_POST['supprime'] == 'all'):?>
           <?php
            $_SESSION['panier']= array();
            $_SESSION['panier']['name']= array();
            $_SESSION['panier']['quantity']= array();
            $_SESSION['panier']['price']= array();
            $_SESSION['panier']['diluant']= array();
            $_SESSION['panier']['tranche']= array();
            $_SESSION['panier']['glace']= array();
            $_SESSION['panier']['chantilly']= array();
            ?>
                <div class='alert alert-danger'>Panier vidé!</div>
        <?php else:?>
            <?php
            $toErase = (int)($_POST['supprime']);
            $_SESSION['panier']['name'][$toErase]= '';
            $_SESSION['panier']['quantity'][$toErase] = '';
            $_SESSION['panier']['price'][$toErase] = '';
            $_SESSION['panier']['diluant'][$toErase] = '';
            $_SESSION['panier']['tranche'][$toErase] = '';
            $_SESSION['panier']['glace'][$toErase] = '';
            $_SESSION['panier']['chantilly'][$toErase] = '';
            ?>
            <div class='alert alert-danger'>Produit enlevé!</div>
        <?php endif ?>
    <?php endif?>
    
    <table class="item_description table table-striped" style='text-align : center'>
        <thead>
            <th>Mes produits</th>
            <th>Prix unitaires</th>
            <th>Quantité</th>
            <th>Sous total</th>
        </thead>
        <tbody>
            <?php if (!empty($_SESSION['panier']['name'])):?>
                
                    <?php for ($i=0; $i<$nbProduit; $i++):?>
                        <?php if (!empty($_SESSION['panier']['name'][$i])):?>
                        <tr>
                            <td><?= $_SESSION['panier']['name'][$i]. toFullName($_SESSION, $i)?></td>
                            <td><?= $_SESSION['panier']['price'][$i]?></td>
                            <td><?= $_SESSION['panier']['quantity'][$i]?></td>
                            <td><?= ($_SESSION['panier']['price'][$i])*($_SESSION['panier']['quantity'][$i]).' €'?></td>
                            <td><form method="post"><button class='btn btn-danger' name='supprime' value='<?=$i?>'>Supprimer</button></form></td>
                        </tr>
                        <?php endif ?>
                    <?php endfor ?>
                    <tr>
                        <td colspan="3" style='text-align : end'> TOTAL</td>
                        <td><?= total($_SESSION).' €'?></td>
                        <td><form action="#" method="post"><button class='btn btn-danger' name='supprime' value='all'>Vider le panier</button></form></td>
                    </tr>
                    <tfoot>
                        <td colspan="5"><button class='btn btn-success' name='valide' value='all'>Commander et payer</button> </td>
                    </tfoot>
            <?php else: ?>
                <tr> <td colspan="4" style='text-align : center'> Votre panier est vide </td></tr>
            <?php endif?>
        </tbody>
        
    </table>
</div>





<?php require 'elements/footer.php' ?>