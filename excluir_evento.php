<?php
include_once "db_conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn_excluir"])) {
    $id_evento = $_POST["id_evento"];

    // Verifica se o evento existe antes de excluí-lo
    $verifica_sql = "SELECT * FROM evento WHERE ID_EVENTO = $id_evento";
    $verifica_resultado = mysqli_query($conexao, $verifica_sql);

    if ($verifica_resultado && mysqli_num_rows($verifica_resultado) > 0) {
        // O evento existe, então podemos excluí-lo
        $exclusao_sql = "DELETE FROM evento WHERE ID_EVENTO = $id_evento";

        if (mysqli_query($conexao, $exclusao_sql)) {
            // Redireciona para a página de sucesso após a exclusão
            header("Location: sucesso_exclusao.php");
            exit();
        } else {
            die("Erro na exclusão do evento: " . mysqli_error($conexao));
        }
    } else {
        echo "Evento não encontrado.";
    }
}
?>
