<?php


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/reserva-regras.css">
    <title>REGRAS DA RESERVA | CHULETA</title>
</head>

<body>

    <?php include 'menu_publico.php'; ?>

    <main class="container regras-panel">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-danger">
                        <div class="panel-heading text-center">
                            <h2>Regras para Realização de Reservas</h2>
                        </div>
                        <div class="panel-body">

                            <h3 class="rule-title">1. Horário de Funcionamento das Reservas</h3>
                            <p>As reservas podem ser realizadas de segunda a sábado, das 10h às 22h.</p>
                            <p>Aos domingos e feriados, as reservas devem ser feitas até às 18h.</p>
                            <hr>

                            <h3 class="rule-title">2. Procedimento de Reserva</h3>
                            <p>As reservas podem ser feitas por telefone, pelo site oficial ou diretamente no balcão da churrascaria.</p>
                            <p>Para efetuar a reserva, é necessário fornecer o CPF, nome completo, número de telefone, e-mail e a quantidade de pessoas.</p>
                            <hr>

                            <h3 class="rule-title">3. Antecedência para Reservas</h3>
                            <p>As reservas devem ser feitas com pelo menos 24 horas de antecedência e no máximo com 90 dias.</p>
                            <hr>

                            <h3 class="rule-title">4. Confirmação da Reserva</h3>
                            <p>Após a solicitação da reserva, o cliente receberá uma confirmação por e-mail ou mensagem de texto no prazo de até 2 horas.</p>
                            <hr>

                            <h3 class="rule-title">5. Tolerância de Atraso</h3>
                            <p>A churrascaria oferece uma tolerância de até 15 minutos para atrasos.</p>
                            <p>Após esse período, a reserva poderá ser cancelada automaticamente e a mesa liberada para outros clientes.</p>
                            <hr>

                            <h3 class="rule-title">6. Preferências e Pedidos Especiais</h3>
                            <p>Qualquer solicitação especial, como pratos específicos, decoração ou acomodações especiais, deve ser informada no momento da reserva.</p>
                            <p>A equipe fará o possível para atender às preferências, mas não garante a disponibilidade de todas as solicitações.</p>
                            <hr>

                            <!-- Botões em linha -->
                            <div class="row text-center btn-group-custom">
                                <div class="col-xs-12 col-sm-6">
                                    <a href="LoginCliente.php" class="btn btn-success btn-lg btn-block">
                                        <span class="glyphicon glyphicon-ok"></span> Estou ciente das regras
                                    </a>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <a href="index.php" class="btn btn-danger btn-lg btn-block">
                                        <span class="glyphicon glyphicon-remove"></span> Não concordo com os termos
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- Fim da moldura vermelha -->

            </div>
        </div>
    </main>

</body>


</html>