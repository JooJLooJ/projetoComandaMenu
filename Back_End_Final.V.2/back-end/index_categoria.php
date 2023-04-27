<?php
include_once("conexao.php");
session_start();
$idMesa = $_SESSION['idMesa'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_categoria.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <title>Sistema de Comanda Eletrônica</title>
</head>

<body>

    <div class="container-fluid containerPrincipal">
        <div class="row linha1 justify-content-center">
            <div class="col coluna-nav">
                <div class="botoes">
                    <button class="botao1">Ver pedidos</button>
                    <button class="botao2">Cadastro / Editar</button>
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

                        <div class="row justify-content-center categoriasrow">
                            <!-- SELECIONA AS MESAS CADASTRADAS NO BANCO DE DADOS -->
                            <?php
                            $sql = "SELECT * FROM mesa ORDER BY idMesa";
                            $result = $conn->query($sql);


                            while ($row = mysqli_fetch_assoc($result)) {
                                $idStatusMesa = $row['idStatusMesa'];
                                /* SELECIONA OS STATUS DA MESA */
                                $sql2 = "SELECT * FROM statusmesa WHERE idStatusMesa = $idStatusMesa";
                                $result2 = $conn->query($sql2);
                                $dados = mysqli_fetch_assoc($result2);
                                if ($idStatusMesa == 1) {

                            ?>
                                    <!-- LISTA AS MESAS -->
                                    <?php
                                    if (!isset($idMesa)) {
                                    ?>
                                        <div class="col-md-4 text-center mb-3 bg-primary">
                                            <a class="text-white" href="<?php echo 'index.php?id=' . $row['idMesa'] ?>"><?php echo $row['idMesa']; ?></a>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-md-4 text-center mb-3">
                                            <p class="containernmesa text-white"><?php echo $row['idMesa'] ?></p>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                <?php
                                } else {
                                ?>

                                    <div class="col-md-4 text-center mb-3">
                                        <p class="containernmesa2 text-white"><?php echo $row['idMesa'] ?></p>
                                    </div>
                            <?php

                                }
                            }
                            ?>
                        </div>

                    </div>
                </div>



            </div>

            <div class="col-2 interface2">
                <?php
                $idCat = $_GET['idCat'];
                $_SESSION['idCat'] = $idCat;
                /* MOSTRA A CATEGORIA */
                $sql3 = "SELECT * FROM categoriaalimento WHERE idCatAlimento = $idCat";
                $result3 = $conn->query($sql3);

                /* MOSTRA OS ALIMENTOS DA CATEGORIA SELECIONADA */
                while ($rowCat = mysqli_fetch_assoc($result3)) {
                    $sql4 = "SELECT * FROM alimento WHERE idCatAlimento = $idCat";
                    $result4 = $conn->query($sql4);

                ?>
                    <div class="divbotao_voltar">
                        <a class="botao_voltar bi bi-arrow-left-circle" href="<?php echo 'index.php?id=' . $idMesa ?>"></a>
                    </div>
                    <div class="frase1_interface2">
                        <?php echo $rowCat['nomeCatAlimento']; ?>
                    </div>
                    <?php

                    while ($rowAli = mysqli_fetch_assoc($result4)) {
                        $_SESSION['preco'] = $rowAli['valorUnidade'];
                    ?>
                        <div class="col border mb-3">

                            <div>
                                <p class="text-black">
                                    <?php echo $rowAli['nomeAlimento']; ?>
                                </p>
                                <p class="text-black">
                                    <?php echo $rowAli['descAlimento']; ?>
                                </p>
                            </div>
                            <div>

                                <a href="<?php echo 'adicionarProduto.php?idAli=' . $rowAli['idAlimento'] ?>">Confirmar</a>
                            </div>

                        </div>

                <?php
                    }
                }
                ?>

            </div>
            <div class="col-4 order-last interface3">
                <div class="tamanho_interface3">
                    <div class="col coluna1">

                        <?php

                        echo "<p class='texto1'>Mesa " . $idMesa . "</p>";

                        ?>
                    </div>
                    <?php
                    /* MOSTRA OS ITENS DO PEDIDO */

                    $sqlPedido = "SELECT idPedido, idAlimento, count(idAlimento) as qtd FROM pedidos WHERE idMesa  = $idMesa and idStatusPedido = 1 group by idAlimento";
                    $resultPedido = $conn->query($sqlPedido);
                    if (mysqli_num_rows($resultPedido) > 0) {
                    ?>
                        <div class="col coluna2">

                            <tbody>
                                <?php

                                while ($rowPedido = mysqli_fetch_assoc($resultPedido)) {

                                    $sqlAli = "SELECT * FROM alimento WHERE idAlimento = $rowPedido[idAlimento]";
                                    $resultAli = $conn->query($sqlAli);
                                    $rowAli = mysqli_fetch_assoc($resultAli);
                                ?>
                                    <div class="border">
                                        <td><?php echo $rowAli['nomeAlimento'] . "<br>" ?></td>
                                        <td><?php echo $rowAli['descAlimento'] ?></td>
                                        <td><?php echo "Qtd: " . $rowPedido['qtd'] . "<a href='remover_item.php?idItem=$rowPedido[idPedido]' class='bi bi-trash text-danger'></a>" ?></td>

                                    </div>
                                <?php
                                }
                                ?>

                        </div>
                        <div class="col coluna3">Valor Total: R$

                            <!-- MOSTRA O TOTAL A PAGAR -->
                            <?php
                            $idPedido = $_SESSION['pedido'];

                            $sqlPed2 = "SELECT * FROM pedidos WHERE pedido = $idPedido";
                            $resultPed2 = $conn->query($sqlPed2);

                            $total = 0;
                            while ($dadosPed = mysqli_fetch_array($resultPed2)) {
                                $sqlAli = "SELECT * FROM alimento WHERE idAlimento = $dadosPed[idAlimento]";
                                $resultAli = $conn->query($sqlAli);
                                $dadosAli = mysqli_fetch_assoc($resultAli);

                                $valor = $dadosAli['valorUnidade'];
                                $total = $total + $valor;
                                
                            }
                            echo $total . "<br>";
                            ?>
                        </div>
                        <div class="col coluna4"><a href="mensagem.php">Faça seu pedido</a></div>
                    <?php
                    } else {
                    ?>
                        <div class="col coluna2">Sem itens no pedido</div>
                        <div class="col coluna3">Valor Total: R$ 0.00</div>
                        <div class="col coluna4">Adicione produto</div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>


    </div>

</body>

</html>