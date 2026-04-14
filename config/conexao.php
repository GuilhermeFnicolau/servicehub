<?php

$host = "127.0.0.1";
$db = "servicehubdb01";
$user = "root";
$pass = "123";

try{
   $pdo = new PDO("mysl:host=$host;dbname=$db;charset=utf8",$user,$pass);
}catch(PDOException $e){
    die("Erro na conexão: ".$e->getMessage());
}