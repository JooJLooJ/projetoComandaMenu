<?php

include_once("conexao.php");


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
                    <a href="index.php" class="botao1">Fazer pedido</a>
                    <a href="cadastros.php" class="botao2">Cadastro / Editar</a>
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
                <?php
                $sql3 = "SELECT * FROM categoriaalimento";
                $result3 = $conn->query($sql3);


                ?>

                <div class="tudo_categoria ">
                    <div class="row justify-content-center text center mt-4 mb-5">
                        <div class="col-md-4">
                            <div class="texto1 text-dark">Pedidos</div>
                        </div>
                    </div>
                    <?php

                    $sqlPed = "SELECT p.idPedido, p.idMesa, sum(a.valorUnidade) as valorPagar, s.statuspedido as status FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido where p.idStatusPedido = 1 group by p.idMesa ";
                    $resultPed = $conn->query($sqlPed);

                    while ($rowPed = mysqli_fetch_assoc($resultPed)) {
                        $num = mysqli_num_rows($resultPed);
                    ?>
                        <div class="row border mb-3">
                            <div class="col-12 p-2 d-flex justify-content-around">
                                <span class="text-dark texto-1">Mesa: <?php echo $rowPed['idMesa'] ?></span>
                                <span class="text-dark texto-1">Produto:
                                    <?php

                                    $idMesa2 = $rowPed['idMesa'];

                                    $sqlAux2 = "select p.pedido from pedidos p where p.idMesa = $idMesa2 and p.idStatusPedido = 1 group by p.pedido";
                                    $resultAux2 = $conn->query($sqlAux2);
                                    $rowAux2 = mysqli_fetch_assoc($resultAux2);

                                    $pedido = $rowAux2['pedido'];
                                    $sqlAux = "SELECT a.nomeAlimento FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido WHERE p.idMesa = $idMesa2 AND p.pedido = $pedido";
                                    $resultAux = $conn->query($sqlAux);

                                    while ($rowAux = mysqli_fetch_assoc($resultAux)) {
                                        echo " - " . $rowAux['nomeAlimento'];
                                    }

                                    ?>
                                </span>
                                <span class="text-dark texto-1">Total: <?php echo $rowPed['valorPagar'] ?></span>
                                <span class="text-dark texto-1"><?php echo $rowPed['status'] ?></span>
                                <?php
                                if ($rowPed['status']  != 'Pago') {
                                ?>
                                    <span class="text-dark texto-1"><a href="<?php echo "finalizar_pedido.php?id=" . $rowPed['idMesa'] ?>">Finalizar</a></span>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <?php

                    $sqlPed3 = "SELECT p.idMesa FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido where p.idStatusPedido = 2 group by p.idMesa";
                    $resultPed3 = $conn->query($sqlPed3);

                    while ($rowPed3 = mysqli_fetch_assoc($resultPed3)) {

                        $idMesa3 = $rowPed3['idMesa'];

                        $sqlAux4 = "select p.pedido from pedidos p where p.idMesa = $idMesa3 and p.idStatusPedido = 2 group by p.pedido";
                        $resultAux4 = $conn->query($sqlAux4);

                        while ($rowAux4 = mysqli_fetch_assoc($resultAux4)) {

                            $sqlPed2 = "SELECT p.idPedido, p.idMesa, sum(a.valorUnidade) as valorPagar, s.statuspedido as status FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido where p.idStatusPedido = 2 group by p.pedido";
                            $resultPed2 = $conn->query($sqlPed2);

                            $rowPed2 = mysqli_fetch_assoc($resultPed2);

                    ?>
                            <div class="row border mb-3">
                                <div class="col-12 p-2 d-flex justify-content-around">
                                    <span class="text-dark texto-1">Mesa: <?php echo $rowPed3['idMesa'] ?></span>
                                    <span class="text-dark texto-1">Produto:
                                        <?php

                                        $pedido2 = $rowAux4['pedido'];

                                        $sqlAux3 = "SELECT a.nomeAlimento FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido WHERE p.idMesa = $idMesa3 AND p.pedido = $pedido2";
                                        $resultAux3 = $conn->query($sqlAux3);

                                        while ($rowAux3 = mysqli_fetch_assoc($resultAux3)) {
                                            echo " - " . $rowAux3['nomeAlimento'];
                                        }

                                        ?>
                                    </span>

                                    <span class="text-dark texto-1">Total:
                                        <?php
                                        $sqlV = "SELECT sum(a.valorUnidade) as valorPagar FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido WHERE p.idMesa = $idMesa3 AND p.pedido = $pedido2";
                                        $resultV = $conn->query($sqlV);
                                        $rowV = mysqli_fetch_assoc($resultV);
                                        echo $rowV['valorPagar'];
                                        ?>
                                    </span>

                                    <span class="text-dark texto-1"><?php echo $rowPed2['status'] ?></span>

                                    <?php
                                    if ($rowPed2['status']  != 'Pago') {
                                    ?>
                                        <span class="text-dark texto-1"><a href="<?php echo "finalizar_pedido.php?id=" . $rowPed2['idMesa'] ?>">Finalizar</a></span>
                                        
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    <?php
                    }

                    ?>
                </div>


            </div>
            <div class="col-4 order-last interface3">
                <div class="tamanho_interface3">
                    <div class="col coluna1">

                        <?php
                        if (!isset($_GET['id'])) {
                            echo "<p class='texto1'>Escolha uma mesa</p>";
                        } else {
                            echo "<p class='texto1'>Mesa " . $idMesa . "</p>";
                        }
                        ?>
                    </div>
                    <div class="col coluna2">Sem itens no pedido</div>
                    <div class="col coluna3">Valor Total: R$</div>
                    <div class="col coluna4">Escolha uma mesa</div>
                </div>
            </div>
        </div>

</body>

</html>