<?php
session_start();
$diretorio = "uploads/";

// Verifica se o diretório existe
if (!is_dir($diretorio)) {
    mkdir($diretorio, 0777, true);
}

// Lista os arquivos no diretório
$files = scandir($diretorio);
?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Downloads - Repositório de Arquivos</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include_once "menu.php"; ?>

    <div class="container mt-5">
        <h1>Arquivos Disponíveis para Download</h1>
        <ul class="list-group">
            <?php
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    echo '<li class="list-group-item">';
                    echo '<a href="' . $diretorio . htmlspecialchars($file) . '" download>' . htmlspecialchars($file) . '</a>';
                    echo '</li>';
                }
            }
            ?>
        </ul>
    </div>


</body>

</html>
