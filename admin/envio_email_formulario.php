<?php
include 'acesso_com.php';
include '../conn/connect.php';

if($_POST){
    $id = $_POST['id'];
    $ReservaEmail = $_POST['email'];
    $ReservaMesa = $_POST['mesa'];
        
}


if ($_GET){
    $id_form = $_GET['id'];
}else{
    $id_form = 0;  
}

$List = $conn->query('SELECT * FROM reserva WHERE id ='. $id_form);
$row = $List->fetch_assoc();



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Envio de Email | CHULETA</title>
</head>

<body>
    <?php include "menu_adm.php";?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-6  col-md-8">
                <h2 class="breadcrumb text-danger">
                    <a href="reservas_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Envio de Email
                </h2>
                <div class="alert alert-danger" role="alert">
                    <form action="envio_email.php" method="POST" name="form_insere" enctype="multipart/form-data"
                        id="form_insere">
                        <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>">
                        <input type="hidden" name="hora_reserva" value="<?php echo $row['hora_reserva']; ?>">
                        <input type="hidden" name="mesa" value="<?php echo $row['mesa']; ?>">
                        <input type="hidden" name="data_reserva" value="<?php echo $row['data_reserva']; ?>">

                        <label for="especial">Confirme o Email: </label>
                        <input type="text" name="email" id="email" class="form-control" maxlength="40"
                            value="<?php echo $row['email']; ?>">
                        <br>
                        <input type="submit" name="enviar" id="enviar" class="btn btn-success btn-block btn-sm"
                            value="Enviar Email">

                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>