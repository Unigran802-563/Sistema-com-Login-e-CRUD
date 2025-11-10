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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="painel-container">
        <div class="painel-header">
            <h1>Painel de Tarefas</h1>
            <p>Olá, <?php echo htmlspecialchars($_SESSION['user_name']); ?>! <a href="logout.php">Sair</a></p>
        </div>

        <h2>Adicionar Nova Tarefa</h2>
        <form action="tarefa_criar.php" method="POST">
            <label for="titulo-add">Título da Tarefa:</label>
            <input type="text" id="titulo-add" name="titulo" placeholder="Ex: Comprar leite" required>
            
            <label for="descricao-add">Descrição (opcional):</label>
            <textarea id="descricao-add" name="descricao" placeholder="Ex: No supermercado da esquina"></textarea>
            
            <button type="submit">Adicionar Tarefa</button>
        </form>

        <h2>Minhas Tarefas</h2>
        <table class="tabela-tarefas">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tarefas)): ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">Nenhuma tarefa encontrada. Crie uma acima!</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($tarefas as $tarefa): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($tarefa['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($tarefa['descricao']); ?></td>
                            <td><?php echo ucfirst(str_replace('_', ' ', $tarefa['status'])); ?></td>
                            <td class="acoes">
                                <a class="editar" href="tarefa_editar.php?id=<?php echo $tarefa['id']; ?>">Editar</a>
                                <a class="excluir" href="tarefa_deletar.php?id=<?php echo $tarefa['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
