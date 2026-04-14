<?php
include_once "config/conexao.php";

$sql = "select * from servicos";
$cmd = $pdo->prepare($sql);
$cmd->execute();

$sql = "select * from usuarios";
$cmd = $pdo->prepare($sql);
$cmd->execute();

$sql = "select * from clientes";
$cmd = $pdo->prepare($sql);
$cmd->execute();

$servicos = $cmd->fetchAll(PDO::FETCH_ASSOC);
$clientes = $cmd->fetchAll(PDO::FETCH_ASSOC);
$usuarios = $cmd->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Aula PDO PHP</title>
</head>

<body>
    <h2>Lista de Serviços</h2>
    <table border="1" cellpadding=10>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Descontinuado</th>
        </tr>
        <?php foreach ($servicos as $servicos): ?>
            <tr>
                <td><?= $servicos['id'] ?></td>
                <td><?= $servicos['nome'] ?></td>
                <td><?= $servicos['descricao'] ?></td>
                <td><?= $servicos['preco'] ?></td>
                <td><?= $servicos['descontinuado'] ? "Sim" : "Não" ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Lista de Clientes</h2>
    <table border="1" cellpadding=10>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cpf</th>
            <th>Email</th>
        </tr>
        <?php foreach ($clientes as $clientes): ?>
            <tr>
                <td><?= $clientes['id'] ?></td>
                <td><?= $clientes['nome'] ?></td>
                <td><?= $clientes['cpf'] ?></td>
                <td><?= $clientes['email'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Lista de Usuarios</h2>
    <table border="1" cellpadding=10>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Senha</th>
        </tr>
        <?php foreach ($usuarios as $usuarios): ?>
            <tr>
                <td><?= $clientes['id'] ?></td>
                <td><?= $clientes['nome'] ?></td>
                <td><?= $clientes['email'] ?></td>
                <td><?= $clientes['senha'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <form action="resform.php" method="post">
        <input type="text" name="txtid" id="">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>