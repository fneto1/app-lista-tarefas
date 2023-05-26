<?php

    require "tarefa.model.php";
    require "tarefa.service.php";
    require "conexao.php";

/*    echo '<pre>';
    print_r($_POST);
    echo '</pre>';*/

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if($acao == 'inserir') {

        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();

        header('location: nova_tarefa.php?inclusao=1');

    } else if ($acao == 'recuperar'){

        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();

    } else if ($acao == 'atualizar'){

        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);
        $tarefa->__set('id', $_POST['id']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        if($tarefaService->atualizar()){

            if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
                header('location: index.php');
            } else {
                header('location: todas_tarefas.php');
            }
        }

    } else if($acao == 'remover') {
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();

        if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
            header('location: index.php');
        }else {
            header('location: todas_tarefas.php');
        }

    } else if($acao == 'marcarRealizada') {

        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);
        $tarefa->__set('id_status', 2);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->marcarRealizada();

        if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
            header('location: index.php');
        } else {
            header('location: todas_tarefas.php');
        }


    }

