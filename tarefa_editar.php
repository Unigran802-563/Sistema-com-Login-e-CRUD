<?php
require_once 'verifica_login.php';
require_once 'conexao.php';

// Validação básica do ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID da tarefa inválido.");
}
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Busca a tarefa para garantir que ela pertence ao usuário logado
$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);
$tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

// Se a tarefa não for encontrada, exibe um erro
if (!$tarefa) {
    die("Tarefa não encontrada ou você não tem permissão para editá-la.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="painel-container">
        <h2>Editar Tarefa</h2>
        <form action="tarefa_atualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
            
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($tarefa['titulo']); ?>" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($tarefa['descricao']); ?></textarea>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="pendente" <?php echo ($tarefa['status'] == 'pendente') ? 'selected' : ''; ?>>Pendente</option>
                <option value="em_andamento" <?php echo ($tarefa['status'] == 'em_andamento') ? 'selected' : ''; ?>>Em Andamento</option>
                <option value="concluida" <?php echo ($tarefa['status'] == 'concluida') ? 'selected' : ''; ?>>Concluída</option>
            </select>

            <button type="submit">Atualizar</button>
        </form>
        <p style="margin-top: 20px;"><a href="painel.php">← Voltar para o painel</a></p>
    </div>
</body>
</html>
