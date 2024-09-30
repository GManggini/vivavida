<?php
include 'db_connect.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$tabela = $_POST['tabela'];

if ($tabela == 'hospedes') {
    $cpf = $_POST['cpf'];
    $sql = "UPDATE hospedes SET nome='$nome', email='$email', cpf='$cpf' WHERE id=$id";
} else {
    $telefone = $_POST['telefone'];
    $sql = "UPDATE users SET nome='$nome', email='$email', telefone='$telefone' WHERE id=$id";
}

if ($conn->query($sql) === TRUE) {
    echo "Atualizado com sucesso!";
} else {
    echo "Erro ao atualizar: " . $conn->error;
}
?>
