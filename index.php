<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Sigge Eventos</title>
  <link href="css/styles.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="css/footer-with-button-logo.css">
  <link rel="stylesheet" type="text/css" href="css/product.css">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbars/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>

  <style>
    .body {
      overflow-y: scroll;
    }

    ::-webkit-scrollbar {
      width: 5px;
      background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb {
      background-color: #000000;
      width: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background-color: #555555;
    }

    .evento-tabela {
      border-collapse: collapse;
    }

    .evento-tabela th,
    .evento-tabela td {
      padding: 5px;
    }

    .table-verde {
      background-color: #4CAF50;
      color: white;
      font-family: 'Roboto', sans-serif;
    }

    .table-verde th {
      background-color: #145518;
      color: white;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .container {
      width: 210px;
    }
  </style>
</head>

<body>
  <?php
  include_once "menu.php";
  include_once "db_conexao.php";

  // Consulta com todos os campos necessários
  $sql_evento = "SELECT nome_evento, descricao_evento, dia, horario, palestrante, localEvento FROM evento";
  $sql_resultado_evento = mysqli_query($conexao, $sql_evento);

  $query = $conexao->query("SELECT COUNT(*) AS count FROM mensagens WHERE lida = 0");
  $resultado = $query->fetch_assoc();
  $mensagensNaoLidas = $resultado['count'];

  if ($mensagensNaoLidas > 0) : ?>
    <div class="notification">
      <a href="mensagens.php">Você tem <?php echo $mensagensNaoLidas; ?> nova(s) mensagem(ns) não lida(s) do suporte</a>
    </div>
  <?php endif; ?>

  <?php if (isset($_GET['admin'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      Somente os Administradores do portal têm acesso a essa página!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php } ?>

  <div class="container-fluid">
    <div class="fixed-image" style="margin-top: 30px; text-align: center;">
      <img class="bd-placeholder-img" width="85%" height="300px" src="imagens/logo/imgCont.png" alt="Campus Palmas">
    </div>
  </div>

  <main>
    <div class="album py-5 bg-body-tertiary">
      <div class="container">
        <div>
          <?php
          if (mysqli_num_rows($sql_resultado_evento) > 0) {
            echo '<table class="table table-verde table-striped">';
            echo '<tr>';
            echo '<th>Nome</th>';
            echo '<th>Descrição</th>';
            echo '<th>Data</th>';
            echo '<th>Horário</th>';
            echo '<th>Palestrante</th>';
            echo '<th>Local</th>';
            echo '</tr>';

            while ($dados = mysqli_fetch_array($sql_resultado_evento)) {
              echo '<tr>';
              echo '<td>' . $dados['nome_evento'] . '</td>';
              echo '<td>' . $dados['descricao_evento'] . '</td>';
              echo '<td>' . $dados['dia'] . '</td>';
              echo '<td>' . $dados['horario'] . '</td>';
              echo '<td>' . $dados['palestrante'] . '</td>';
              echo '<td>' . $dados['localEvento'] . '</td>'; // Verifique se o nome da coluna está correto
              echo '</tr>';
            }

            echo '</table>';

            echo '<div id="calendario"></div>';
            echo '<script>';
            echo '$(document).ready(function() {';
            echo '  $("#calendario").fullCalendar({';
            echo '    events: ['; 

            mysqli_data_seek($sql_resultado_evento, 0); // Reiniciar o ponteiro dos resultados para o início
            
            while ($dados = mysqli_fetch_array($sql_resultado_evento)) {
              echo '      {';
              echo '        title: "' . $dados['nome_evento'] . ' - ' . $dados['horario'] . '",'; // Inclui o horário no título
              echo '        start: "' . $dados['dia'] . '",';
              echo '        description: "' . $dados['descricao_evento'] . '",';
              echo '        palestrante: "' . $dados['palestrante'] . '",';
              echo '        local: "' . $dados['localEvento'] . '"';
              echo '      },';
            }
            
            echo '    ],';
            echo '    eventRender: function(event, element) {';
            echo '      element.attr("title", "Nome: " + event.title.split(" - ")[0] + "<br>Descrição: " + event.description + "<br>Palestrante: " + event.palestrante + "<br>Local: " + event.local);'; // Tooltip com mais informações
            echo '      element.tooltip({';
            echo '        container: "body",';
            echo '        html: true,';
            echo '        placement: "top"';
            echo '      });';
            echo '    }';
            echo '  });';
            echo '});';
            echo '</script>';
          } else {
            echo 'Nenhum evento encontrado.';
          }
          ?>
        </div>
      </div>
    </div>
  </main>

  <?php
  include_once "rodape.php";
  ?>
</body>

</html>
