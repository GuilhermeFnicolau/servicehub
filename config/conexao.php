<?php

function obterPdo():PDO{
$host = "127.0.0.1";
$db = "servicehubdb01";
$user = "root";
$pass = "123";
static $pdo;
try{
   $pdo = new PDO("mysl:host=$host;dbname=$db;charset=utf8",$user,$pass);
   $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   echo "conectado com sucesso!";
   var_dump($pdo);                                                 
}catch(PDOException $e){
    //var_dump($e->getMessage());
    die("Erro na conexão: ".$e->getMessage());
}
return $pdo;
}