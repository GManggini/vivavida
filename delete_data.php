<?php
include 'db_connect.php';

$id = $_POST['id'];

if ($tabela == 'hospedes') {
    $sql = "DELETE FROM hospedes WHERE id=$id";
} else {
    $sql = "DELETE FROM users WHERE id=$id";
}

if ($conn->query($sql) === TRUE) {
    echo "Deletado com sucesso!";
} else {
    echo "Erro ao deletar: " . $conn->error;
}
?>