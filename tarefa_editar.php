<?php
require_once 'verifica_login.php';
require_once 'conexao.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];


$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);
$tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tarefa) {
    die("Tarefa não encontrada ou você não tem permissão para editá-la.");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Editar Tarefa</title>
</head>

<body>
    <h2>Editar Tarefa</h2>
    <form action="tarefa_atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
        <label>Título:</label>

        <input type="text" name="titulo" value="<?php echo htmlspecialchars($tarefa['titulo']); ?>" required>


        <label>Descrição:</label>

        <textarea name="descricao"><?php echo htmlspecialchars($tarefa['descricao']); ?></textarea>


        <label>Status:</label>

        <select name="status">
            <option value="pendente" <?php echo ($tarefa['status'] == 'pendente') ? 'selected' : ''; ?>>Pendente</option>
            <option value="em_andamento" <?php echo ($tarefa['status'] == 'em_andamento') ? 'selected' : ''; ?>>Em Andamento</option>
            <option value="concluida" <?php echo ($tarefa['status'] == 'concluida') ? 'selected' : ''; ?>>Concluída</option>
        </select>


        <button type="submit">Atualizar</button>
    </form>
</body>

</html>