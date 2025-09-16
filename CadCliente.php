<?php 
include './conn/connect.php';

$erro_cadastro = '';
$erro_login = '';

// Ativa exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_POST) {
    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $nivel = $_POST['nivel'];
    
    if (!str_ends_with($login, '@gmail.com')) {
        $erro_login = "Apenas emails do Gmail são permitidos.";
    } else { 
        // Método alternativo sem try-catch
        $insereUsuario = "INSERT INTO usuarios (login, senha, nivel) VALUES ('$login', '$senha', '$nivel')";
        $result = $conn->query($insereUsuario);
        
        if ($result) {
            $sucesso_cadastro = "('Usuário cadastrado com sucesso!')";
        } else {
            // Verifica se é erro de duplicidade
            if ($conn->errno == 1062) {
                $erro_cadastro = "Este email já está cadastrado!";
            } else {
                $erro_cadastro = "Erro: " . $conn->error;
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
 
    <link rel="stylesheet" href="./css/CadCliente.css">
     <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>INSERE CLIENTE | CHULETA </title>
</head>

<body>
   <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-6  col-md-8">
                <h2 class="breadcrumb text-danger">
                    <a href="LoginCliente.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Inserir Usuário
                </h2>
                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                        <form action="CadCliente.php" method="POST">


                            <label for="text">Login : </label>
                            <input type="text" id="login" name="login" required class="form-control" pattern=".*@gmail\.com$"  title="Por favor, use um email do Gmail (@gmail.com)"  ><br><br>

                            <label for="senha">Senha : </label>
                            <input type="password" id="senha" name="senha" required class="form-control"><br><br>

                            <p>Nivel:</p>

                            <br>
                            <input type="radio" id="nivel" name="nivel" value="com" required checked>
                            <label for="masculino">Comum</label>
                            <br>
                            <br>

                            <input type="submit" value="Enviar" id="button" class="btn btn-danger btn-block">
                              
                    </div>
                </div>
            </div>
        </div>
    </main>
      <!-- jQuery (necessário para Toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

     <?php if (!empty($erro_cadastro)): ?>
        <script>toastr.error('<?php echo addslashes($erro_cadastro); ?>');</script>
    <?php endif; ?>
    
    <?php if (!empty($erro_login)): ?>
        <script>toastr.warning('<?php echo addslashes($erro_login); ?>');</script>
    <?php endif; ?>
    
    <?php if (!empty($sucesso_cadastro)): ?>
        <script>toastr.success('<?php echo addslashes($sucesso_cadastro); ?>');</script>
    <?php endif; ?>
</body>

</html>