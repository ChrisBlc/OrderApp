<?php 

/**
 * ajoutAuPanier ajoute le contenu du $select ($_POST) au panier en session, ou modifie la quantité si le produit est déjà dans le panier 
 *
 * @param  mixed $select
 * @return boolean 
 */
function ajout($select)
{
    $ajout = false;
        if (!empty($select['quantity']))
        {
            if(compareDetail($select) === false)
            {
                array_push($_SESSION['panier']['name'], $select['name']);                
                array_push($_SESSION['panier']['price'],$select['price']);
                array_push($_SESSION['panier']['quantity'], $select['quantity']);
                array_push($_SESSION['panier']['diluant'], $select['diluant']);
                array_push($_SESSION['panier']['glace'], $select['glace']);
                array_push($_SESSION['panier']['tranche'], $select['tranche']);
                array_push($_SESSION['panier']['chantilly'], $select['chantilly']);
                $ajout = true;
            }
            else
            {
                $indexToChange = compareDetail($select);
                $_SESSION['panier']['quantity'][$indexToChange] += $select['quantity'];
                $ajout = true;
            }
        }
    

    return $ajout;
}



/**
 * compareDetail, retourne l'index de l'item dans le panier s'il existe deja (en comparant tout les details) et retourne false sinon
 *
 * @param  mixed $produit $_POST
 */
function compareDetail($produit){
    $nbProduits = count($_SESSION['panier']['name']);
    $present = false;
    for ($i=0; $i<$nbProduits; $i++ ){
        $name = false;
        $tranche = false;
        $glace = false;
        $diluant = false;
        $chantilly = false;
            if ($produit['name'] == $_SESSION['panier']['name'][$i]){
                    $name = true;
            }
            if ($produit['tranche'] == $_SESSION['panier']['tranche'][$i]){
                $tranche = true;
            }
            if ($produit['glace'] == $_SESSION['panier']['glace'][$i]){
                $glace = true;
            }
            if ($produit['diluant'] == $_SESSION['panier']['diluant'][$i]){
                $diluant = true;
            }
            if ($produit['chantilly'] == $_SESSION['panier']['chantilly'][$i]){
                $chantilly = true;
            }
            if ($name == true && $tranche == true  && $glace == true  && $diluant == true && $chantilly == true){
            $present = $i;
            break;
            }
    }
    return $present;
}