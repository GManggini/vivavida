<?php
include 'db_connect.php';

$id = $_GET['id'];
$tabela = $_GET['tabela'];

if ($tabela == 'hospedes') {
    $sql = "SELECT * FROM hospedes WHERE id = $id";
    $result = $conn->query($sql);
    $dados = $result->fetch_assoc();

    // Montar campos adicionais para hospedes
    $dados['extra_fields'] = '<div class="mb-3">
                                <label for="edit_cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="edit_cpf" name="cpf" value="' . $dados['cpf'] . '">
                              </div>';
} else {
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);
    $dados = $result->fetch_assoc();

    // Montar campos adicionais para users
    $dados['extra_fields'] = '<div class="mb-3">
                                <label for="edit_telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="edit_telefone" name="telefone" value="' . $dados['telefone'] . '">
                              </div>';
}

echo json_encode($dados);
?>
