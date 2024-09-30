<?php
session_start();
include 'db_connect.php'; // arquivo que contém sua conexão ao banco de dados

// Se o usuário já estiver logado, redireciona para a página principal
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Query para verificar se o usuário existe
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Pega os dados do usuário
        $user = $result->fetch_assoc();

        // Verifica se a senha inserida corresponde à senha hash armazenada
        if (password_verify($senha, $user['senha'])) {
            // Armazena os dados do usuário na sessão
            $_SESSION['tipo'] = $user['tipo'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['usuario_id'] = $user['id'];

            // Redireciona para a tela inicial com base no tipo de usuário
            header('Location: index.php');
            exit;
        } else {
            $erro = "E-mail ou senha incorretos!";
        }
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container text-center">
    <h1 class="mt-5">Login</h1>
    <?php if (isset($erro)): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" id="senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>

    <!-- Botão para criar conta -->
    <div class="mt-3">
        <p>Não tem uma conta? <a href="register.php" class="btn btn-secondary">Criar Conta</a></p>
    </div>
</div>
</body>
</html>
