<?php 
include 'conn/connect.php';

session_name('clientes');
session_start();

if (!isset($_SESSION['login_usuario'])) {
    header("Location: logincliente.php");
    exit;
}

$email = $_SESSION['login_usuario'];

// Processa envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ReservaEmail = $_POST['email']; 
    $cpf = $_POST['cpf'];
    $NumeroPessoas = (int)$_POST['numeroPessoas']; 
    $dataReserva = $_POST['dataDisponivel'];
    $horaReserva = $_POST['HorariosDisponivel'];
    $especificacoes_especiais = trim($_POST['especial']);

    // Formata CPF
    $cpf_formatado = str_replace(['.', '-'], '', $cpf);

    // Converte data para formato YYYY-MM-DD se necessário
    if (strpos($dataReserva, '/') !== false) {
        $result = explode('/', $dataReserva);
        if (count($result) === 3) {
            $dataReserva = $result[2] . '-' . $result[1] . '-' . $result[0];
        }
    }

    // Query segura com prepared statement
    $stmt = $conn->prepare("INSERT INTO reserva 
        (email, cpf, numero_pessoas, data_reserva, hora_reserva, especificacoes_especiais)
        VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("ssisss", 
        $ReservaEmail, 
        $cpf_formatado, 
        $NumeroPessoas, 
        $dataReserva, 
        $horaReserva, 
        $especificacoes_especiais
    );

    if ($stmt->execute()) {
        // Redireciona ou exibe mensagem de sucesso
        echo "<script>alert('Reserva enviada com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao salvar reserva.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <title>RESERVA | CHULETA</title>
</head>

<body>
    <?php include  'menu_publico.php'?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-6  col-md-8">
                <h2 class="breadcrumb text-danger">
                    <a href="usuarios_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Solicitar Reserva
                </h2>
                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                       <form action="reserva.php" method="post" name="form_insere" enctype="multipart/form-data" id="form_insere">
                       <label for="email">EMAIL:</label>
                  <input type="email" name="email" class = "form-control" value="<?php echo htmlspecialchars($email); ?>" readonly>

                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required class="form-control" maxlength="11">

                    <label for="numeroPessoas">Número de pessoas:</label>
                    <input type="number" id="numeroPessoas" name="numeroPessoas" required class="form-control" min="1">
                    <small>O titular da reserva tem direito a uma sobremesa GRÁTIS se o grupo tiver mais de 5 pessoas</small>

                    <label for="dataDisponivel">Data disponível:</label>
                    <input type="date" id="dataDisponivel" name="dataDisponivel" required class="form-control">

                    <label for="HorariosDisponivel">Horário disponível:</label>
                    <input type="time" id="HorariosDisponivel" name="HorariosDisponivel" min="17:00" max="23:00" required class="form-control">
                    <small>Horário de funcionamento: 17h às 23h</small>

                    <label for="especial">Precisa de algo especial? (opcional)</label>
                    <input type="text" id="especial" name="especial" class="form-control" placeholder="Ex: aniversário, pedido especial, etc.">

                    <br>
                    <input type="submit" value="Enviar" id="button" class="btn btn-danger btn-block">
</form>

                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>