<?php
session_start();

// Se o usuário já estiver logado, redireciona para o painel
if (isset($_SESSION['user_id'])) {
    header("Location: painel.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <?php

        if (isset($_GET['status']) && $_GET['status'] == 'sucesso') {
            echo "<p class='mensagem-sucesso'>Cadastro realizado com sucesso! Faça o login.</p>";
        }

        if (isset($_GET['erro']) && $_GET['erro'] == '1') {
            echo "<p class='mensagem-erro'>Email ou senha inválidos.</p>";
        }
        ?>

        <form action="processa_login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>
        <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a>.</p>
    </div>
</body>

</html>