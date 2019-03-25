<?php

require_once 'php/connect.php' ;

$queryCategoryList1 = "SELECT
              `id`,
              `name`
         FROM
              `category`
               LIMIT 0 , 10
          ;";
$stmt1 = $pdo->prepare($queryCategoryList1);
$stmt1->execute();


$subj = "SELECT
            `id`,
            `title`,
            `content`,
            `img`,
            `date_publication`
         FROM
            `subj`
         ORDER BY `date_publication` LIMIT 4;";
$stmt2 = $pdo->prepare($subj);
$stmt2->execute();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="scss/reset.css" />
    <link rel="stylesheet" href="scss/home.css" />
    <title>Fight Blog</title>
  </head>
  <body>
    <header class="header">
      <h1 class="header__title">Fight Chan</h1>
    </header>

    <main>
      <section class="about">
        <h2 class="about__title">Fight chan ?</h2>
        <p class="about__text">
          FightBlog is a simple image-based bulletin board where anyone can post
          comments and share images about sport combat. There are boards
          dedicated to a variety of sport, from Judo and boxe to kung-fu, Muay
          thai.Users do not need to register an account before participating
          in the community. Feel free to click on a board below that interests
          you and jump right in!
        </p>
      </section>

      <section class="categorie">
        <h2 class="categorie__title">Categorie</h2>
        <div class="categorie__box">
          <ul class="categorie__list">

            <?php
                while($row = $stmt1->fetch(\PDO::FETCH_ASSOC)):
            ?>

            <li><a href="/page/singleCategorie.php?id=<?= $row['id']?>"><?=$row['name']?></a></li>

            <?php 
                endwhile;
            ?>

          </ul>

        </div>
      </section>



      <section class="lastPost">
        <h2 class="lastPost__title">Last Post</h2>
        <div class="lastPost__box">

            <?php
              while($row2 = $stmt2->fetch(\PDO::FETCH_ASSOC)):
            ?>
          <article class="subj">

            <h2><?=$row2["title"]?></h2>
            <a href="page/singleArticle.php?id=<?=$row2["id"]?>">
            <img class="judo" src="img/<?=$row2["img"]?>" />
            </a>
            <p>
                <?=$row2["content"]?>
            </p>

          </article>
            <?php
              endwhile;
            ?>

        </div>
      </section>
    </main>

    <footer>
      <p>plop</p>
    </footer>
  </body>
</html>
