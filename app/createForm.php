<?php
require "vendor/autoload.php";
/**
 * choixUniques
 *
 * @param  string $choisis nom de la table voulu
 * @return void
 */
function createForm(string $choisis)
{
require "pdo.php";
$columnsTitlesQuery="SELECT COLUMN_NAME
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = '$choisis' order by ORDINAL_POSITION";
$titles = $pdo->query($columnsTitlesQuery)->fetchAll();
$pickable= [];
foreach ($titles as $title){
    if ($title['COLUMN_NAME'] != 'id' && $title['COLUMN_NAME'] != 'name' && $title['COLUMN_NAME'] != 'description'&& $title['COLUMN_NAME'] != 'image' ){
        $pickable[] = $title['COLUMN_NAME'] ;
    }
}
$html ="<form action=''  class='form-control' method='POST'>
<label for='name'>Nom du produit</label>
<input type='text' class='form-control' name='name' placeholder='Mon super produit' required >
<label for='description'>Description du produit</label>
<textarea class='form-control mb-3' name='description' placeholder='Voici mon super produit' required ></textarea>
<label for='image' class='form-label'>Photo du produit</label>
<input class='form-control mb-3' type='file' name='image'>";
foreach ($pickable as $pick){
    if( str_starts_with($pick, 'prix')){
        $html = $html."
            <label for='{$pick}'>$pick</label>
            <input class='me-4' type='number' step='0.1' name='{$pick}' placeholder='€.€' required>";
    } else $html = $html."
        <input type='radio' id='$pick' name='$pick' value='1' checked>
        <label  class='me-4' for='$pick'>Demander $pick</label>
        <input type='radio' id='$pick' name='$pick' value='0'>
        <label  class='me-4' for='$pick'> Ne pas demander $pick</label>";    
}
return $html;

}