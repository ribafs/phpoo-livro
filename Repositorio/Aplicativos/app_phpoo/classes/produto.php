<?php

require_once 'connection.php';
$conn = new Connection();
$pdo = $conn->pdo;

/* Classe que trabalha com um crud, lidando com uma tabela por vez, que é fornecida a cada instância, desde a conexão com o banco */

class Produto extends Connection
{

	public $pdo;

	public function __construct($pdo){
		$this->pdo = $pdo;
	}

    public function insert(){
        $descricao = $_POST['descricao'];
        $unidade = $_POST['unidade'];
        $data_cadastro = $_POST['data_cadastro'];

           try{
               $stmte = $this->pdo->prepare("INSERT INTO produtos(descricao,unidade,data_cadastro) VALUES (?, ?, ?)");
               $stmte->bindParam(1, $descricao , PDO::PARAM_STR);
               $stmte->bindParam(2, $unidade , PDO::PARAM_STR);
               $stmte->bindParam(3, $data_cadastro , PDO::PARAM_STR);
               $executa = $stmte->execute();
         
               if($executa){
                   //echo 'Dados inseridos com sucesso';
                   return true;
               }else{
                   //echo 'Erro ao inserir os dados';
                   return false;
               }
           }
           catch(PDOException $e){
              echo $e->getMessage();
           }
    }

    public function delete($id){
        $sql = "DELETE FROM produtos WHERE id = :id";
        $sth = $this->pdo->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);   

        if( $sth->execute()){
            //Registro excluído com sucesso!
            return true;
        }else{
            //Erro ao exclur o registro!
            return false;
        }

    }

    public function update(){
        $id = $_POST['id'];
        $descricao = $_POST['descricao'];
        $unidade = $_POST['unidade'];
        $data_cadastro = $_POST['data_cadastro'];

        $sql = "UPDATE produtos SET descricao = :descricao, unidade = :unidade, data_cadastro = :data_cadastro WHERE id = :id";

        $sth = $this->pdo->prepare($sql);
        $sth->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
        $sth->bindParam(':descricao', $_POST['descricao'], PDO::PARAM_STR);   
        $sth->bindParam(':unidade', $_POST['unidade'], PDO::PARAM_STR);   
        $sth->bindParam(':data_cadastro', $_POST['data_cadastro'], PDO::PARAM_STR);   

       if($sth->execute()){
            //Registro alterado com sucesso!
            return true;
        }else{
            //Erro ao alterar o registro!
            return false;
        }

    }
}
