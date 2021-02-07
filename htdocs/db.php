<?php
$DBhost = "localhost";
$DBuser = "root";
$DBpass = "";
$DBname = "ipfinal";

$errors = array();

try {

    $db = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
} catch(PDOException $e) {
    echo $e->getMessage();
}
$db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'"); ?>