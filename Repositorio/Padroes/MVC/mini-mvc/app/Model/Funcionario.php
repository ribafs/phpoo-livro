<?php

/**
 * Class Funcionarios
 */

namespace Mini\Model;

use Mini\Core\Model;

class Funcionario extends Model
{
    /**
     * Get all funcionarios from database
     */
    public function getAllFuncionarios()
    {
        $sql = "SELECT id, nome, cpf, obs FROM funcionarios";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() é o método PDO que recebe todos os registros retornados, aqui em object-style porque definimos isso em
        // core/controller.php! Se preferir obter um array associativo como resultado, use
        // $query->fetchAll(PDO::FETCH_ASSOC); ou mude as opções em core/controller.php's PDO para
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Adicionar um funcionario para o banco
     * @param string $nome Nome
     * @param string $cpf CPF
     * @param string $obs Observação
     */
    public function add($nome, $cpf, $obs)
    {
        $sql = "INSERT INTO funcionarios (nome, cpf, obs) VALUES (:nome, :cpf, :obs)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $nome, ':cpf' => $cpf, ':obs' => $obs);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Excluir um funcionario do banco de dados
     * Por favor note: este é apenas um exemplo! Em uma aplicação real, você não deixaria simplesmente ninguém excluir
     * add/update/delete equipe!
     * @param int $funcionario_id Id do Funcionario
     */
    public function delete($funcionario_id)
    {
        $sql = "DELETE FROM funcionarios WHERE id = :funcionario_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':funcionario_id' => $funcionario_id);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Receber um Funcionario do banco
     * @param integer $funcionario_id
     */
    public function getFuncionario($funcionario_id)
    {
        $sql = "SELECT id, nome, cpf, obs FROM funcionarios WHERE id = :funcionario_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array('funcionario_id' => $funcionario_id);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() é o método do PDO que recebe exatamente um registro
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Atualizar um Funcionario no banco
     * @param string $nome Nome
     * @param string $cpf CPF
     * @param string $obs Observação
     * @param int $funcionario_id Id
     */
    public function update($nome, $cpf, $obs, $funcionario_id)
    {
        $sql = "UPDATE funcionarios SET nome = :nome, cpf = :cpf, obs = :obs WHERE id = :funcionario_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $nome, 'cpf' => $cpf, 'obs' => $obs, ':funcionario_id' => $funcionario_id);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Obtenha "estatísticas" simples. Esta é apenas uma demonstração simples para mostrar
     * como usar mais de um modelo em um controlador
     * (veja application/controller/funcionarios.php para detalhes)
     */
    public function getAmountOfFuncionarios()
    {
        $sql = "SELECT COUNT(id) AS amount_of_funcionarios FROM funcionarios";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() é o método do PDO que recebe exatamente um registro
        return $query->fetch()->amount_of_funcionarios;
    }
}
