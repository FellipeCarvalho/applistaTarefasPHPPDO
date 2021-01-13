<?php
    
    /* Vamos criar uma classe na qual vai manipular os dados que vem do front para o back e vice versa*/

    //classes são por convensão inciadas com letrar maiuculas
    class Tarefa {

            private $id;
            private $id_status;
            public $tarefa;
    
            //com essa função poderemos retornar os dados
            public function __get($atributo){
                return $this->$atributo;
            }

            //com essa função poderemos alterar os dados
            public function __set($atributo,$valor){
                $this->$atributo = $valor;
            }
    }

?>