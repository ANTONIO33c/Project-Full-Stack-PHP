<?php
session_start();
include './conn/connect.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE login = ?");
$stmt->execute([$email]);
$cliente = $stmt->fetch();

if ($cliente && password_verify($senha, $cliente['senha'])) {
    $_SESSION['cliente_id'] = $cliente['id'];
    $_SESSION['cliente_nome'] = $cliente['nome'];

    // Redireciona para a página que o cliente queria antes do login
    $redirect = $_SESSION['redirect_after_login'] ?? 'reservas.php';
    unset($_SESSION['redirect_after_login']);
    header("Location: $redirect");
    exit();
} else {
    echo "Login inválido. <a href='login.php'>Tentar novamente</a>";
}
