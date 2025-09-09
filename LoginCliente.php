<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2>Login</h2>
  <form action="AuthLoginCliente.php" method="POST" class="mt-3">
    <div class="mb-3">
      <label>Email:</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Senha:</label>
      <input type="password" name="senha" class="form-control" required>
    </div>
  <a href="reserva.php" class="btn btn-success">Fazer Reserva</a>
  <a href="CadCliente.php">Cadastre-se</a>
  </form>
</body>
</html>
