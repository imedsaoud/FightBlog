<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 24/03/2019
 * Time: 23:31
 */


$urlImg = $_FILES[3];
$maxsize =  8388608;

$extension_valide = array('jpg','png','jpeg','gif');
$extension_upload = strtolower(  substr(  strrchr($_FILES['postImg']['name'], '.')  ,1)  );
if ($_FILES['postImg']['error'] > 0) $erreur = "Erreur lors du Post";
if ($_FILES['postImg']['size'] > $maxsize) $erreur = "Le fichier est trop gros";
if ( !in_array($extension_upload,$extension_valide) ) echo "Fichier non conforme, les fichiers autorisés sont : jpg | png | jpeg | gif";

$nom = "../img/{$_FILES['postImg']['name']}";

$resultat = move_uploaded_file($_FILES['postImg']['tmp_name'],$nom);
if ($resultat) echo "Transfert réussi";

var_dump($nom);


$addPost =

$addPost = "INSERT INTO `subj` (
                       `title`,
                       `content`,
                       `img`,
                       `auteur_id`,
                       `date_publication`,
                       `category_id`
                   ) VALUES (
                       :task,
                       :url,
                       :priority,
                       :category,
                       :state
                   );";

$stmt = $pdo->prepare($addPost);
$stmt->bindValue(":task", $newtodo["task"],\PDO::PARAM_STR);
$stmt->bindValue(":url", $newtodo["url"] , \PDO::PARAM_STR);
$stmt->bindValue(":priority", $newtodo["priority"] , \PDO::PARAM_STR);
$stmt->bindValue(":category", $newtodo["category"] , \PDO::PARAM_STR);
$stmt->bindValue(":state", $newtodo["state"], \PDO::PARAM_STR);
$stmt->execute();

if ($stmt->errorCode() !== '00000') {
    echo "500 internal error";
}


