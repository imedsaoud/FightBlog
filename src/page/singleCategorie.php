<?php
require_once '../php/connect.php';


if ( !$id = intval($_GET["id"])) {
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
            `date_publication`,
            `id`
         FROM
            `subj`
         WHERE category_id = :category_id;";
$stmt2 = $pdo->prepare($subj);
$stmt2->bindValue(":category_id",$id);
$stmt2->execute();


$stmt4 = $pdo->prepare($subj);
$stmt4->bindValue(":category_id",$id);
$stmt4->execute();
$row4 = $stmt4->fetch(\PDO::FETCH_ASSOC);
$hh = $row4["id"];

$com = "SELECT
            content,
            date_comment,
            auteur_id
        FROM
            comment
        WHERE subj_id = :id
        ;";

$stmt3 = $pdo->prepare($com);
$stmt3->bindValue(":id",$hh);
$stmt3->execute();
/*
if(count($_POST) > 0){
    $addSubj = "INSERT INTO subj
                 (`title`,
                  `content`,
                  `img`,
                  `date_publication`,
                  `category_id`,
                  `auteur_id`)
            VALUES
               (:title,
                :content,
                :img,
                 Now(),
                :category_id,
                :auteur_id);";

    $stmt5 = $pdo->prepare($addSubj);
    $stmt5->bindValue(":title",$_POST["title"]);
    $stmt5->bindValue(":content",$_POST["content"]);
    $stmt5->bindValue(":img",$_POST["img"]);
    $stmt5->bindValue(":category_id",$_GET["id"]);
    $stmt5->bindValue(":auteur_id", 1);
    $stmt5->execute();
}


$addcom = "INSERT INTO comment
                 (`auteur_id`,
                  `content`,
                  `date_comment`,
                  `subj_id`
                  )
            VALUES
               (:auteur_id,
                :content,
                Now(),
                :subj_id);";
$stmt6 = $pdo->prepare($addcom);
$stmt6->bindValue(":content",$_POST["content"]);
$stmt6->bindValue(":subj_id",$hh);
$stmt6->bindValue(":auteur_id",1);
*/
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
    <div class="formular">
        <div class= "start"> Start a new thread</div>

        <form action="../page/singleCategorie.php" method="post" enctype="multipart/form-data" class="formSend">
            <div class="formSend__pseudo">
                <label for="pseudo">Entrer votre pseudo: </label>
                <input type="text" name="pseudo" id="pseudo" required>
            </div>
            <div class="formSend__img">
                <label for="img">Image du post : </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="12345" />
                <input type="file" name="img" id="img" required>
            </div>
            <div class="formSend__title">
                <label for="title">Titre du post: </label>
                <input type="text" name="title" id="title" required>
            </div>
            <textarea name="content" rows="10" cols="50">Vous pouvez écrire ici.</textarea>
            <div class="formSend__submit">

                <input type="submit">
            </div>
        </form>
    </div>

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
                    <p><?=$rowsubj["content"]?></p>
                </div>
            </div>
            <a href="singleArticle.php?id=<?=$rowsubj["id"]?>">Reply</a>

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
        <script src="../js/main.js"></script>
    </main>
  </body>
</html>
