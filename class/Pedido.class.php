<?php



class Pedido{

    private $dados;

    private $msg;

    private $resultado;



    const Entity = 'tblpedidos';



    public function exeCreate(array $dados){

        $this->dados = $dados;

        $this->validarDados();

        

        if($this->resultado):

            $this->cadastrar();

        endif;

    }



    public function getResultado() {

        return $this->resultado;

    }



    public function getMsg() {

        return $this->msg;

    }



    public function validarDados(){

        $this->dados = array_map('strip_tags',$this->dados);

        $this->dados = array_map('trim',$this->dados);



        if(in_array('',$this->dados)):

            $this->resultado = false;

            $this->msg = "<p style='color:red'><b>Erro ao Cadastrar</b></p>";

        else:

            $this->resultado = true;

        endif;



    }



    public function cadastrar(){

        $create =  new Create;

        $create->exeCreate(self::Entity, $this->dados);



        if($create->getResultado()):

            $this->resultado = $create->getResultado();

            $this->msg = "<p style='color:green'><b>Cadastrou</b></p>";

        endif;



    }





}

