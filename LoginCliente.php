<?php
session_start();
require './conn/connect.php';

$erro_login = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE login = ?");
    $stmt->execute([$email]);
    $cliente = $stmt->fetch();

    if ($cliente && password_verify($senha, $cliente['senha'])) {
        $_SESSION['cliente_id'] = $cliente['id'];
        $_SESSION['cliente_nome'] = $cliente['nome'];

        $redirect = $_SESSION['redirect_after_login'] ?? 'reservas.php';
        unset($_SESSION['redirect_after_login']);
        header("Location: $redirect");
        exit();
    } else {
        $erro_login = "Login inválido. Verifique suas credenciais e tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <!-- Font Awesome (para os ícones) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4 text-primary">Faça seu login</h3>

                    <!-- Ícone central -->
                    <div class="text-center mb-4">
                        <i class="fas fa-users fa-4x text-primary"></i>
                    </div>

                    <!-- Mensagem de erro -->
                    <?php if (!empty($erro_login)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($erro_login) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Formulário de login -->
                    <form action="LoginCliente.php" method="POST" id="form_login" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="login" class="form-label">Login:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user text-primary"></i></span>
                                <input type="text" name="login" id="login" class="form-control" required autofocus autocomplete="off" placeholder="Digite seu login." pattern=".*@gmail\.com$"  title="Por favor, use um email do Gmail (@gmail.com)">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock text-primary"></i></span>
                                <input type="password" name="senha" id="senha" class="form-control" required autocomplete="off" placeholder="Digite sua senha.">
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>
                       <a href="CadCliente.php" class="btn btn-default btn-sm">Cadastre-se</a> 
                    </form>

                    <p class="text-center mt-4">
                        <small>
                            Caso não faça uma escolha em 30 segundos, será redirecionado automaticamente para a página inicial.
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (opcional, apenas se for usar recursos como modals ou tooltips) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
