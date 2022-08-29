<?php

namespace App\Model;

Class ProdutoDao{
    public function create(Produto $p){
        $sql = 'INSERT INTO produtos (nome, descricao) VALUES (?, ?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $p->getNome());
        $stmt->bindValue(2, $p->getDescricao());
        $stmt->execute();
    }

    public function read(){
        $sql = 'SELECT * FROM produtos';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);// Retorna um array com todos os registros da tabela
            return $resultado;
        }
    }

    public function update(Produto $p){
        $sql = 'UPDATE produtos SET nome=?, descricao=? WHERE id=?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $p->getNome());
        $stmt->bindValue(2, $p->getdescricao());        
        $stmt->bindValue(3, $p->getId());                
        $stmt->execute();
    }

    public function delete($id){
        $sql = 'DELETE FROM produtos WHERE id=?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

}
