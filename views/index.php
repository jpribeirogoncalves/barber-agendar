<?php
session_start();

if (!isset($_SESSION['usuario_logado'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbearia Garagem</title>
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
                    <a class="nav-link" href="agendar.php">
                        <i class="far fa-calendar-alt"></i> <!-- Ícone de calendário -->
                        Agendar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="horarios_marcados.php">
                        <i class="far fa-clock"></i> <!-- Ícone de relógio -->
                        Horários agendados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="perfil_user.php">
                        <i class="far fa-user"></i> <!-- Ícone de usuário -->
                        Perfil
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="far fa-images"></i> <!-- Ícone de fotos -->
                        <!-- Fotos
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="../controllers/logout.php">
                        <i class="fas fa-sign-out-alt"></i> <!-- Ícone de saída -->
                        Sair
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <br>
    <br>
    <br>
    <main class="py-5">
        <div class="container">
            <section class="mb-5">
                <div class="text-center">
                    <h1>Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!</h1>
                    <p>Esta é a página inicial do sistema.</p>
                </div>
            </section>

            <!-- <section>
                <h2>Fotos</h2>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <img src="corte1.jpg" alt="Corte de cabelo 1" class="img-fluid">
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <img src="corte2.jpg" alt="Corte de cabelo 2" class="img-fluid">
                    </div>
                </div>
            </section> -->
        </div>
    </main>

    <!-- <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2023 Barbearia XYZ</p>
        </div>
    </footer> -->

    <script src="https://unpkg.com/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
