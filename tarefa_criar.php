<?php
require_once 'verifica_login.php';
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $user_id = $_SESSION['user_id'];

    if (!empty($titulo)) {
        $sql = "INSERT INTO tarefas (titulo, descricao, user_id) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $descricao, $user_id]);
    }
}

header("Location: painel.php");
exit;
