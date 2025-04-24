<?php
// crud_livros.php
include ('conexao2.php');

// Inserção
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {
    $titulo = $_POST['titulo'];
    $preco = $_POST['preco'];
    $imagem_url = $_POST['imagem_url'];
    $avaliacao = $_POST['avaliacao'];
    $quantidade_avaliacoes = $_POST['quantidade_avaliacoes'];

    $sql = "INSERT INTO livros (titulo, preco, imagem_url, avaliacao, quantidade_avaliacoes) VALUES ('$titulo', '$preco', '$imagem_url', '$avaliacao', '$quantidade_avaliacoes')";
    mysqli_query($conn, $sql);
    header('Location: crud.php');
    exit();
}

// Exclusão
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    mysqli_query($conn, "DELETE FROM livros WHERE id = $id");
    header('Location: crud.php');
    exit();
}

// Atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $preco = $_POST['preco'];
    $imagem_url = $_POST['imagem_url'];
    $avaliacao = $_POST['avaliacao'];
    $quantidade_avaliacoes = $_POST['quantidade_avaliacoes'];

    $sql = "UPDATE livros SET titulo='$titulo', preco='$preco', imagem_url='$imagem_url', avaliacao='$avaliacao', quantidade_avaliacoes='$quantidade_avaliacoes' WHERE id=$id";
    mysqli_query($conn, $sql);
    header('Location: crud.php');
    exit();
}

// Edição
$livro_editar = null;
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $result = mysqli_query($conn, "SELECT * FROM livros WHERE id = $id");
    $livro_editar = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD de Livros</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
  <h1 class="mb-4">Gerenciar Livros</h1>

  <form method="POST" class="mb-4">
    <?php if ($livro_editar): ?>
      <input type="hidden" name="id" value="<?= $livro_editar['id'] ?>">
    <?php endif; ?>
    <div class="row g-2">
      <div class="col-md">
        <input type="text" name="titulo" class="form-control" placeholder="Título" value="<?= $livro_editar['titulo'] ?? '' ?>" required>
      </div>
      <div class="col-md">
        <input type="text" name="preco" class="form-control" placeholder="Preço" value="<?= $livro_editar['preco'] ?? '' ?>" required>
      </div>
      <div class="col-md">
        <input type="text" name="imagem_url" class="form-control" placeholder="URL da Imagem" value="<?= $livro_editar['imagem_url'] ?? '' ?>" required>
      </div>
      <div class="col-md">
        <input type="number" name="avaliacao" class="form-control" placeholder="Avaliação" value="<?= $livro_editar['avaliacao'] ?? '' ?>" required step="0.1">
      </div>
      <div class="col-md">
        <input type="number" name="quantidade_avaliacoes" class="form-control" placeholder="Qtd. Avaliações" value="<?= $livro_editar['quantidade_avaliacoes'] ?? '' ?>" required>
      </div>
      <div class="col-md">
        <button type="submit" name="<?= $livro_editar ? 'editar' : 'adicionar' ?>" class="btn btn-<?= $livro_editar ? 'warning' : 'success' ?>">
          <?= $livro_editar ? 'Atualizar' : 'Adicionar' ?> Livro
        </button>
      </div>
    </div>
  </form>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Título</th>
        <th>Preço</th>
        <th>Imagem</th>
        <th>Avaliação</th>
        <th>Avaliações</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = mysqli_query($conn, "SELECT * FROM livros");
      while ($livro = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$livro['titulo']}</td>
                <td>R$" . number_format($livro['preco'], 2, ',', '.') . "</td>
                <td><img src='{$livro['imagem_url']}' alt='capa' width='60'></td>
                <td>{$livro['avaliacao']}</td>
                <td>{$livro['quantidade_avaliacoes']}</td>
                <td>
                  <a href=\"crud.php?editar={$livro['id']}\" class=\"btn btn-warning btn-sm\">
                Editar
              </a>
              <a href=\"crud.php?excluir={$livro['id']}\" class=\"btn btn-danger btn-sm\"
                 onclick=\"return confirm('Tem certeza que deseja excluir?');\">
                Excluir
              </a>
            </td>
            </tr>";
    }
      ?>
    </tbody>
  </table>
</body>
</html>
