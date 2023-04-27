<?php
include_once("conexao.php");
session_start();


$sqlMesa = "SELECT * FROM mesa WHERE idStatusMesa = 2 ";
$resultMesa = $conn->query($sqlMesa);
while ($rowMesa = mysqli_fetch_assoc($resultMesa)) {
    $mesa = $rowMesa['idMesa'];
    $sqlVeri = "SELECT * FROM pedidos WHERE idMesa = $mesa AND idStatusPedido = 1";
    $resultVeri = $conn->query($sqlVeri);


    if (mysqli_num_rows($resultVeri) < 1) {
        $sql5 = "UPDATE mesa SET idStatusMesa = 1 WHERE idMesa = $mesa ";
        $result5 = $conn->query($sql5);
    }
}

if (isset($_GET['id'])) {
    $idMesa = $_GET['id'];
    $_SESSION['idMesa'] = $idMesa;
    $idMesa2 = $idMesa;
    $sqlStatus = "UPDATE mesa SET idStatusMesa = 2 where idMesa = $idMesa2";
    $resultMesa = $conn->query($sqlStatus);
    $idMesa2 = "";
} else {
    $_SESSION['cont'] = 1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <title>Sistema de Comanda Eletrônica</title>
</head>

<body>

    <div class="container-fluid containerPrincipal">
        <div class="row linha1 justify-content-center">
            <div class="col coluna-nav">
                <div class="botoes">
                    <?php
                    if (!isset($idMesa)) {
                        ?>
                        <a href="visualizar_pedidos.php" class="botao1 text-center">Ver pedidos</a>
                        <a href="cadastros.php" class="botao2 text-center">Cadastro / Editar</a>
                        <?php
                    } else {
                        ?>
                        <span class="botao1 text-center">Ver pedidos</span>
                        <span class="botao2 text-center">Cadastro / Editar</span>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>


        <div class="row linha2">
            <div class="col-4 order-first interface1">

                <div class="row justify-content-around">
                    <div class="col-md-12 col_comanda justify-content-center">
                        <div class="row">
                            <div class="col">
                                <div class="imagem_legenda">
                                    <img src="image/Legenda.png" class="img-fluid ">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center categoriasrow">
                            <?php
                            //MOSTRA AS MESAS CADASTRADAS NO BANCO DE DADOS
                            $sql = "SELECT * FROM mesa ORDER BY idMesa";
                            $result = $conn->query($sql);
                            ////////////////////////////////////////
                            
                            //CLASSIFICA AS MESA ENTRE OCUPADAS E DISPONIVEIS
                            while ($row = mysqli_fetch_assoc($result)) {
                                $idStatusMesa = $row['idStatusMesa'];
                                $sql2 = "SELECT * FROM statusmesa WHERE idStatusMesa = $idStatusMesa";
                                $result2 = $conn->query($sql2);
                                $dados = mysqli_fetch_assoc($result2);
                                if ($idStatusMesa == 1) {

                                    ?>

                                    <!-- LISTA AS MESAS  -->
                                    <?php
                                    if (!isset($idMesa)) {
                                        ?>
                                        <div class="text-center mb-3 containernmesa">

                                            <a class="texto_categoria link" href="<?php echo 'index.php?id=' . $row['idMesa'] ?>"><?php echo $row['idMesa']; ?></a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="containernmesa text-center mb-3">
                                            <span class="text-white botao justify-content-center">
                                                <?php echo $row['idMesa'] ?>
                                            </span>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                } else {
                                    ?>

                                    <div class="containernmesa2 text-center mb-3">
                                        <span class="text-white">
                                            <?php echo $row['idMesa'] ?>
                                        </span>
                                    </div>
                                    <?php

                                }
                            }
                            ?>
                        </div>
                        <!--  ------------------------------------------------------------- -->

                    </div>
                </div>



            </div>

            <div class="col-4 interface2">
                <!-- SELECIONA AS CATEGORIAS CADASTRADAS NO BANCO DE DADOS-->
                <?php
                $sql3 = "SELECT * FROM categoriaalimento";
                $result3 = $conn->query($sql3);

                /* VERIRIFICA SE ALGUMA CATEGORIA FOI SELECIONADA */
                if (!isset($_GET['id'])) {
                    ?>

                    <div class="frase1_interface2">Bem Vindo(a) ao ComandaMenu!</div>
                    <div class="image-align imagem_hamburguer"><img src="image/comidas.png"
                            class="img-fluid imagem_background"></div>
                    <div class="frase2_interface2">Escolha uma mesa para fazer um pedido</div>

                    <?php
                } else {
                    ?>
                    <a href="index.php" class="bi bi-arrow-left-circle seta"></a>
                    <div class="search_div">
                        <div class="search_bar justify-content-center">
                            <button class="botao_search ">
                                <span class="bi bi-search icone"></span>
                            </button>
                            <input class="escrever" placeholder="Pesquise aqui" type="search">
                        </div>
                    </div>

                    <div class="tudo_categoria ">
                        <div class="row justify-content-center categorias">
                            <?php

                            while ($rowCat = mysqli_fetch_assoc($result3)) {
                                ?>
                                <div class="col-3 col_imag mb-3">
                                    <a href="<?php echo 'index_categoria.php?idCat=' . $rowCat['idCatAlimento'] ?>"
                                        class="botao_imagem">
                                        <img src="image/lanches.jpeg" class="img-fluid img_class">
                                    </a>
                                    <p class="texto_categorias">
                                        <?php echo $rowCat['nomeCatAlimento'] ?>
                                    </p>
                                </div>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>


            <div class="col-4 order-last interface3">
                <div class="tamanho_interface3">
                    <?php
                    if (isset($idMesa)) {
                        ?>
                        <div class="col coluna1 azul">

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
                                            <td>
                                                <?php echo $rowAli['nomeAlimento'] . "<br>" ?>
                                            </td>
                                            <td>
                                                <?php echo $rowAli['descAlimento'] ?>
                                            </td>
                                            <td>
                                                <?php echo "Qtd: " . $rowPedido['qtd'] . "<a href='remover_item2.php?idItem=$rowPedido[idPedido]' class='bi bi-trash text-danger'></a>" ?>
                                            </td>

                                        </div>
                                        <?php
                                    }
                                    ?>

                            </div>
                            <div class="col coluna3">Valor Total: R$

                                <!-- MOSTRA O TOTAL A PAGAR -->
                                <?php
                                $sqlPed2 = "SELECT * FROM pedidos";
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

                            <?php
                        } else {
                            ?>
                            <div class="col coluna2">Sem itens no pedido</div>
                            <div class="col coluna3">Valor Total: R$ 0.00</div>
                            <?php
                        }
                        ?>

                        <div class="col coluna4A">Faça seu pedido</div>
                        <?php
                    } else {
                        ?>

                        <div class="col coluna1">
                            <p class='texto1'>Escolha uma mesa </p>
                        </div>
                        <div class="col coluna2">Sem itens no pedido</div>
                        <div class="col coluna3">Valor Total: R$ 0.00</div>
                        <div class="col coluna4">Realizar pedido</div>
                        <!-- <?php
                    }
                    ?> -->
                </div>
            </div>
        </div>

</body>

</html>