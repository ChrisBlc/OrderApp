<?php 

function toFullName($select, $i){
    $name = '';
    if ($select['panier']["diluant"][$i] !== 'false'){
        $name .=' '.$_SESSION['panier']['diluant'][$i];
    }
    if ($select['panier']["glace"][$i] !== 'false'){
        $name .= "-glace";
    }
    if ($select['panier']["tranche"][$i] !== 'false'){
        $name .= "-tranche";
    }
    if ($select['panier']["chantilly"][$i] !== 'false'){
        $name .= "-chantilly";
    }
    return $name;
}

function total($select){
    $total = 0;
    for ($i=0; $i<count($select['panier']['price']); $i++){
        if (!empty($select['panier']['price'][$i])){
            $total += ($select['panier']['price'][$i])*($select['panier']['quantity'][$i]);
        }
    }
    return $total;
}