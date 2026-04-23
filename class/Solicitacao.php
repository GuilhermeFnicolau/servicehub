<?php 
include_once "config/conexao.php";

class Solicitacao {

    private $id;
    private $cliente_id;
    private $descricao_problema;
    private $data_preferida;
    private $status;
    private $data_cad;
    private $data_atualizacao;
    private $data_resposta;
    private $resposta_admin;
    private $endereco;
    private $pdo;

    public function __construct(){
        $this->pdo = obterPdo();
    }
 
    public function setClienteId($cliente_id){ $this->cliente_id = $cliente_id; }
    public function setDescricaoProblema($descricao){ $this->descricao_problema = $descricao; }
    public function setDataPreferida($data){ $this->data_preferida = $data; }
    public function setEndereco($endereco){ $this->endereco = $endereco; }

    public function inserir():bool{
        $sql = "INSERT INTO solicitacoes 
        (cliente_id, descricao_problema, data_preferida, status, endereco, data_cad)
        VALUES (:cliente_id, :descricao, :data_preferida, 0, :endereco, NOW())";

        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":cliente_id", $this->cliente_id);
        $cmd->bindValue(":descricao", $this->descricao_problema);
        $cmd->bindValue(":data_preferida", $this->data_preferida);
        $cmd->bindValue(":endereco", $this->endereco);

        return $cmd->execute();
    }

    public static function listar():array{
        $cmd = obterPdo()->query("SELECT * FROM solicitacoes ORDER BY id DESC");
        
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listarPorCliente(int $cliente_id):array{
        $sql = "SELECT * FROM solicitacoes WHERE cliente_id = :id ORDER BY id DESC";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":id", $cliente_id);
        $cmd->execute();

        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

   
}
