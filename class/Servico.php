<?php 
include_once "config/conexao.php";

class Servico {

    private $id;
    private $nome;
    private $descricao;
    private $preco;
    private $descontinuado;
    private $pdo;

    public function __construct(){
        $this->pdo = obterPdo();
    }
    
    public function setNome($nome){ $this->nome = $nome; }
    public function setDescricao($descricao){ $this->descricao = $descricao; }
    public function setPreco($preco){ $this->preco = $preco; }
    
    public function inserir():bool{
        $sql = "INSERT INTO servicos (nome, descricao, preco, descontinuado)
                VALUES (:nome, :descricao, :preco, 0)";

        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":descricao", $this->descricao);
        $cmd->bindValue(":preco", $this->preco);

        return $cmd->execute();
    }

    public function atualizar():bool{
        if(!$this->id) return false;

        $sql = "UPDATE servicos 
                SET nome = :nome, descricao = :descricao, preco = :preco
                WHERE id = :id";

        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $this->id);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":descricao", $this->descricao);
        $cmd->bindValue(":preco", $this->preco);

        return $cmd->execute();
    }
    
    public static function listar():array{
        $cmd = obterPdo()->query("SELECT * FROM servicos ORDER BY id DESC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function listarAtivos():array{
        $cmd = obterPdo()->query("SELECT * FROM servicos WHERE descontinuado = 0");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id):bool{
        $sql = "SELECT * FROM servicos WHERE id = :id";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->execute();

        if($cmd->rowCount() > 0){
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);

            $this->id = $dados['id'];
            $this->nome = $dados['nome'];
            $this->descricao = $dados['descricao'];
            $this->preco = $dados['preco'];

            return true;
        }
        return false;
    }
    
    public function excluir(int $id):bool{
        $sql = "UPDATE servicos SET descontinuado = 1 WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $id);

        return $cmd->execute();
    }
}