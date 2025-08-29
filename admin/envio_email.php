<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader
require '../vendor/autoload.php';
include '../conn/connect.php';




// Buscando dados do email e validando
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

//Dados Horas
$horaReservaRaw = $_POST['hora_reserva'];
$horaReservaObj = new DateTime($horaReservaRaw);
$horaReserva = $horaReservaObj->format('H:i');

// Buscando os dados da mesa
$mesaDisponivel = $_POST['mesa'];

$dataReserva = $_POST['data_reserva'];
// Converte a string da data para o formato desejado
$dataFormatada = date('d/m/Y', strtotime($dataReserva));




// Verifica se o email é válido
if (!$email) {
    die('Endereço de e-mail inválido.');
}

$mail = new PHPMailer(true);

try {
    // Configurações do servidor
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;          // Enable verbose debug output
    $mail->isSMTP();                                // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';           // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                       // Enable SMTP authentication
    $mail->Username   = 'chuletaquente@gmail.com';      // SMTP username (substitua pelo seu email)
    $mail->Password   = 'h a p n o q b c c e s z l c q z';                // SMTP password (substitua pela sua senha)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port       = 587;                        // TCP port to connect to

    // Recipients
    $mail->setFrom('chuletaquente@gmail.com', 'Chuleta Quente'); // Quem envia
    $mail->addAddress($email, 'Destinatario');                        // Quem recebe

    // Content
    $mail->isHTML(true);                              // Set email format to HTML
    $mail->Subject = 'Reserva Aceita';
    $mail->Body = <<<MSG
Sua reserva no horário: $horaReserva na data do dia: $dataFormatada foi aceita pela Churrascaria Chuleta Quente, 
o número da sua mesa é o $mesaDisponivel.
MSG;


    $mail->send();
   echo "<script>
        alert('O email foi enviado ao cliente com sucesso!');
        window.location.href = 'http://localhost/Project-Full-Stack-PHP/admin/index.php';
      </script>";


} catch (Exception $e) {
    echo "O e-mail não pôde ser enviado. Erro: {$mail->ErrorInfo}";
}
?>