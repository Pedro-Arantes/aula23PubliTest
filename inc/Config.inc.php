<?php

//definir acesso ao banco de dados(credenciais de acesso ao BD)

//constantes, são variaveis q n mudam.
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DBNAME','bdos');



spl_autoload_register(function ($Class){

    //var_dump($Class);

    $dirName = 'class';



    if(file_exists("{$dirName}/{$Class}.class.php")){

        require("{$dirName}/{$Class}.class.php");

    } else {

        die("A Classe {$Class}.class.php não foi encontrada");

    }



});


