<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container text-center">
    <h1 class="mt-5">Admin Dashboard</h1>
    <a href="logout.php" class="btn btn-primary">Iniciar Cadastro</a>
    <a href="historico.php" class="btn btn-secondary">Ver Histórico</a>
</div>
</body>
</html>
