<?php
//include "conexao.php";
//include "menu.php";

$servidor = "localhost";
$usuario = "root";
$senha = "";
$bd = "bdos";

try{
            //PDO("banco:host=nomedohost;dbname=nomedo bd",usuario,senha)                
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);
} catch(PDOException $e) {
    echo "Erro: ".$e->getMessage();
}

try{
    $sql = "SELECT * FROM tbltecnicos";
    $qry = $con->query($sql);
    $tecnicos = $qry->fetchALL(PDO::FETCH_OBJ);

    //echo "<pre>";
    //    print_r($clientes);
       
} catch(PDOException $e){
    echo $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status do Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php 
        include "navbar.php";
    ?>    
    <h1>Situação do Pedido</h1>
<hr>

<div class="container">
    <a href="frmtecnico.php" class="btn btn-outline-primary">Novo</a>
    <br> <br>
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th>idtecnico</th>
                <th>Nome do Técnico</th>
                
                
                <th>Status</th>
                <th>Numero do Pedido</th>
                <th>Data de Recebimento</th>
                
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($tecnicos as $tecnico) { ?>
            <tr>
                <th><?php echo $tecnico->idtecnico ?></th>
                <th><?php echo $tecnico->nome ?></th>
                
                
                
                <th><?php echo $tecnico->statu ?></th>
                <th><?php echo $tecnico->idpedido ?></th>
                <th><?php echo $tecnico->dtreceb ?></th>
                

                <th > <a class="btn btn-outline-warning" href="frmtecnico.php?idtecnico=<?php echo $tecnico->idtecnico ?>">
                <img src="./img/editar.png" alt="">
                </a> </th>

                <th > <a class="btn btn-outline-danger" href="frmtecnico.php?op=del&idtecnico=<?php echo $tecnico->idtecnico ?>">
                <img src="./img/deletar.png" alt="">
                </a> </th> 
            </tr>
            <?php } ?>
            </tbody>
           

    </table>
</div>


    <?php
        include "rodape.php";
    ?>

</body>
</html>