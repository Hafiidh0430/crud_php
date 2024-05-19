<?php
try {
   $db = new PDO("mysql:host=127.0.0.1;dbname=login", "root", "");
} catch (Exception $error) {
  echo $error->getMessage();
};
