<?php
require_once 'verifica_login.php';
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];
    $user_id = $_SESSION['user_id'];

    if (!empty($titulo)) {
        
        $sql = "UPDATE tarefas SET titulo = ?, descricao = ?, status = ? WHERE id = ? AND user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $descricao, $status, $id, $user_id]);
    }
}

header("Location: painel.php");
exit;
