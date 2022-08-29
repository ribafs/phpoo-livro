<?php

/**
 * Class Produtos
 */

namespace Mini\Model;

use Mini\Core\Model;

class Produto extends Model
{
    /**
     * Get all Produtos from database
     */
    public function getAllProdutos()
    {
        $sql = "SELECT id, descricao, unidade FROM produtos";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() é o método PDO que recebe todos os registros retornados, aqui em object-style porque definimos isso em
        // core/controller.php! Se preferir obter um array associativo como resultado, use
        // $query->fetchAll(PDO::FETCH_ASSOC); ou mude as opções em core/controller.php's PDO para
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Adicionar um Produto para o banco
     * @param string $descricao Descrição
     * @param string $unidade Unidade
     */
    public function add($descricao, $unidade)
    {
        $sql = "INSERT INTO produtos (descricao, unidade) VALUES (:descricao, :unidade)";
        $query = $this->db->prepare($sql);
        $parameters = array(':descricao' => $descricao, ':unidade' => $unidade);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Excluir um Produto do banco de dados
     * Por favor note: este é apenas um exemplo! Em uma aplicação real, você não deixaria simplesmente ninguém excluir
     * add/update/delete equipe!
     * @param int $produto_id Id do Produto
     */
    public function delete($produto_id)
    {
        $sql = "DELETE FROM produtos WHERE id = :produto_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':produto_id' => $produto_id);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Receber um Produto do banco
     * @param integer $produto_id
     */
    public function getProduto($produto_id)
    {
        $sql = "SELECT id, descricao, unidade FROM produtos WHERE id = :produto_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':produto_id' => $produto_id);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() é o método do PDO que recebe exatamente um registro
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Atualizar um Produto no banco
     * @param string $descricao Descrição
     * @param string $unidade Unidade
     * @param int $produto_id Id
     */
    public function update($descricao, $unidade, $produto_id)
    {
        $sql = "UPDATE produtos SET descricao = :descricao, unidade = :unidade WHERE id = :produto_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':descricao' => $descricao, ':unidade' => $unidade, ':produto_id' => $produto_id);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Obtenha "estatísticas" simples. Esta é apenas uma demonstração simples para mostrar
     * como usar mais de um modelo em um controlador
     * (veja application/controller/produtos.php para detalhes)
     */
    public function getAmountOfProdutos()
    {
        $sql = "SELECT COUNT(id) AS amount_of_produtos FROM produtos";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() é o método do PDO que recebe exatamente um registro
        return $query->fetch()->amount_of_produtos;
    }
}
