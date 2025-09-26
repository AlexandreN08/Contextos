<?php



session_start();



// Verificar se 'id_usuario' está definido na sessão
if (isset($_SESSION['id_usuario'])) {
    // Obter o ID do usuário da sessão
    $user_id = $_SESSION['id_usuario'];

    // Verificar se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Verificar se todos os campos foram preenchidos
        if (isset($_POST["evento"])) {
            // Obter os valores dos campos do formulário
          

            $id_evento = $_POST["evento"];
            

            // Conexão com o banco de dados
            include_once "db_conexao.php";

            // Query para inserir os dados na tabela
           
           
           $sql_inserir = "INSERT INTO inscricoes (id_evento, data_inscricao, id_usuario) 
            VALUES ('$id_evento', NOW(), '$user_id')";





            // Executar a query de inserção
            if (mysqli_query($conexao, $sql_inserir)) {
                // Exibir mensagem de sucesso
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                // Redirecionar para a página index.php após 3 segundos
                header("refresh:0.5;url=index.php");
                exit();
            } else {
                // Exibir mensagem de erro
                echo "<script>alert('Erro, tente novamente!');</script>";
                // Redirecionar para a página index.php após 3 segundos
                header("refresh:0.5;url=index.php");
                exit();
            }
        }
    }
} else {
    // A variável de sessão 'id_usuario' não está definida
    // Faça algo apropriado, como redirecionar para a página de login
    header("Location: login.php");
    exit();
}

?>
