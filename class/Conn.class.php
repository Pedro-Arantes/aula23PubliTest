<?php



class Conn

{

    //Declarando os atributos

    public static $host = HOST;

    public static $user = USER;

    public static $pass = PASS;

    public static $dbname = DBNAME;



    //Pode ser acessada de qualquer método, mas somente nesta classe

    private static $connect = null;



    //Método conectar

    private static function conectar()

    {

        try {

            //Efetuar a conexão com o BD

            //Usa o self:: porque o encapsulamento da variável $connect é privada

            if(self::$connect == null):

                //PDO(host, dbname, user, pass)

                self::$connect = new PDO('mysql:host='.self::$host.';dbname='.self::$dbname, self::$user, self::$pass);





            endif;

            

        } catch (Exception $e) {

            echo "Mensagem de erro " .$e->getMessage();

            die();

            

        }

        return self::$connect;



    }



    //Método que executa o método conectar()

    function getConn(){

        return self::conectar();

    }





}