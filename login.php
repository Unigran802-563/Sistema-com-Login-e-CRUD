<?php

session_start();


if (isset($_SESSION['user_id'])) {
    header("Location: painel.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <?php
    // Exibe mensagem de sucesso se o cadastro foi bem-sucedido
    if (isset($_GET['status']) && $_GET['status'] == 'sucesso') {
        echo "<p style='color:green;'>Cadastro realizado com sucesso! Faça o login.</p>";
    }
    // Exibe mensagem de erro no login
    if (isset($_GET['erro']) && $_GET['erro'] == '1') {
        echo "<p style='color:red;'>Email ou senha inválidos.</p>";
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
</body>

</html>