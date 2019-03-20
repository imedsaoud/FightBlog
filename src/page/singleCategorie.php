<?php
require_once '../php/connect.php';

$query = "SELECT
          name 
          FROM
          Category
          ;";

$stmt = $pdo->prepare($query);
$stmt->execute();


if (!$id = intval($_GET["id"])) {
    echo '400';
    exit;
}

$query1 = "SELECT
            name
           FROM
           category;";

$query2 = "SELECT
            "


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
        <ul>
            <?php
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) :
            ?>
          <li><a href="singleCategorie.php"><?=$row['name']?></a></li>

            <?php
            endwhile;
            ?>
        </ul>
        <div><a href="../index.php">Home</a></div>
      
      <h1>TITLE OF THE CATEGORIE</h1>
    </header>

    <hr />
    <div class= "start">
      Start a new thread
    </div>
    <hr />

    <main>
      <article class = "subject">
            <div class= subject__img>
                <img src="../img/judo.jpeg" alt="Judo" />
                <div class = subject__content>
                    <div class= "subject__title">titlePost</div>
                    <div class = "subject__author">authorPost/date</div>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit unde
                      rerum quidem voluptates asperiores officia impedit id beatae expedita
                      labore ut neque reiciendis ducimus pariatur eveniet, eius aut
                      voluptatem perspiciatis?
                    </p>
                </div>
            </div>
            
            <a href="./singleArticle.html">Reply</a>
        
        
        <hr>
        <div class = "comment">Comment</div>
        <hr>
        <div class = "comment__box">
          <div class = "comment__author">Comment Author</div>
          <div class = "comment__date">23-05-1990</div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Exercitationem, quia esse! Perferendis eos reiciendis quibusdam
            ratione, quaerat ipsam recusandae unde libero sequi nulla
            perspiciatis, hic fuga earum corrupti deleniti. Et?
          </p>
        </div>
        <div class = "comment__box">
            <div class = "comment__author">Comment Author</div>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Exercitationem, quia esse! Perferendis eos reiciendis quibusdam
              ratione, quaerat ipsam recusandae unde libero sequi nulla
              perspiciatis, hic fuga earum corrupti deleniti. Et?
            </p>
          </div>
          <div class = "comment__box">
              <div class = "comment__author">Comment Author</div>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Exercitationem, quia esse! Perferendis eos reiciendis quibusdam
                ratione, quaerat ipsam recusandae unde libero sequi nulla
                perspiciatis, hic fuga earum corrupti deleniti. Et?
              </p>
            </div>
      </article>

    </main>
  </body>
</html>