<?php
session_start();

$msgS = isset($_GET['success']) ? urldecode($_GET['success']) : '';
$msgR = isset($_GET['error']) ? urldecode($_GET['error']) : '';

// Limpar os parâmetros da URL
unset($_GET['success']);
unset($_GET['error']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Corte</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
          <a class="navbar-brand" href="index.php">Barbearia Garagem</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Início</a>
                    </li>
                </ul>
          </div>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <div class="container mt-5">
        <h1 class="text-center">Escolha um horário</h1>

        <div class="container mt-4">
        <!-- Mensagem de sucesso ou erro -->
            <?php
                if (!empty($msgS)) {
                    echo '<div id="successMessage" class="alert alert-success text-center" role="alert">' . $msgS . '</div>';
                } elseif(!empty($msgR)) {
                    echo '<div id="errorMessage" class="alert alert-danger text-center" role="alert">' . $msgR . '</div>';
                }
            ?>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                <form action="processar_agendamento.php" method="post">
                    <div class="mb-3">
                        <label for="data" class="form-label">Selecione a data:</label>
                        <input type="date" id="data" name="data" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="horario" class="form-label">Selecione o horário:</label>
                        <select name="horario" id="horario" class="form-select" required>
                            <option value="" disabled selected>Escolha um horário</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Agendar</button>
                </form>
            </div>
        </div>
        <h2 class="mt-5 text-center">Horario de atendimento de 7:00 as 17:00</h2>
        <!-- <h3 class="mt-5 text-center">Data/Horarios Disponiveis</h3> -->
        <!-- <?php include 'disponibilidade.php'; ?> -->
    </div>

    <script src="https://unpkg.com/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#data').change(function () {
                var selectedDate = $(this).val();

                // Realize uma chamada AJAX para obter os horários disponíveis para a data selecionada
                $.ajax({
                    url: 'obter_horarios_disponiveis.php',
                    type: 'POST',
                    data: { data: selectedDate },
                    success: function (response) {
                        // Atualize os horários no campo de seleção de horário
                        $('#horario').html(response);
                    }
                });
            });
        });
    </script>


    <script>
        // Oculta a mensagem de sucesso após 5 segundos
        setTimeout(function() {
            var successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.display = 'none';
                window.location.href = 'agendar.php';
            }
        }, 5000);

        
        // Oculta a mensagem de erro após 5 segundos
        setTimeout(function() {
            var errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                errorMessage.style.display = 'none';
                window.location.href = 'agendar.php';
            }
        }, 5000);
    </script>
</body>
</html>
