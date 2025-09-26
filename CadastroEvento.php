<?php
session_start();
include_once "db_conexao.php";

// Verificar se o usuário está logado e se é do tipo admin
if (!isset($_SESSION["tipo_usuario"]) || $_SESSION["tipo_usuario"] !== "admin") {
    header("Location: acesso_negado.php"); // Redireciona para uma página de acesso negado
    exit();
}

include_once "menu.php";

$nomeEvento = ""; // Inicializa a variável
$descricaoEvento = ""; // Inicializa a variável
$dia = "";
$localEvento = ""; // Adicionando variável para o local do evento
$palestrante = ""; // Adicionando variável para o palestrante
$id_evento = "";

$sql_instituicao = "SELECT id_instituicao, nome_instituicao FROM instituicao";
$sql_resultado_instituicao = mysqli_query($conexao, $sql_instituicao);
$sql_palestrante = "SELECT id_usuario, nome FROM usuario WHERE tipo_usuario = 'PALESTRANTE'";
$sql_palestrante = mysqli_query($conexao, $sql_palestrante);

$cod_instituicao = 0;

// Verifique se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nomeEvento = $_POST['nome_evento'] ?? ''; // Usando operador de coalescência nula
    $descricaoEvento = $_POST['descricao_evento'] ?? ''; // Usando operador de coalescência nula
    $dia = $_POST['dia'] ?? '';
    $localEvento = $_POST['local_evento'] ?? '';
    $palestrante = $_POST['palestrante'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Eventos</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .form-container {
            background-color: #1F532BFF;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 120px auto;
        }

        label {
            font-weight: bold;
            color: white;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #e9ecef;
            font-size: 16px;
        }

        .btn-submit {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function exibirMensagem() {
            alert("Evento cadastrado com sucesso!");
        }
    </script>
</head>

<body>
    <div class="form-container">
        <form action="db_cad_evento.php" method="post">
            <input type="hidden" name="id_evento" value="<?= $id_evento ?>">

            <!-- Nome do Evento -->
            <div class="form-group">
                <label for="nome_evento">Nome do Evento</label>
                <input type="text" name="nome_evento" id="nome_evento" placeholder="Nome do Evento" value="<?php echo $nomeEvento ?>">
            </div>

            <!-- Descrição do Evento -->
            <div class="form-group">
                <label for="descricao_evento">Descrição do Evento</label>
                <input type="text" name="descricao_evento" id="descricao_evento" placeholder="Descrição do Evento" value="<?php echo $descricaoEvento ?>">
            </div>

            <!-- Data do Evento -->
            <div class="form-group">
                <label for="dia">Data do Evento</label>
                <input type="date" name="dia" id="dia" value="<?php echo $dia ?>">
            </div>

            <!-- Horário do Evento -->
            <div class="form-group">
                <label for="horario">Horário do Evento</label>
                <input type="time" name="horario" id="horario">
            </div>

            <!-- Local do Evento -->
            <div class="form-group">
                <label for="local_evento">Local do Evento</label>
                <input type="text" name="local_evento" id="local_evento" placeholder="Local do Evento" value="<?php echo $localEvento ?>">
            </div>

            <!-- Palestrante -->
            <div class="form-group">
                <label for="palestrante">Nome do Palestrante</label>
                <input type="text" name="palestrante" id="palestrante" placeholder="Nome do Palestrante" value="<?php echo $palestrante ?>">
            </div>

            <!-- Instituição -->
            <div class="form-group">
                <label for="id_instituicao">Selecione a Instituição</label>
                <select id="id_instituicao" name="id_instituicao" required>
                    <option selected disabled>Selecione...</option>
                    <?php
                    while ($dados = mysqli_fetch_array($sql_resultado_instituicao)) {
                        $seleciona = ($cod_instituicao == $dados['id_instituicao']) ? 'selected="selected"' : '';
                        echo '<option value="' . $dados['id_instituicao'] . '" ' . $seleciona . '>' . $dados['nome_instituicao'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Botão de Cadastro -->
            <button type="submit" class="btn-submit" name="btn_cadastrar" id="btn_cadastrar" onclick="exibirMensagem()">Cadastrar</button>
        </form>

        <div class="text-center">
    <button class="btn btn-primary" onclick="window.location.href='Modelo.php'">Anexar arquivos</button>
</div>


    </div>



    <div style="margin-top: 400px;">
        <?php include_once "rodape.php"; ?>
    </div>
</body>

</html>
