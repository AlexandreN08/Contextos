<?php
session_start();
include_once "menu.php";
include_once "db_conexao.php";

// Verifica se a sessão está iniciada e se o ID do usuário está definido
if (isset($_SESSION['id_usuario'])) {
    $user_id = $_SESSION['id_usuario'];

    // Consulta SQL modificada para incluir uma cláusula WHERE para filtrar por ID do usuário
    $sql_inscricoes = "SELECT USUARIO.NOME AS NOME_USUARIO, EVENTO.NOME_EVENTO, inscricoes.id_usuario, inscricoes.id_evento
                      FROM inscricoes
                      INNER JOIN USUARIO ON inscricoes.id_usuario = USUARIO.id_usuario
                      INNER JOIN EVENTO ON inscricoes.id_evento = EVENTO.id_evento
                      WHERE inscricoes.id_usuario = $user_id";

    $resultado_inscricoes = mysqli_query($conexao, $sql_inscricoes);
?>

    <h2>Meus Eventos</h2>

    <table>
    <thead>
        <tr>
            <th>Evento</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($resultado_inscricoes) {
            // Verifica se a consulta foi bem-sucedida antes de usar mysqli_num_rows
            if (mysqli_num_rows($resultado_inscricoes) > 0) {
                while ($inscricao = mysqli_fetch_assoc($resultado_inscricoes)) {
                    echo "<tr>";
                    echo "<td>" . $inscricao['NOME_EVENTO'] . "</td>";
                    echo "</tr>";
                    echo "<tr><td colspan='1'>&nbsp;</td></tr>";  // Adiciona uma linha em branco entre as entradas
                }
            } else {
                echo "<tr><td colspan='1'>Nenhum dado cadastrado</td></tr>";
            }
        } else {
            // Exibe um erro caso a consulta tenha falhado
            echo "<tr><td colspan='1'>Erro na consulta: " . mysqli_error($conexao) . "</td></tr>";
        }
        ?>
    </tbody>
</table>





<?php
} else {
    // Caso o ID do usuário não esteja definido na sessão
    echo "ID do usuário não definido na sessão.";
}

include_once "rodape.php";
?>
