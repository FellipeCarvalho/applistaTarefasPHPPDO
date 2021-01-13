<?php

    //como esta no contexto do diretorio publico eu faço o require como se estivesse em outro diretorio
    require("../../app_lista_tarefas_interno/conexao.php");
    require("../../app_lista_tarefas_interno/tarefas.services.php");
    require("../../app_lista_tarefas_interno/tarefas.model.php");



    //criei uma variavel $acao, que pega os dados do GET se não for vazio, senao ele mantenhe o valor da propria variavel.
    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao ;



    /* *********************************************************** */
    /*                    INSERIR DADOS NO BANCO                   */
    /* *********************************************************** */
    if($acao =="inserir") {
        //estancio o objeto da classe tarefas.model e seto o valor do metodo set com a tarefa que veio do post do backend
        $tarefaObjeto = new Tarefa();
        $tarefaObjeto->__set('tarefa', $_POST['tarefa']);

        //print_r($tarefaObjeto->__get('tarefa'));

        //estancio o objeto da classe conexao
        $conexaoObjeto = new Conexao();

        //estancio o objeto da classe tarefas.service, 
        $tarefaServiceObjeto= new TarefaCrud($conexaoObjeto, $tarefaObjeto);

        //executo a inserção no banco de dados
        $tarefaServiceObjeto->criar();

        header('Location: nova_tarefa.php?incluir=1');


    /* *********************************************************** */
    /*                   FIM (INSERIR DADOS NO BANCO)              */
    /* *********************************************************** */

    /* *********************************************************** */
    /*                    LER DADOS NO BANCO                   */
    /* *********************************************************** */
    } else if($acao =="recuperar"){

        $tarefaObjeto = new tarefa();
        $conexaoObjeto = new Conexao();

        $tarefaServiceObjeto = new TarefaCrud($conexaoObjeto,$tarefaObjeto);
        //crio uma variavel que vai conter um array com os dados do banco
        $arrayTarefasCadastradas = $tarefaServiceObjeto->recuperar(); 
  

    /* *********************************************************** */
    /*                   FIM (LER DADOS NO BANCO)                  */
    /* *********************************************************** */

    /* *********************************************************** */
    /*                  EDITAR DADOS NO BANCO                      */
    /* *********************************************************** */
    } else if($acao =="atualizar"){

        $tarefaObjeto = new tarefa();
        $conexaoObjeto = new Conexao();

        $tarefaObjeto->__set('tarefa', $_POST['tarefaAtualizada']);
        $tarefaObjeto->__set('id', $_POST['idTarefa']);

        $tarefaServiceObjeto = new TarefaCrud($conexaoObjeto,$tarefaObjeto);
        //se a atualização foi um sucesso o retorno é verdadeiro então volta para pagina de navegaçao

        if ($tarefaServiceObjeto->atualizar()){

            //verifica qual página deve ser retornada
            if (isset($_GET['pag']) && $_GET['pag']== "index"){
                Header('Location: index.php');
            }else{ Header('Location: todas_tarefas.php');
            }
        }



   

    /* *********************************************************** */
    /*                  FIM(EDITAR DADOS NO BANCO)                  */
    /* *********************************************************** */


    /* *********************************************************** */
    /*                  EDITAR DADOS NO BANCO                      */
    /* *********************************************************** */
    } else if($acao =="deletar"){

        $tarefaObjeto   = new Tarefa();
        $conexaoObjeto  = new Conexao();

        $tarefaObjeto->__set('id', $_GET['id']);

        $tarefaSeviceObjeto = new TarefaCrud($conexaoObjeto, $tarefaObjeto);

        if ($tarefaSeviceObjeto->deletar()){
            
             //verifica qual página deve ser retornada
            if (isset($_GET['pag']) && $_GET['pag']== "index"){
                Header('Location: index.php');
            }else{ Header('Location: todas_tarefas.php');
            }

        }

    

    /* *********************************************************** */
    /*                  FIM(EDITAR DADOS NO BANCO)                  */
    /* *********************************************************** */

    /* *********************************************************** */
    /*                 MARCAR TAREFA COMO FINALIZADA                 */
    /* *********************************************************** */
    } else if($acao =="finalizar"){

        $tarefaObjeto   = new Tarefa();
        $conexaoObjeto  = new Conexao();

        $tarefaObjeto->__set('id', $_GET['id']);

        $tarefaSeviceObjeto = new TarefaCrud($conexaoObjeto, $tarefaObjeto);

        if ($tarefaSeviceObjeto->finalizar()){
            //verifica qual página deve ser retornada
            if (isset($_GET['pag']) && $_GET['pag']== "index"){
                Header('Location: index.php');
            }else{ Header('Location: todas_tarefas.php');
                
            }
        }



    /* *********************************************************** */
    /*                  FIM( MARCAR TAREFA COMO FINALIZADA )       */
    /* *********************************************************** */


    /* *********************************************************** */
    /*         LER DADOS NO BANCO  APENAS TAREFAS PENDENTES        */
    /* *********************************************************** */
    } else if($acao =="recuperarPendentes"){
       
        $tarefaObjeto = new tarefa();
        $conexaoObjeto = new Conexao();

        $tarefaServiceObjeto = new TarefaCrud($conexaoObjeto,$tarefaObjeto);
        //crio uma variavel que vai conter um array com os dados do banco
        $arrayTarefasCadastradas = $tarefaServiceObjeto->lerTarefasPendentes(); 
    }

    /* *********************************************************** */
    /*       FIM (LER DADOS NO BANCO APENAS TAREFAS PENDENTES)     */
    /* *********************************************************** */

?>