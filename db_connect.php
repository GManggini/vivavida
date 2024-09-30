<?php
$servername = "hotelvivavida.com.br:3306";
$username = "vivavida_userhospeda";
$password = "viva@vida#123";
$dbname = "vivavida_hospeda";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>