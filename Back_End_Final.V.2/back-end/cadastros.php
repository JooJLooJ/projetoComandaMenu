<?php

include_once("conexao.php");

$sqlPed = "SELECT p.idMesa, a.nomeAlimento, sum(a.valorUnidade) as valorPagar, s.statuspedido as status FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido group by p.idMesa";
$resultPed = $conn->query($sqlPed);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_categoria.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Sistema de Comanda Eletrônica</title>
</head>

<body>

    <div class="container-fluid containerPrincipal">
        <div class="row linha1 justify-content-center">
            <div class="col coluna-nav">
                <div class="botoes">
                    <a href="visualizar_pedidos.php" class="botao1">Ver pedidos</a>
                    <a href="index.php" class="botao2">Fazer pedido</a>
                </div>
            </div>
        </div>


        <div class="row linha2">


            <div class="col-4 order-first interface1">

                <div class="row justify-content-around">
                    <div class="col-md-12 col_comanda">
                        <div class="row">
                            <div class="col">
                                <div class="imagem_legenda">
                                    <img src="image/Legenda.png" class="img-fluid ">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-around">
                            <?php
                            $sql = "SELECT * FROM mesa ORDER BY idMesa";
                            $result = $conn->query($sql);


                            while ($row = mysqli_fetch_assoc($result)) {
                                $idStatusMesa = $row['idStatusMesa'];
                                $sql2 = "SELECT * FROM statusmesa WHERE idStatusMesa = $idStatusMesa";
                                $result2 = $conn->query($sql2);
                                $dados = mysqli_fetch_assoc($result2);
                                if ($idStatusMesa == 1) {

                            ?>

                                    <?php
                                    if (!isset($idMesa)) {
                                    ?>
                                        <div class="col-md-4 text-center mb-3 bg-primary">
                                            <a class=" text-white" href="<?php echo 'index.php?id=' . $row['idMesa'] ?>"><?php echo $row['idMesa']; ?></a>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-md-4 text-center mb-3">
                                            <p class="bg-primary text-white"><?php echo $row['idMesa'] ?></p>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                <?php
                                } else {
                                ?>

                                    <div class="col-md-4 text-center mb-3">
                                        <p class="bg-danger text-white"><?php echo $row['idMesa'] ?></p>
                                    </div>
                            <?php

                                }
                            }
                            ?>
                        </div>

                    </div>


                </div>



            </div>

            <div class="col-4 interface2">
                <div class="row justify-content-center text center mt-4 mb-5">
                    <div class="col-md-4">
                        <div class="texto1 text-dark">Cadastro</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 p-2 mb-5">
                        <a href="cadastrar_comida.php" class="botao1 p-3">Cadastro alimento</a>
                    </div>
                    <div class="col-12 p-2 mb-5">
                        <a href="cadastrar_categoria.php" class="botao1 p-3">Cadastro categoria</a>
                    </div>
                    <div class="col-12 p-2 mb-5">
                        <a href="cadastrar_mesa.php" class="botao1 p-3">Cadastro mesa</a>
                    </div>
                </div>

                <div class="row justify-content-center text center mt-4 mb-5">
                    <div class="col-md-4">
                        <div class="texto1 text-dark">Editar</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 p-2 mb-5">
                        <a href="editar_alimento.php" class="botao2 p-3">Editar alimento</a>
                    </div>
                    <div class="col-12 p-2 mb-5">
                        <a href="editar_categoria.php" class="botao2 p-3">Editar categoria</a>
                    </div>
                    <div class="col-12 p-2 mb-5">
                        <a href="editar_mesa.php" class="botao2 p-3">Editar mesa</a>
                    </div>
                </div>

            </div>
            <div class="col-4 order-last interface3">
                <div class="tamanho_interface3">
                    <div class="col coluna1 d-flex align-items-center ">
                        <p class='text-ceNter'>Escolha um cadastro</p>
                    </div>
                    <div class="col coluna2"></div>
                    <div class="col coluna4">Escolha uma edição</div>
                </div>
            </div>
        </div>

</body>

</html>