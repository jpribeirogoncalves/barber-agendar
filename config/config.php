<?php
// Database Gabriel
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "baber_agendar";

// Database joão
// $servername = "localhost";
// $username = "jprg";
// $password = "96326106";
// $dbname = "baber_agendar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
