<?php
//attempts to connect to database
try {
  $dsn = 'mysql:host=localhost; dbname=sportinggoodsemporiumdatabase';
  $db = new PDO($dsn, "sportinggoodsemporium", "PASSWORD_PLACEHOLDER");

  // set the PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

//outputs error if db connection fails
catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
