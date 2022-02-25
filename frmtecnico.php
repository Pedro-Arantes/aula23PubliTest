<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Tecnico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php 
        include "navbar.php";


       
        
    
    



        
        $idtecnico = isset($_GET["idtecnico"]) ? $_GET["idtecnico"]:null;
        $op = isset($_GET["op"]) ? $_GET["op"]: null;
    
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdos";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);

       try {
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $bd = "bdos";
            $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 
    
            if($idtecnico){
                //estou buscando os dados do cliente no BD
                $sql = "SELECT * FROM  tbltecnicos where idtecnico= :idtecnico";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idtecnico",$idtecnico);
                $stmt->execute();
                $tecnico = $stmt->fetch(PDO::FETCH_OBJ);
                //var_dump($cliente);
            }
            if($_POST){
                if($_POST["idtecnico"]){
                    $sql = "UPDATE tbltecnicos SET nome=:nome, statu=:statu, dtreceb=:dtreceb, idpedido=:idpedido WHERE idtecnico =:idtecnico";
                    $stmt = $con->prepare($sql);
                    $stmt->bindValue(":nome", $_POST["nome"]);
                    $stmt->bindValue(":statu", $_POST["statu"]);
                    $stmt->bindValue(":dtreceb", $_POST["dtreceb"]);
                    $stmt->bindValue(":idpedido", $_POST["idpedido"]);
                    $stmt->bindValue(":idtecnico", $_POST["idtecnico"]);
                    $stmt->execute(); 
                } else {
                    $sql = "INSERT INTO tbltecnicos(nome,statu,dtreceb,idpedido) VALUES (:nome,:statu,:dtreceb, :idpedido)";
                    $stmt = $con->prepare($sql);
                    $stmt->bindValue(":nome",$_POST["nome"]);
                    $stmt->bindValue(":statu",$_POST["statu"]);
                    $stmt->bindValue(":dtreceb",$_POST["dtreceb"]);
                    $stmt->bindValue(":idpedido", $_POST["idpedido"]);
                    $stmt->execute(); 
                }
                header("Location:listastatus.php");
            } 
        } catch(PDOException $e){
             echo "erro".$e->getMessage;
            }
    
        if ($op=="del") {
            $sql = "DELETE from tbltecnicos where idtecnico= :idtecnico";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idtecnico",$idtecnico);
            $stmt->execute();
            header("Location:listastatus.php");
        }


    
        //require ('./inc/Config.inc.php');
    
        //$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
       
    
    
    
        
        
    
        

        
    ?>
    <h1>Cadastro de Tecnicos</h1>

    <form name ="CadTecnico" action="" method="post" enctype="multipart/form-data" >

    <div class="mb-3">
        <label class="form-label">Nome</label>

        <input value="<?php echo isset($tecnico) ? $tecnico->nome : null ?>" type="text" class="form-control" name="nome" placeholder="Seu nome" required>

        <br>



        

       

        <div class="mb-3 form">
        <label for="status">Situação do Pedido:</label>

            <select name="statu" id="status" required>
            <option value="avaliando">Avaliando</option>
            <option value="autorizado">Autorizado</option>
            <option value="esperando peça">Esperando Peça</option>
            <option value="execução">Execução</option>
            <option value="Terminado">Terminado</option>
            </select>
            
        </div>
        <br>
    </div>

    <label class="form-label">Numero do Pedido</label>

    <input type="text" value="<?php echo isset($tecnico) ? $tecnico->idpedido : null ?>" class="form-control" name="idpedido" placeholder="numero do pedido" required>
    


    <label class="form-label">Data de Recebimento</label>

    <input type="date" value="<?php echo isset($tecnico) ? $tecnico->dtreceb : null ?>" class="form-control" name="dtreceb" placeholder="data de recebimento" required>

    <br>
    <input type="hidden"     name="idtecnico"   value="<?php echo isset($tecnico) ? $tecnico->idtecnico : null ?>">

    

    



    <input class="btn btn-outline-primary" type="submit" value="Cadastrar" name="SendCadTecnico">

</form>

<?php
    include "rodape.php";
?>

</body>
</html>