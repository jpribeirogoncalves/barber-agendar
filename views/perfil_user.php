<?php
session_start();

// Verifica se o usuário está logado, se não estiver, redireciona para a página de login
if (!isset($_SESSION['usuario_logado'])) {
    header('Location: login.php');
    exit();
}

// Inclua o arquivo de configuração do banco de dados e outras funcionalidades necessárias
include '../config/config.php';

// Inicializa as variáveis de nome e email
$nome = $email = '';

// Verifica se $_SESSION['user_id'] está definido antes de usá-lo
if (isset($_SESSION['usuario_id'])) {
    $user_id = $_SESSION['usuario_id'];

    // Consulta para obter os detalhes do usuário a partir do banco de dados
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
    <title>Perfil do Usuário</title>
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

        <!-- Dados do usuário em uma lista -->
        <div class="row">
            <div class="col-md-4">
                <h3>Dados do Usuário</h3>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nome:</strong> <?php echo $nome; ?></li>
                    <li class="list-group-item"><strong>E-mail:</strong> <?php echo $email; ?></li>
                    <!-- Outros campos do perfil -->
                </ul>
                <a href="editar_perfil.php" class="btn btn-success mt-3">Editar</a>
                <a href="#" class="btn btn-warning mt-3">Redefinir senha</a>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
