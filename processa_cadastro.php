<?php
require_once 'conexao.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    
    if (empty($nome) || empty($email) || empty($senha)) {
        die("Por favor, preencha todos os campos.");
    }

    
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            die("Este e-mail já está cadastrado. Tente outro.");
        }

        
        $sql = "INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $senhaHash]);

        
        header("Location: login.php?status=sucesso");
        exit;
    } catch (PDOException $e) {
        die("Erro ao cadastrar usuário: " . $e->getMessage());
    }
} else {
    
    header("Location: cadastro.php");
    exit;
}
