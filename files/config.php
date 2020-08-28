<?php

try {

     $db = new PDO("mysql:host=localhost;dbname=blog;charset=utf8", "root", "");

} catch ( PDOException $e ){

     print $e->getMessage();

}

$db->query("SET NAMES 'utf8'"); 
$db->query('SET CHARACTER SET utf8'); 

?>