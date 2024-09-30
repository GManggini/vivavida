<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'hospede') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospede Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container text-center">
    <h1 class="mt-5">Hospede Dashboard</h1>
    <a href="etapa1.php" class="btn btn-primary">Iniciar Cadastro</a>
</div>
</body>
</html>
