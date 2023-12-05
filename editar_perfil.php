<?php
session_start();

// Verifica se o usuário está logado, se não estiver, redireciona para a página de login
if (!isset($_SESSION['usuario_logado'])) {
    header('Location: login.php');
    exit();
}

// Inclua o arquivo de configuração do banco de dados e outras funcionalidades necessárias
include 'config.php';

// Inicializa as variáveis
$nome = $email = '';
$msgR = '';

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $user_id = $_SESSION['usuario_id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Atualiza os dados do usuário no banco de dados
    $query_update = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($query_update);
    $stmt->bind_param("ssi", $nome, $email, $user_id);

    if ($stmt->execute()) {
        $msgS = "Perfil atualizado com sucesso!";
    } else {
        $msgR = "Erro ao atualizar o perfil: " . $stmt->error;
    }

    // Fecha a conexão e o statement
    $stmt->close();
    $conn->close();
} else {
    // Consulta para obter os detalhes do usuário a partir do banco de dados
    $user_id = $_SESSION['usuario_id'];
    $query_user = "SELECT nome, email FROM usuarios WHERE id = $user_id";
    $result_user = $conn->query($query_user);

    if ($result_user && $result_user->num_rows > 0) {
        $row_user = $result_user->fetch_assoc();
        $nome = $row_user['nome'];
        $email = $row_user['email'];
    } 
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Barbearia Garagem</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-home"></i> <!-- Ícone de casa -->
                            Início
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Editar Perfil</h2>
                <?php
                if (!empty($msgS)) {
                    echo '<div class="alert alert-success" role="alert">' . $msgS . '</div>';
                } elseif (!empty($msgR)) {
                    echo '<div class="alert alert-danger" role="alert">' . $msgR . '</div>';
                }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $nome; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
                <p class="mt-3"><a href="perfil_user.php">Voltar para o Perfil</a></p>
            </div>
        </div>
    </div>
</body>
</html>
