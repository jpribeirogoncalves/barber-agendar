<?php
session_start();

// Verifica se o usuário já está logado, se sim, redireciona para a página inicial
if (isset($_SESSION['usuario_logado'])) {
    header('Location: index.php');
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    include '../config/config.php';

    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha

    // Prepara e executa a inserção no banco de dados
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['msgS'] = "Cadastro realizado com sucesso!";
    } else {
        $_SESSION['msgR'] = "Erro ao cadastrar o usuário: " . $conn->error;
    }

    // Fecha a conexão e redireciona para a página de login
    $stmt->close();
    $conn->close();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Cadastre-se</h2>
                <?php
                    if (isset($_SESSION['msgS'])) {
                        echo '<div class="alert alert-success" role="alert">' . $_SESSION['msgS'] . '</div>';
                        unset($_SESSION['msgS']);
                    } elseif (isset($_SESSION['msgR'])) {
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['msgR'] . '</div>';
                        unset($_SESSION['msgR']);
                    }
                ?>
                <form action="cadastro.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" id="senha" name="senha" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
                <p class="mt-3">Já possui uma conta? <a href="login.php">Faça login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
