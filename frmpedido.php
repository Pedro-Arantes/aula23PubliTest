<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php 
        include "navbar.php";
        
        $idfuncionario = isset($_GET["idfuncionario"]) ? $_GET["idfuncionario"]:null;
        $op = isset($_GET["op"]) ? $_GET["op"]: null;
    
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdos";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);
    
        if ($op=="del") {
            $sql = "delete from tblpedidos where idpedido= :idpedido";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idpedido",$idfuncionario);
            $stmt->execute();
            header("Location:listarPedidos.php");
        }
    
        require ('./inc/Config.inc.php');
    
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    
    
        if(!empty($dados['SendCadPedido'])):
    
            unset($dados['SendCadPedido']);
    
    
    
            $cadUsuario = new Pedido();
    
            $cadUsuario->exeCreate($dados);
    
    
    
            if(!$cadUsuario->getResultado()):
    
                echo $cadUsuario->getMsg();
    
            else:
    
                echo $cadUsuario->getMsg();
    
            endif;
    
        endif;

        
    
        

        
    ?>
    <h1>Cadastro de Pedidos</h1>

<form name ="Cadproduto" action="" method="post" enctype="multipart/form-data" >

    <div class="mb-3">
        <label class="form-label">Nome</label>

        <input type="text" class="form-control" name="nome" placeholder="Seu nome" required>

        <br>



        <label class="form-label">Serviço Requisitado</label>

        <input type="text" class="form-control" name="servico" placeholder="avaliação" required>

        <br>
    </div>

    
    <label class="form-label">Preço</label>

    <input type="text" class="form-control" name="preco" placeholder="Preço pago" required>


    <label class="form-label">Data de Início</label>

    <input type="date" class="form-control" name="dataini" placeholder="data de inicio" required>

    <br>

    

    



    <input class="btn btn-outline-primary" type="submit" value="Cadastrar" name="SendCadPedido">

</form>

<?php
    include "rodape.php";
?>

</body>
</html>