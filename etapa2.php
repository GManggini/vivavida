<?php
// Recebe os dados da Etapa 1
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['data_nascimento'] = $_POST['data_nascimento'];
    $_SESSION['sexo'] = $_POST['sexo'];
    $_SESSION['cpf'] = $_POST['cpf'];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etapa 2 - Contato e Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Etapa 2 - Contato e Empresa</h2>
    <form action="etapa3.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
        </div>
        <div class="mb-3">
            <label for="empresa" class="form-label">Empresa</label>
            <input type="text" class="form-control" id="empresa" name="empresa">
        </div>
        <div class="mb-3">
            <label for="profissao" class="form-label">Profissão</label>
            <input type="text" class="form-control" id="profissao" name="profissao" >
        </div>
        <div class="mb-3">
            <label for="cnpj" class="form-label">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj">
        </div>
        <button type="submit" class="btn btn-primary">Próxima Etapa</button>
    </form>
</div>
</body>
</html>
