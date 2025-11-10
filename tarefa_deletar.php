<?php
require_once 'verifica_login.php';
require_once 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    
    $sql = "DELETE FROM tarefas WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id, $user_id]);
}

header("Location: painel.php");
exit;
