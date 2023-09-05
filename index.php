<?php
// Configurações do banco de dados
require_once 'conexao.php';

// Inicialize a mensagem como vazia
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];

    try {
        $stmt = $pdo->prepare("INSERT INTO lutador (nome, idade, peso, altura)
                               VALUES (:nome, :idade, :peso, :altura)");
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':altura', $altura);
        
        $stmt->execute();

        $msg = "Cadastro realizado com sucesso!";
    } catch (PDOException $e) {
        $msg = "Erro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
</head>
<body>

    <div class="container mt-5">
        
        <a href="index2.php" class="btn btn-warning"><i class="bi bi-arrow-right"></i></a>

        <h2>Cadastro de Lutadores</h2>

        <!-- Exibir a mensagem de sucesso -->
        <?php if (!empty($msg)) : ?>
            <div class="alert alert-success" role="alert">
                <?= $msg ?>
            </div>
        <?php endif; ?>
   
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="number" class="form-control" id="idade" name="idade" required>
            </div>
            <div class="form-group">
                <label for="peso">Peso:</label>
                <input type="number" class="form-control" id="peso" step="0.01" name="peso" required>
            </div>
            <div class="form-group">
                <label for="altura">Altura:</label>
                <input type="number" class="form-control" id="altura" step="0.01" name="altura" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <div class="mt-3">
            
            </div>
        </form>
    </div>

    <script>
        // Limpar o formulário após a submissão
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('form').reset();
        });
    </script>
</body>
</html>
