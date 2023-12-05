<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios Agendados</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css">
<style>
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  th, td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
  }

  th {
    background-color: #f2f2f2;
  }

  .unavailable {
    color: blue;
    font-weight: bold;
  }
</style>
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
      <?php
          include 'config.php';

          $dias_exibir = 7; 

          echo '<table>';
          echo '<thead>';
          echo '<tr>';
          echo '<th>Data</th>';
          echo '<th>Horários Agendados</th>';
          echo '</tr>';
          echo '</thead>';
          echo '<tbody>';

          for ($i = 0; $i < $dias_exibir; $i++) {
              $data = date('Y-m-d', strtotime('+' . $i . ' days'));
              $data_formatada = date('d/m/Y', strtotime('+' . $i . ' days'));

              // Obter o dia da semana (0 para domingo, 1 para segunda, etc.)
              $dia_semana = date('w', strtotime($data));

              // Verificar se é domingo (0) ou segunda-feira (1)
              $marcacao_permitida = ($dia_semana != 0 && $dia_semana != 1);

              echo '<tr>';
              echo '<td>' . $data_formatada . '</td>';
              echo '<td>';

              if ($marcacao_permitida) {
                  // Verifica os horários indisponíveis
                  $query = "SELECT horario FROM agendamentos WHERE data = '$data'";
                  $result = $conn->query($query);

                  if ($result->num_rows > 0) {
                      $horarios = array();
                      while($row = $result->fetch_assoc()) {
                          $horarios[] = '<span class="unavailable">' . $row['horario'] . '</span>';
                      }
                      echo implode(', ', $horarios);
                  } else {
                      echo 'Nenhum horário marcado.';
                  }
              }else{
                  echo 'Neste dia não há atendimento.';
              }

              echo '</td>';
              echo '</tr>';
          }

          echo '</tbody>';
          echo '</table>';
      ?>
    </div>

<br>
<br>
<br>


</body>
</html>