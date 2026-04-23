<?php
// $senha = password_hash("123456",PASSWORD_DEFAULT);
// echo $senha;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "class/Usuario.php";

// testando update
$usuario = new Usuario();// objeto vazio
$usuario->buscarPorId(56);
if($usuario->atualizarSenha(password_hash("123456", PASSWORD_DEFAULT))){
    echo "Senha do usuário ".$usuario->getNome()." atualizada com sucesso!";
}