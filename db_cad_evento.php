<?php
require_once("db_conexao.php");
session_start();

if (isset($_POST['btn_cadastrar'])) {
    // Receber e escapar os valores do formulário
    $id_evento = mysqli_escape_string($conexao, $_POST['id_evento']);
    $nome_evento = mysqli_escape_string($conexao, $_POST['nome_evento']);
    $descricao_evento = mysqli_escape_string($conexao, $_POST['descricao_evento']);
    $dia = mysqli_escape_string($conexao, $_POST['dia']);
    $horario = mysqli_escape_string($conexao, $_POST['horario']); // Novo campo
    $id_instituicao = mysqli_escape_string($conexao, $_POST['id_instituicao']);
    $local_evento = mysqli_escape_string($conexao, $_POST['local_evento']);
    $palestrante = mysqli_escape_string($conexao, $_POST['palestrante']);


    // Verificar se o evento já existe (não está claro como a verificação está sendo feita)
    if (isset($array) && $array['id_evento']) {
        echo "Esse evento já existe";
    } else {
// Inserir evento com os campos corretos
$sqlEvento = "INSERT INTO evento (nome_Evento, descricao_evento, dia, horario, id_instituicao, palestrante, localEvento) VALUES (?, ?, ?, ?, ?, ?, ?)";
$tiposEvento = "sssssss"; // 7 's' para strings
$parametrosEvento = array($nome_evento, $descricao_evento, $dia, $horario, $id_instituicao, $palestrante, $local_evento);

$stmtEvento = mysqli_prepare($conexao, $sqlEvento);
mysqli_stmt_bind_param($stmtEvento, $tiposEvento, ...$parametrosEvento);


        if (!$stmtEvento) {
            echo "Verifique os campos! " . mysqli_error($conexao);
        } else {
            // Bind dos parâmetros e execução da consulta
            mysqli_stmt_bind_param($stmtEvento, $tiposEvento, ...$parametrosEvento);
            mysqli_stmt_execute($stmtEvento);

            if (mysqli_stmt_error($stmtEvento)) {
                header('location: CadastroEvento.php?erro');
            } else {
                header('location: CadastroEvento.php?sucesso');
            }

            mysqli_stmt_close($stmtEvento);
        }
    }
}
?>

