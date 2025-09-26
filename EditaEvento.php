<?php
include_once "db_conexao.php";

$evento_id = isset($_GET['id_evento']) ? $_GET['id_evento'] : null;

if ($evento_id) {
    $sql_evento = "SELECT * FROM evento WHERE ID_EVENTO = $evento_id";
    $resultado_evento = mysqli_query($conexao, $sql_evento);

    if ($resultado_evento) {
        $evento = mysqli_fetch_assoc($resultado_evento);

        if ($evento) {
            $nomeEvento = $evento['NOME_EVENTO'];
            $descricaoEvento = $evento['DESCRICAO_EVENTO'];
            $dia = $evento['DIA'];
            $cod_instituicao = $evento['ID_INSTITUICAO'];
            $cod_palestrante = $evento['ID_USUARIO'];
        }
    } else {
        die("Erro na consulta SQL: " . mysqli_error($conexao));
    }
}

$sql_instituicao = "SELECT ID_INSTITUICAO, NOME_INSTITUICAO FROM instituicao";
$sql_resultado_instituicao = mysqli_query($conexao, $sql_instituicao);

$sql_palestrante = "SELECT ID_USUARIO, NOME FROM usuario WHERE TIPO_USUARIO = 'PALESTRANTE'";
$sql_palestrante = mysqli_query($conexao, $sql_palestrante);
?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Eventos</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/footer-with-button-logo.css">
    <link rel="stylesheet" type="text/css" href="css/product.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbars/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <?php
    include_once "menu.php";
    
    
    ?>

    <style>
        .formulario {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            left: 70%;
            margin-left: 50px;
        }

        .form {
            background-color: rgba(0, 0, 0, 0.9);
            position: absolute;
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 50px;
            border-radius: 15px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(600deg, white, black);
            height: 2000px;
        }

        input {
            padding: 20px;
            border: none;
            outline: none;
            font-size: 15px;
            color: white;
            background: transparent;


        }

        label {
            color: white;

        }

        button {
            background-color: dodgerblue;
            border: none;
            padding: 15px;
            width: 50%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            margin-left: 25%;
        }

        @media (max-width: 768px) {
            .form {
                padding: 20%;
            }
        }

        @media (max-width: 567px) {
            .form {
                padding: 25%;
            }
        }

        .rodape{
        position: bottom;
        top: 93%;
    }
    </style>

    <script>
        function exibirMensagem() {
            alert("Evento cadastrado com sucesso!"); // Mensagem de sucesso ao cadastrar
        }
    </script>


</head>
<body>
    <div class="container-fluid">
        <div class="">
            <form class="formulario" action="db_edit_evento.php" method="post">
                <input type="hidden" name="id_evento" value="<?= $evento_id ?>">

                <div class="form">
                    <input type="text" name="nome_evento" id="nome_evento" placeholder="Nome" value="<?= $nomeEvento ?>" style="width: 300px;">
                    <label for="nome">Nome do Evento</label>

                    <input type="text" name="descricao_evento" id="descricao_evento" placeholder="Descrição" value="<?= $descricaoEvento ?>" style="width: 300px;">
                    <label for="nome">Descrição do Evento</label>

                    <input type="date" name="dia" id="dia" placeholder="Data" value="<?= $dia ?>" style="width: 300px;">
                    <label for="floatingInput">Data do Evento </label>
                    <br>

                    <div class="form-group">
                        <label class="small mb-1" for="formato">Selecione o Palestrante </label>
                        <select id="id_usuario" name="id_usuario" required class="form-control select-usuario">
                            <option selected disabled>Selecione...</option>
                            <?php
                            while ($dados = mysqli_fetch_array($sql_palestrante)) {
                                $seleciona = ($cod_palestrante == $dados['ID_USUARIO']) ? 'selected="selected"' : '';
                                echo '<option value="' . $dados['ID_USUARIO'] . '" ' . $seleciona . '>' . $dados['NOME'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="small mb-1" for="formato">Selecione o Instituto </label>
                        <select id="id_instituicao" name="id_instituicao" required class="form-control select-instituicao">
                            <option selected disabled>Selecione...</option>
                            <?php
                            while ($dados = mysqli_fetch_array($sql_resultado_instituicao)) {
                                $seleciona = ($cod_instituicao == $dados['ID_INSTITUICAO']) ? 'selected="selected"' : '';
                                echo '<option value="' . $dados['ID_INSTITUICAO'] . '" ' . $seleciona . '>' . $dados['NOME_INSTITUICAO'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" name="btn_atualizar" id="btn_atualizar">Atualizar</button>

                        <form action="excluir_evento.php" method="post">
                            <input type="hidden" name="id_evento" value="<?= $evento_id ?>">
                            <button type="submit" name="btn_excluir" id="btn_excluir">Excluir</button>
                        </form>
                </div>
            </form>
        </div>
    </div>
</body>

</html>