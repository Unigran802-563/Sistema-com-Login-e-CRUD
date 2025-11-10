<?php
session_start(); 
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        
        
        if ($user && password_verify($senha, $user['senha'])) {
            
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];

            
            header("Location: painel.php");
            exit;
        } else {
            
            header("Location: login.php?erro=1");
            exit;
        }
    } catch (PDOException $e) {
        die("Erro no login: " . $e->getMessage());
    }
} else {
    header("Location: login.php");
    exit;
}
