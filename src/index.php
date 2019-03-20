<?php

require_once 'php/connect.php' ;

$query = "SELECT
              id,
              name
         FROM
              category
              LIMIT 5
          ;";

$query1 = "SELECT
              id,
              name
          FROM
              category
              LIMIT 5 , 10 
          ;";


$stmt = $pdo->prepare($query);
$stmt->execute();

$stmt1 = $pdo->prepare($query1);
$stmt1->execute();

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
          thai, . Users do not need to register an account before participating
          in the community. Feel free to click on a board below that interests
          you and jump right in!
        </p>
      </section>

      <section class="categorie">
        <h2 class="categorie__title">Categorie</h2>
        <div class="categorie__box">
          <ul class="categorie__list">

            <?php
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)):     
            ?>

            <li><a href="/page/singleCategorie.php?=<?= $row['id']?>"><?=$row['name']?></a></li>

            <?php 
            endwhile;
            ?>

          </ul>

          <ul class="categorie__list">

            <?php
             while($row1 = $stmt1->fetch(\PDO::FETCH_ASSOC)):
             ?>

             <li><a href="/page/singleCategorie.php?=<?= $row1['id']?>"><?=$row1['name']?></a></li>

            <?php
            endwhile;
            ?>

          </ul>
        </div>
      </section>

      <section class="lastPost">
        <h2 class="lastPost__title">Last Post</h2>
        <div class="lastPost__box">
          <article class="movie">
            <h2>Judo</h2>
            <img class="judo" src="img/judo.jpeg" />
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga id
              inventore a ducimus totam!
            </p>
          </article>
          <article class="movie">
            <h2>Judo</h2>
            <img class="judo" src="img/judo.jpeg" />
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga id
              inventore a ducimus totam!
            </p>
          </article>
          <article class="movie">
            <h2>Judo</h2>
            <img class="judo" src="img/judo.jpeg" />
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga id
              inventore a ducimus totam!
            </p>
          </article>
          <article class="movie">
            <h2>Judo</h2>
            <img class="judo" src="img/judo.jpeg" />
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga
              idinventore a ducimus totam!
            </p>
          </article>
        </div>
      </section>
    </main>

    <footer>
      <p>plop</p>
    </footer>
  </body>
</html>
