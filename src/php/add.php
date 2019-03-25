<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 24/03/2019
 * Time: 23:31
 */

var_dump($_FILES);

$maxsize =  8388608;

$extension_valide = array('jpg','png','jpeg','gif');
$extension_upload = strtolower(  substr(  strrchr($_FILES['img']['name'], '.')  ,1)  );




if ($_FILES['img']['error'] > 0) $erreur = "Erreur lors du Post";
if ($_FILES['img']['size'] > $maxsize) $erreur = "Le fichier est trop gros";
if ( !in_array($extension_upload,$extension_valide) ) echo "Fichier non conforme, les fichiers autorisés sont : jpg | png | jpeg | gif";


$nom = "../img/{$_FILES['img']['name']}.{$extension_upload}";
$resultat = move_uploaded_file($_FILES['img']['tmp_name'],$nom);
if ($resultat) echo "Transfert réussi";

