<?php
require_once '../php/connect.php';


if (!$id = intval($_GET["id"])) {
    echo '400';
    exit;
}

$query = "SELECT
              `id`,
              `name` 
          FROM
              `category`
          ;";

$stmt = $pdo->prepare($query);
$stmt->execute();



$titleCat = "SELECT
                `name`
            FROM
              `category`
            WHERE 
              `id` = :id
             ;";

$stmt1 = $pdo->prepare($titleCat);
$stmt1->bindValue(":id",$id);
$stmt1->execute();
$row1 = $stmt1->fetch(\PDO::FETCH_ASSOC);

$subj = "SELECT
            `title`,
            `content`,
            `img`,
            `date_publication`
         FROM
            `subj`
         WHERE category_id = :category_id;";
$stmt2 = $pdo->prepare($subj);
$stmt2->bindValue(":category_id",$id);
$stmt2->execute();

$com = "SELECT
            content,
            date_comment,
            auteur_id
        FROM
            comment
        WHERE subj_id = :subj_id
        ;";

$stmt3 = $pdo->prepare($com);
$stmt3->bindValue(":subj_id",$id);
$stmt3->closeCursor();
$stmt3->execute();



?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="../scss/reset.css" />
    <link rel="stylesheet" href="../scss/singleCategorie.css" />
    <title>Fight Blog</title>
  </head>
  <body>

    <header>

      <h3>catégorie</h3>
        <ul
            <?php
                while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) :
            ?>

            <li><a href="singleCategorie.php?id=<?= $row['id']?>"><?=$row['name']?></a></li>

            <?php
                endwhile;
            ?>
        </ul>
        <div><a href="../index.php">Home</a></div>
      
      <h1><?= $row1['name']?></h1>
    </header>

    <hr />
    <div class= "start"> Start a new thread</div>
    <hr />

    <main>

      <article class = "subject">

          <?php
            while ($rowsubj = $stmt2->fetch(\PDO::FETCH_ASSOC)) :
          ?>
            <div class= subject__img>
                <img src='../img/<?= $rowsubj["img"]?>' alt="Judo" />
                <div class = subject__content>
                    <div class= "subject__title"><?=$rowsubj["title"]?></div>
                    <div class = "subject__author"><?=$rowsubj["date_publication"]?></div>
                    <p>
                        <?=$rowsubj["content"]?>
                    </p>
                </div>
            </div>
            <a href="singleArticle.php">Reply</a>


            <?php
            endwhile;
            ?>
          <hr>

          <div class = "comment">Comment</div>
          <hr>
          <?php
          while ($coms = $stmt3->fetch(\PDO::FETCH_ASSOC)) :
          ?>


        <div class = "comment__box">
          <div class = "comment__author">ID: <?= $coms["auteur_id"]?></div>
          <div class = "comment__date"> Date: <?= $coms["date_comment"]?></div>
          <p>
            <?=$coms["content"]?>
          </p>
        </div>
          <?php
          endwhile;
          ?>


      </article>

    </main>
  </body>
</html>
