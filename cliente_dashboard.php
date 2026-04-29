<?php
session_start();

require_once "config/conexao.php";
require_once "includes/funcoes.php";
require_once "class/Cliente.php";

$pdo = obterPdo();

if (!isset($_SESSION['usuario_id']) || $_SESSION["tipo"] != 2) {
  header("location: login.php");
  exit;
}

$cliente = new Cliente;

if (!$cliente->buscarPorId($_SESSION["usuario_id"])) {
  die("Cliente não encontrado");
}

$sql = "SELECT s.id, s.status, s.data_cad,
        GROUP_CONCAT(se.nome SEPARATOR ',') AS servicos
        FROM solicitacoes s 
        INNER JOIN servico_solicitacao ss ON ss.solicitacoes_id = s.id
        INNER JOIN servicos se ON se.id = ss.servicos_id
        WHERE s.cliente_id = ?
        GROUP BY s.id, s.status, s.data_cad
        ORDER BY s.data_cad DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$cliente->getId()]);
$solicitacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

include "includes/header.php";
include "includes/menu.php";
?>

<main class="container mt-5">
  <h2>Bem-vindo, <?= $_SESSION['nome'] ?></h2>
  <p><a href="logout.php" class="btn btn-danger btn-sm">Sair</a></p>
  <a href="cliente_perfil.php" class="btn btn-warning btn-sm">Meu Perfil</a>

  <h4 class="mt-4">Minhas Solicitações</h4>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Serviços</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($solicitacoes as $s): ?>
      <tr>
        <td><?= $s["id"] ?></td>

        <!-- SERVIÇOS (CORRIGIDO) -->
        <td>
          <?php
          $lista = explode(",", $s["servicos"]);
          foreach ($lista as $nomeServico) {
            echo '<span class="badge bg-primary me-1 mb-1">' .
              htmlspecialchars($nomeServico) . '</span>';
          }
          ?>
        </td>

        <td>
          <?php statusTexto($s["status"]) ?>
        </td>

        <td>
          <?= date("d/m/Y H:i", strtotime($s["data_cad"])) ?>
        </td>

        <td>
          <a href="cliente_detalhes.php?id=<?= $s['id'] ?>" class="btn btn-primary btn-sm">
            Detalhes
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>

<?php include "includes/footer.php"; ?>