<?php

include_once("conexao.php");
session_start();

$idCat = $_SESSION['idCat'];
$idAli = $_GET['idAli'];


if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $desc = $_POST['desc'];


    $sqlAli = "UPDATE alimento SET idCatAlimento = $categoria, descAlimento = '$desc', nomeAlimento = '$nome', valorUnidade = $preco, fotoAlimento =  'teste' WHERE idAlimento  = $idAli";
    $resultAli = $conn->query($sqlAli);

    echo "<script>
        alert('Editado com sucesso');
        window.location.href = 'cadastros.php';
    </script>";
}
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
                        <div class="row text-dark">
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
                                    <div class="col-md-4 text-center mb-3">
                                        <?php
                                        if (!isset($idMesa)) {
                                        ?>
                                            <a href="<?php echo 'index.php?id=' . $row['idMesa'] ?>"><?php echo $row['idMesa'], $dados['status']; ?></a>
                                        <?php
                                        } else {
                                        ?>
                                            <?php echo $row['idMesa'], $dados['status']; ?>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-md-4 text-center mb-3">
                                        <?php echo $row['idMesa'], $dados['status']; ?>
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
                    <div class="col-md-8">
                        <a href="<?php echo 'editar_alimento2.php?idCat='.$idCat ?>">Voltar</a>
                        <div class="texto1 text-dark">Editar alimento</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <?php 
                        $sqlAli = "SELECT * FROM alimento WHERE idAlimento = $idAli";
                        $resultAli = $conn->query($sqlAli);
                        $rowAli = mysqli_fetch_assoc($resultAli);

                        $sqlCat2 = "SELECT * FROM categoriaalimento WHERE idCatAlimento = $idCat";
                        $resultCat2 = $conn->query($sqlCat2);
                        $rowCat2 = mysqli_fetch_assoc($resultCat2);
                    ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="" class="text-dark">Escolha uma Foto:</label>
                        <input type="file" class="form-control">
                        <label for="" class="text-dark">Nome:</label>
                        <input type="text" class="form-control" name="nome" value="<?php echo $rowAli['nomeAlimento'] ?>">
                        <label for="" class="text-dark">Preço:</label>
                        <input type="text" class="form-control" name="preco"  value="<?php echo $rowAli['valorUnidade'] ?>">
                        <label for="" class="text-dark">Categoria:</label>
                        <select class="form-select" name="categoria">
                            <option value="<?php echo $rowCat2['idCatAlimento'] ?>" selected><?php echo $rowCat2['nomeCatAlimento'] ?></option>
                            <?php
                            $sqlCat = "SELECT * FROM categoriaalimento";
                            $resultCat = $conn->query($sqlCat);
                            while ($row = mysqli_fetch_assoc($resultCat)) {
                            ?>
                                <option value="<?php echo $row['idCatAlimento'] ?>"><?php echo $row['nomeCatAlimento'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="" class="text-dark">Descricao:</label>
                        <input type="text" class="form-control" name="desc" value="<?php echo $rowAli['descAlimento'] ?>">
                        <input type="submit" name="submit" class="btn btn-danger mt-4" value="Editar">
                    </form>
                </div>

            </div>
            <div class="col-4 order-last interface3">
                <div class="tamanho_interface3">
                    <div class="col coluna1 d-flex align-items-center ">
                        <p class='text-ceNter'>Editando </p>
                    </div>
                    <div class="col coluna2"></div>
                    <div class="col coluna4">Escolha uma edição</div>
                </div>
            </div>
        </div>

</body>

</html>