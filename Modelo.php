<?php
session_start();
include_once "db_conexao.php";

$diretorio = "uploads/"; // Diretório onde os arquivos serão armazenados

// Verifica se o diretório existe e cria se não existir
if (!is_dir($diretorio)) {
    mkdir($diretorio, 0777, true);
}

// Verifica se o formulário foi enviado 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['arquivo'])) {
    $arquivo = $diretorio . basename($_FILES['arquivo']['name']);
    
    // Verifica se o upload foi bem-sucedido
    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $arquivo)) {
        $mensagem = "O arquivo " . htmlspecialchars(basename($_FILES['arquivo']['name'])) . " foi enviado com sucesso.";
    } else {
        $mensagem = "Desculpe, houve um erro ao enviar seu arquivo.";
    }
}

// Verifica se um arquivo deve ser removido
if (isset($_GET['remover'])) {
    $arquivoParaRemover = $diretorio . basename($_GET['remover']);
    if (file_exists($arquivoParaRemover)) {
        unlink($arquivoParaRemover);
        $mensagem = "Arquivo removido com sucesso.";
    } else {
        $mensagem = "Arquivo não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Modelo - Repositório de Arquivos</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include_once "menu.php"; ?>

    <div class="container mt-5">
        <h1>Repositório de Arquivos</h1>
        
        <?php if (isset($mensagem)): ?>
            <div class="alert alert-info" role="alert">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <form action="modelo.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="arquivo">Escolha um arquivo para enviar:</label>
                <input type="file" name="arquivo" class="form-control" id="arquivo" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <h2 class="mt-4">Arquivos Enviados</h2>
        <a href="downloads.php" class="btn btn-secondary">Ir para Downloads</a>
        <ul class="list-group">
            <?php
            // Lista os arquivos no diretório
            $files = scandir($diretorio);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                    echo htmlspecialchars($file);
                    echo '<a href="?remover=' . urlencode($file) . '" class="btn btn-danger btn-sm">Remover</a>';
                    echo '</li>';
                }
            }
            ?>
        </ul>
    </div>

  
</body>


</html>
