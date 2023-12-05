<?php
include 'config.php';

$msgR = '';
$msgS = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'];
    $horario = $_POST['horario'];

    // Obter a data atual
    $data_atual = date('Y-m-d');

    // Converter a data para o formato brasileiro (dd/mm/yyyy)
    $data_formatada = date('d/m/Y', strtotime($data));

    // Verificar se a data está dentro do intervalo permitido (não passada e não mais de 7 dias no futuro)
    $data_limite = date('Y-m-d', strtotime('+7 days'));
    if ($data < $data_atual || $data > $data_limite) {
        $msgR = "Selecione uma data válida dentro dos próximos 7 dias.";
    } else {
        // Verificar se a data é igual à data atual
        if ($data == $data_atual) {
            $hora_atual = date('H:i:s');
            // Obter a hora atual
            if ($horario < $hora_atual) {
                $msgR = "Não é possível marcar um horário passado para hoje.";
            }
        }

        if (empty($msgR)) {
            // Verificar se o horário está disponível
            $query = "SELECT * FROM agendamentos WHERE data = '$data' AND horario = '$horario'";
            $result = $conn->query($query);

            // Obter o dia da semana (0 para domingo, 1 para segunda, etc.)
            $dia_semana = date('w', strtotime($data));

            // Verificar se é domingo (0) ou segunda-feira (1)
            $marcacao_permitida = ($dia_semana != 0 && $dia_semana != 1);

            if (!$marcacao_permitida) {
                $msgR = "Não é possível marcar horários neste dia.";
            } elseif ($result->num_rows > 0) {
                $msgR = "O horário $horario para o dia $data_formatada está indisponível. Por favor, escolha outro horário.";
            } else {
                // Inserir o agendamento no banco de dados
                $insert_query = "INSERT INTO agendamentos (data, horario) VALUES ('$data', '$horario')";
            
                if ($conn->query($insert_query) === TRUE) {
                    $msgS = "Agendamento realizado para $data_formatada às $horario. Obrigado!";
                } else {
                    $msgR = "Erro ao agendar: " . $conn->error;
                }
            }
        }
    }
    // Armazenar a mensagem na sessão
    session_start();
    $_SESSION['msgR'] = $msgR;
    $_SESSION['msgS'] = $msgS;
    
    // Redirecionar de volta para a página do formulário
    header('Location: agendar.php?success=' . urlencode($msgS) . '&error=' . urlencode($msgR));
    exit();
}
?>
