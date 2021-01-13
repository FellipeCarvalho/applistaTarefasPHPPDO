<?php


    /*Nessa classe vamos realizar a comunicação CRUD dos dados com o banco, através dos dados vindos da classe tarefa */

    class TarefaCrud{

        private $conexao;
        private $tarefa;



        //criei esse metodo para contruir um objeto a partir do objeto conexão e tarefa e ja fazer a conexao dos dados
        public function __construct($conexao, $tarefa) {
            //aqui ele pega  o retorno do  objeto que esta no objeto conexao estanciado na pagina tarefas.controller
            $this->conexao = $conexao->conectarBanco();
            //aqui ele pega o retorno do objeto tarefaObjeto que foi estanciado na página de tarefas.controller
            $this->tarefa  = $tarefa;
        }


        /* *********************************************************** */
        /*            MÉTODO DE INSERÇAO NO BANCO DE DADOS             */
        /* *********************************************************** */

        public function criar() {
          
            //usando pdo para executar a query, dessa forma evito sql injection, pois sera executado apenas com o parametro
            //crio a variavel que recebe a instrução sql + parametro representado por ":"
            $query  = 'insert into tb_tarefas(tarefa)values(:tarefa)';
            //crio uma variavel para receber o metodo nativo prepare com a conexão e a intrução sql
            $statement = $this->conexao->prepare($query);
            //atribuo o parametro usando bindValue para receber o dado repassado do frontend
            $statement->bindValue(':tarefa',$this->tarefa->__get('tarefa'));
            //executo no banco de dados a query
            $statement->execute();
        }

        
        /* *********************************************************** */
        /*            FIM( MÉTODO DE INSERÇAO NO BANCO DE DADOS)       */
        /* *********************************************************** */


        /* *********************************************************** */
        /*            MÉTODO DE LEITURA NO BANCO DE DADOS              */
        /* *********************************************************** */
        public function recuperar() {

            $query ='select tt.id, tt.tarefa, ts.status from tb_tarefas tt inner join tb_status ts ON ts.id = tt.id_status';
            $statement = $this->conexao->prepare($query);
            $statement->execute();
            //retorna todos os registros, o fech_obj apenas para trazer o retorno de objeto
            return $statement->fetchAll(PDO::FETCH_OBJ);

        }
        

        /* *********************************************************** */
        /*            FIM(MÉTODO DE LEITURA NO BANCO DE DADOS)         */
        /* *********************************************************** */

        
        /* *********************************************************** */
        /*            MÉTODO DE ALTERAR TAREFA NO BANCO DE DADOS       */
        /* *********************************************************** */
        
        public function atualizar() {
            $query = 'update tb_tarefas set tarefa = :tarefa  where id = :id';
            $statement = $this->conexao->prepare($query);
            $statement->bindValue(':tarefa',$this->tarefa->__get('tarefa'));
            $statement->bindValue(':id',$this->tarefa->__get('id'));
            //faco o return para que minha resposta seja 1 se verdadeiro por padrão ou 0 se falso
            return $statement->execute();
        }
        

        /* *********************************************************** */
        /*            FIM(MÉTODO DE ALTERAR TAREFA NO BANCO DE DADOS)  */
        /* *********************************************************** */

        /* *********************************************************** */
        /*            MÉTODO DE DELETAR TAREFA NO BANCO DE DADOS       */
        /* *********************************************************** */

        public function deletar() {
            $query = 'delete from tb_tarefas where id = :id';
            $statement = $this->conexao->prepare($query);
            $statement->bindValue(':id',$this->tarefa->__get('id'));
            return $statement->execute();


        }

        /* *********************************************************** */
        /*           FIM(MÉTODO DE DELETAR TAREFA NO BANCO DE DADOS)   */
        /* *********************************************************** */


        
        /* *********************************************************** */
        /*            MÉTODO DE FINALIZAR TAREFA                       */
        /* *********************************************************** */

        public function finalizar() {
            $query = 'update tb_tarefas set id_status = 2  where id = :id';
            $statement = $this->conexao->prepare($query);
            $statement->bindValue(':id',$this->tarefa->__get('id'));
            return $statement->execute();


        }

        /* *********************************************************** */
        /*           FIM(MÉTODO DE FINALIZAR TAREFA )                  */
        /* *********************************************************** */


        /* *********************************************************** */
        /*  MÉTODO DE LEITURA NO BANCO DE DADOS TAREFAS PENDENTES       */
        /* *********************************************************** */
        public function lerTarefasPendentes() {

            $query ='select tt.id, tt.tarefa, ts.status from tb_tarefas tt inner join tb_status ts ON ts.id = tt.id_status where tt.id_status =1';
            $statement = $this->conexao->prepare($query);
            $statement->execute();
            //retorna todos os registros, o fech_obj apenas para trazer o retorno de objeto
            return $statement->fetchAll(PDO::FETCH_OBJ);

        }
        

        /* *********************************************************** */
        /*  FIM(MÉTODO DE LEITURA NO BANCO DE DADOS TAREFAS PENDENTES) */
        /* *********************************************************** */


    }

?>