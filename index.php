<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['tipo'])) {
    header('Location: login.php');
    exit;
}

$tipo = $_SESSION['tipo'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container text-center">
    <h1 class="mt-5">Bem-vindo, <?= $_SESSION['nome'] ?></h1>

    <?php if ($tipo == 'admin'): ?>
        <p class="lead">Você está logado como Administrador</p>
        <a href="etapa1.php" class="btn btn-primary">Iniciar Cadastro</a>
        <a href="historico.php" class="btn btn-secondary">Ver Histórico</a>
    <?php else: ?>
        <p class="lead">Você está logado como Hóspede</p>
        <a href="etapa1.php" class="btn btn-primary">Iniciar Cadastro</a>
    <?php endif; ?>

    <!-- Botão de sair -->
    <a href="logout.php" class="btn btn-danger mt-3">Sair</a>
</div>

<?php if (isset($_GET['success'])): ?>
    <script>
        // Exibe uma mensagem de sucesso
        const popup = document.createElement('div');
        popup.textContent = 'Cadastro realizado com sucesso!';
        popup.style.position = 'fixed';
        popup.style.top = '20px';
        popup.style.right = '20px';
        popup.style.backgroundColor = '#4CAF50';
        popup.style.color = '#fff';
        popup.style.padding = '15px';
        popup.style.borderRadius = '5px';
        popup.style.zIndex = '1000';
        document.body.appendChild(popup);

        // Remove a mensagem após 3 segundos
        setTimeout(() => {
            popup.remove();
        }, 3000);
    </script>
<?php endif; ?>
</body>
</html>
