<?php
try {
  $pdo = new \PDO("mysql:dbname=fightblog;port=3306;host=127.0.0.1","root", "root");
  $pdo->setAttribute( \PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);
  $pdo->exec("SET NAMES UTF8");

} catch(\Error $e) {
  die("One two three ...");

}
