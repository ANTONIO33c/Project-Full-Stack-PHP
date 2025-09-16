<?php
include './conn/connect.php';
// Inicia sessão com nome personalizado
session_name('clientes');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$erro_login = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $senha = md5(trim($_POST['senha']));

    if (!str_ends_with($login, '@gmail.com')) {
        $erro_login = "Somente emails @gmail.com são permitidos.";
    } else {
        // Prepara query segura
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE login = ? AND senha = ?");
        $stmt->bind_param("ss", $login, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
        $rowLogin = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            $_SESSION['login_usuario'] = $rowLogin['login'];
            $_SESSION['nivel_usuario'] = $rowLogin['nivel'];
            $_SESSION['id_usuario'] = $rowLogin['id'];
            $_SESSION['nome_da_sessao'] = session_name();

            if ($rowLogin['nivel'] == 'com') {
                echo "<script>window.location.href='reserva.php';</script>";
                exit;
            } else {
                $erro_login = "Acesso negado. Seu perfil não é do tipo 'cliente'.";
            }
        } else {
            $erro_login = "Login ou senha incorretos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login Cliente</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 3 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- Font Awesome 4 (compatível com glyphicons) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background-color: #f8f8f8;">

<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">

                    <h2 class="breadcrumb text-primary">
                        <a href="reserva_regras.php" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        Faça seu Login
                    </h2>

                    <div class="text-center" style="margin-bottom: 20px;">
                        <i class="fa fa-users fa-4x text-primary"></i>
                    </div>
                    <!-- Formulário -->
                    <form action="LoginCliente.php" method="POST" id="form_login" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="login">Login (Gmail):</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user text-primary"></i></span>
                                <input type="text" name="login" id="login" class="form-control" required
                                    placeholder="Digite seu login"
                                    pattern=".*@gmail\.com$"
                                    title="Use um email do Gmail (@gmail.com)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock text-primary"></i></span>
                                <input type="password" name="senha" id="senha" class="form-control" required placeholder="Digite sua senha">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        <a href="CadCliente.php" class="btn btn-default btn-block">Cadastre-se</a>
                    </form>

                    <p class="text-center" style="margin-top: 20px;">
                        <small>Você será redirecionado automaticamente após 30 segundos.</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Feedback Toastr -->
<?php if (!empty($erro_login)) : ?>
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-center"
    };
    toastr.error("<?= addslashes($erro_login); ?>");
</script>
<?php endif; ?>

</body>
</html>
