<?php
// Arquivo obter_horarios_disponiveis.php

// Inclua o arquivo de configuração do banco de dados
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data'])) {
    $data_selecionada = date('Y-m-d', strtotime($_POST['data']));

    // Consulte o banco de dados para obter os horários já agendados para a data selecionada
    $query_agendamentos = "SELECT horario FROM agendamentos WHERE data = '$data_selecionada'";
    $result_agendamentos = $conn->query($query_agendamentos);

    $horarios_agendados = array();

    if ($result_agendamentos && $result_agendamentos->num_rows > 0) {
        while ($row = $result_agendamentos->fetch_assoc()) {
            $horarios_agendados[] = $row['horario'];
        }
    }

       // Defina os horários de trabalho do barbeiro
        $hora_inicio_trabalho = strtotime("07:00");
        $hora_fim_almoco_inicio = strtotime("12:00");
        $hora_fim_almoco_fim = strtotime("13:00");
        $hora_fim_trabalho = strtotime("17:00");
        $intervalo = 1800; // 30 minutos em segundos

        // Crie um array com todos os horários possíveis de trabalho
        $horarios_possiveis = array();

        for ($hora = $hora_inicio_trabalho; $hora < $hora_fim_almoco_inicio; $hora += $intervalo) {
            $horario = date("H:i", $hora);

            $query_agendamentos = "SELECT horario FROM agendamentos WHERE data = '$data_selecionada' AND horario = '$horario'";
            $result_agendamentos = $conn->query($query_agendamentos);
            
            if ($result_agendamentos->num_rows === 0) {
                $horarios_possiveis[] = $horario;
            }
        }

        for ($hora = $hora_fim_almoco_fim; $hora < $hora_fim_trabalho; $hora += $intervalo) {
            $horario = date("H:i", $hora);

            $query_agendamentos = "SELECT horario FROM agendamentos WHERE data = '$data_selecionada' AND horario = '$horario'";
            $result_agendamentos = $conn->query($query_agendamentos);
            
            if ($result_agendamentos->num_rows === 0) {
                $horarios_possiveis[] = $horario;
            }
        }

    // Se não houver horários disponíveis, exiba uma mensagem
    if (empty($horarios_possiveis)) {
        echo '<option value="" disabled>Nenhum horário disponível</option>';
    } else {
        foreach ($horarios_possiveis as $horario) {
            echo '<option value="' . $horario . '">' . $horario . '</option>';
        }
    }
}
?>
