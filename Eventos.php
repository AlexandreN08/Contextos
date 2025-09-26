<?php
session_start();
include_once "db_conexao.php";
include_once "menu.php";

// Verifique se há informações do evento na sessão
$evento_cadastrado = isset($_SESSION['evento_cadastrado']) ? $_SESSION['evento_cadastrado'] : null;

// Código existente para buscar eventos, ordenando por data
$sql_evento = "SELECT nome_evento, descricao_evento, dia, horario, localEvento, palestrante FROM evento ORDER BY dia ASC";
$sql_resultado_evento = mysqli_query($conexao, $sql_evento);
?>

<div class="container">
    <h2>Eventos Cadastrados</h2>
    <div class="row">
        <?php while ($dados = mysqli_fetch_array($sql_resultado_evento)): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($dados['nome_evento']) ?></h5>
                        <p class="card-text"><strong>Descrição:</strong> <?= htmlspecialchars($dados['descricao_evento']) ?></p>
                        <p class="card-text"><strong>Data:</strong> <?= (new DateTime($dados['dia']))->format('d/m/Y') ?></p>
                        <p class="card-text"><strong>Horário:</strong> <?= htmlspecialchars($dados['horario']) ?></p>
                        <p class="card-text"><strong>Local:</strong> <?= htmlspecialchars($dados['localEvento']) ?></p>
                        <p class="card-text"><strong>Palestrante:</strong> <?= htmlspecialchars($dados['palestrante']) ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <?php if ($evento_cadastrado): ?>
        <h3>Último Evento Cadastrado:</h3>
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Nome:</strong> <?= htmlspecialchars($evento_cadastrado['nome_evento']) ?></p>
                <p><strong>Descrição:</strong> <?= htmlspecialchars($evento_cadastrado['descricao_evento']) ?></p>
                <p><strong>Data:</strong> <?= (new DateTime($evento_cadastrado['dia']))->format('d/m/Y') ?></p>
                <p><strong>Horário:</strong> <?= htmlspecialchars($evento_cadastrado['horario']) ?></p>
                <p><strong>Local:</strong> <?= htmlspecialchars($evento_cadastrado['local_evento']) ?></p>
                <p><strong>Palestrante:</strong> <?= htmlspecialchars($evento_cadastrado['palestrante']) ?></p>
            </div>
        </div>


        <?php
        // Limpar a variável de sessão após exibição
        unset($_SESSION['evento_cadastrado']);
        ?>

    <?php endif; ?>
</div>

<?php include_once "rodape.php"; ?>
