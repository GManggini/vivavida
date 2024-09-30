<?php
require_once 'db_connect.php'; // Arquivo de conexão ao banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    // Criptografar a senha
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo = 'hospede'; // Todos os novos usuários serão hóspedes por padrão

    // Inserção no banco de dados
    $query = "INSERT INTO users (nome, telefone, email, senha, tipo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $nome, $telefone, $email, $senha, $tipo);

    if ($stmt->execute()) {
        header('Location: login.php');
        exit;
    } else {
        $erro = "Erro ao criar conta!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criação de Conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container text-center">
    <h1 class="mt-5">Criar Conta</h1>
    <?php if (isset($erro)): ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>
    <form method="POST" action="register.php">
        <div class="mb-3">
            <input type="text" class="form-control" name="nome" placeholder="Nome Completo" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="telefone" placeholder="Telefone" required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="E-mail" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="senha" placeholder="Senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Criar Conta</button>
    </form>
</div>
</body>
</html>
