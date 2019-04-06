<?php
require_once '../php/connect.php';

if (!$id = intval($_GET["id"])) {
    echo '400';
    exit;
}
$queryCategoryList = "SELECT
                        `id`,
                        `name` 
                      FROM
                        `category`
                      ;";
$stmt = $pdo->prepare($queryCategoryList);
$stmt->execute();


$subj = "SELECT
            `title`,
            `content`,
            `img`,
            `date_publication`,
            `category_id`
         FROM
            `subj`
         WHERE 
            `id` = :id
         ;";
$stmt1 = $pdo->prepare($subj);
$stmt1->bindValue(":id",$id);
$stmt1->execute();

$com = "SELECT
            `content`,
            `date_comment`,
            `auteur_id`
        FROM
            `comment`
        WHERE 
            `subj_id` = :subj_id
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
    <link rel="stylesheet" href="../scss/singleArticle.css" />
    <title>Fight Blog</title>
  </head>
  <body>

    <header>
        <h3>catégorie</h3>
        <ul>
            <?php
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) :
                ?>

                <li><a href="./singleCategorie.php?id=<?= $row['id']?>"><?=$row['name']?></a></li>

            <?php
            endwhile;
            ?>
        </ul>

    </header>

    <hr />

    <div class = "formular">
        <div class= "reply">Post a reply</div>
        <form action="../php/add.php" method="post" enctype="multipart/form-data" class="comSend">
            <div class="formSend__pseudo">
                <label for="pseudo">Entrer votre pseudo: </label>
                <input type="text" name="pseudo" id="pseudo" required>
            </div>
            <textarea name="textarea" rows="10" cols="50">Vous pouvez écrire un commentaire ici.</textarea>
            <div class="formSend__submit">
                <input type="submit">
            </div>
        </form>
    </div>
    <hr />

    <main>
        <article class = "subject">

            <?php
            while ($row1 = $stmt1->fetch(\PDO::FETCH_ASSOC)) :
                ?>
                <div class= subject__img>
                    <img src='../img/<?= $row1["img"]?>' alt="Judo" />
                    <div class = subject__content>
                        <div class= "subject__title"><?=$row1["title"]?></div>
                        <div class = "subject__author"><?=$row1["date_publication"]?></div>
                        <p>
                            <?=$row1["content"]?>
                        </p>
                    </div>
                </div>
                <div><a href="singleCategorie.php?id=<?=$row1["category_id"] ?>">return</a></div>
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

            <?php
            endwhile;
            ?>




        </article>

    </main>
    <script src="../js/main.js"></script>
  </body>
</html>
