<?php
require_once 'verifica_login.php'; 
require_once 'conexao.php';


$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$user_id]);
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel de Tarefas</title>
</head>

<body>
    <h1>Painel de Tarefas</h1>
    <p>Olá, <?php echo htmlspecialchars($_SESSION['user_name']); ?>! <a href="logout.php">Sair</a></p>

    <h2>Adicionar Nova Tarefa</h2>
    <form action="tarefa_criar.php" method="POST">
        <input type="text" name="titulo" placeholder="Título da tarefa" required>
        <textarea name="descricao" placeholder="Descrição (opcional)"></textarea>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Minhas Tarefas</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tarefas as $tarefa): ?>
                <tr>
                    <td><?php echo htmlspecialchars($tarefa['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($tarefa['descricao']); ?></td>
                    <td><?php echo htmlspecialchars($tarefa['status']); ?></td>
                    <td>
                        <a href="tarefa_editar.php?id=<?php echo $tarefa['id']; ?>">Editar</a>
                        <a href="tarefa_deletar.php?id=<?php echo $tarefa['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>