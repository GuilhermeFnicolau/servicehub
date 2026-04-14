<?php

include_once "config/conexao.php";

$id = $_POST['txtid'];
$sql = "select nome from servicos where id = :id";
$cmd = $pdo->prepare($sql);
$cmd->execute([":id"=>$id]);
$serv = $cmd->fetch(PDO::FETCH_ASSOC);

?>
<h2>Nome do serviço: <?= $serv['nome'] ?></h2>