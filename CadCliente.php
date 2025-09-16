<?php 
include './conn/connect.php';

$erro_cadastro = '';
$erro_login = '';
$sucesso_cadastro = '';

// Ativa exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_POST) {
    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $nivel = $_POST['nivel'];

    if (!str_ends_with($login, '@gmail.com')) {
        $erro_login = "Apenas emails do Gmail são permitidos.";
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO usuarios (login, senha, nivel) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $login, $senha, $nivel);
            $stmt->execute();

            $sucesso_cadastro = "Usuário cadastrado com sucesso!";
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $erro_cadastro = "Este email já existe em nossa base de dados, por favor volte a tela anterior e faça login!";
            } else {
                $erro_cadastro = "Erro ao cadastrar: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/CadCliente.css">
     <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>INSERE CLIENTE | CHULETA </title>
</head>

<body>
    <div class="container form-container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <h2 class="breadcrumb text-primary">
                    <a href="LoginCliente.php" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    Cadastro de Cliente
                </h2>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="CadCliente.php" method="POST">

                            <div class="form-group">
                                <label for="login">Login (Email):</label>
                                <input type="email" id="login" name="login" class="form-control" required pattern=".*@gmail\.com$" title="Por favor, use um email do Gmail (@gmail.com)">
                            </div>

                            <div class="form-group">
                                <label for="senha">Senha:</label>
                                <input type="password" id="senha" name="senha" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="nivel">Nível:</label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="nivel" value="com" checked> Comum
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Enviar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery + Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <!-- Toastr Feedback -->
<?php if (!empty($erro_cadastro)): ?>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-center"
        };
        toastr.error('<?php echo addslashes($erro_cadastro); ?>');
    </script>
<?php endif; ?>

<?php if (!empty($erro_login)): ?>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-center"
        };
        toastr.warning('<?php echo addslashes($erro_login); ?>');
    </script>
<?php endif; ?>

<?php if (!empty($sucesso_cadastro)): ?>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-center"
        };
        toastr.success('<?php echo addslashes($sucesso_cadastro); ?>');
    </script>
<?php endif; ?>
</body>

</html>