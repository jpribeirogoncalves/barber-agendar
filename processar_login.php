<?php
// Página de verificação das credenciais (verificar_credenciais.php)
session_start();

// Incluindo o arquivo de conexão com o banco de dados
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebendo os dados do formulário de login
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta SQL para verificar as credenciais no banco de dados
    $sql = "SELECT id, nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuário autenticado com sucesso
        $row = $result->fetch_assoc();

        // Criando variáveis de sessão para armazenar informações do usuário autenticado
        $_SESSION['usuario_logado'] = true;
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['usuario_nome'] = $row['nome'];

        header('Location: index.php');
        exit();
    } else {
        // Se as credenciais forem inválidas, redirecionar de volta para a página de login com uma mensagem de erro
        header('Location: login.php?erro=Credenciais inválidas');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>
