<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['data_nascimento'] = $_POST['data_nascimento'];
    $_SESSION['sexo'] = $_POST['sexo'];
    $_SESSION['cpf'] = $_POST['cpf'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['telefone'] = $_POST['telefone'];
    $_SESSION['empresa'] = $_POST['empresa'];
    $_SESSION['profissao'] = $_POST['profissao'];
    $_SESSION['cnpj'] = $_POST['cnpj'];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etapa 3 - Documentos e Endereço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Etapa 3 - Documentos e Endereço</h2>
    <form action="generate_pdf.php" method="post">
        <div class="mb-3">
            <label for="numero_identidade" class="form-label">Número da Identidade</label>
            <input type="text" class="form-control" id="numero_identidade" name="numero_identidade" required>
        </div>
        <div class="mb-3">
            <label for="tipo_documento" class="form-label">Tipo de Documento</label>
            <select type="text" class="form-select" id="tipo_documento" name="tipo_documento" required>
                <option value="" =>Selecione</option>
                <option value="RG">RG</option>
                <option value="DNI">DNI</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="orgao_expedidor" class="form-label">Órgão Expedidor</label>
            <input type="text" class="form-control" id="orgao_expedidor" name="orgao_expedidor" required>
        </div>
        <div class="mb-3">
            <label for="passaporte" class="form-label">Passaporte</label>
            <input type="text" class="form-control" id="passaporte" name="passaporte">
        </div>
        <div class="mb-3">
            <label for="rua" class="form-label">Rua</label>
            <input type="text" class="form-control" id="rua" name="rua" required>
        </div>
        <div class="mb-3">
            <label for="numero" class="form-label">Número</label>
            <input type="text" class="form-control" id="numero" name="numero" required>
        </div>
        <div class="mb-3">
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro" required>
        </div>
        <div class="mb-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" required>
        </div>
        <div class="mb-3">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" required>
        </div>
        <div class="mb-3">
            <label for="pais" class="form-label">País</label>
            <input type="text" class="form-control" id="pais" name="pais" required>
        </div>
        <button type="submit" class="btn btn-primary">Gerar PDF</button>
    </form>
</div>
</body>
</html>
