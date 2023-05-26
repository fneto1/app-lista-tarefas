<?php

    class TarefaService {

        private $conexao;
        private  $tarefa;

        public function __construct(Conexao $conexao, Tarefa $tarefa){
            $this->conexao = $conexao->conectar();
            $this->tarefa = $tarefa;
        }

        //create
        public function inserir(){
            $query = 'INSERT INTO tb_tarefas(tarefa) VALUES (:tarefa)';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $stmt->execute();
        }

        //read
        public function recuperar(){
            $query =
                'SELECT 
                        t.id, ts.status, t.tarefa 
                FROM
                        tb_tarefas AS t
                LEFT JOIN tb_status ts on ts.id = t.id_status';
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        }

        //update
        public function atualizar(){
            $query =
                'UPDATE 
                    tb_tarefas
                SET
                    tarefa = :tarefa
                WHERE
                    id = :id
                ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            return $stmt->execute();
        }

        //delete
        public function remover(){
            $query = 'DELETE FROM tb_tarefas WHERE id = :id';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            $stmt->execute();
            
        }

        public function marcarRealizada(){
            $query =
                'UPDATE 
                    tb_tarefas
                SET
                    id_status = :id_status
                WHERE
                    id = :id
                ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            return $stmt->execute();
        }
    }

