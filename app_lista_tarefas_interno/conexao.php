<?php

    /*Nessa classe vamos fazer a conexão com o banco de dados */
    class Conexao{

        private $host ='localhost';
        private $dbname = 'lista_tarefas_php';
        private $usuario = 'root';
        private $senha = '';
        
        public function conectarBanco(){

            //fazemos um teste, caso algum dado esteja errado ele exibirar uma mensagem de erro no catch
            try{
               //instanciamos a classe nativa PDO
                $conexao = New PDO(
                    //driveconexao: host=nome_host;dbname=nome_banco, 
                    "mysql:host=$this->host;dbname=$this->dbname",
                    "$this->usuario",
                    "$this->senha"
                );

                return $conexao;

            } catch (PDOException $e) {
                echo '<p>' . $e->getMessage() . '</p>';

            }
        }
        
    }

?>