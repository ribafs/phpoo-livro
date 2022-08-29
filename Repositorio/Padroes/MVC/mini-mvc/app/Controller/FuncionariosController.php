<?php

/**
 * Classe FuncionariosController
 *
 */

namespace Mini\Controller;

use Mini\Model\Funcionario;

class FuncionariosController
{
    /**
     * Action: index
     * Este método manipula o que acontece quando acessa http://localhost/funcionarios/index
     */
    public function index()
    {
        // Instanciar novo Model (Funcionario)
        $Funcionario = new Funcionario();
        // receber todos os Funcionarios e a quantidade de Funcionarios
        $funcionarios = $Funcionario->getAllFuncionarios();
        $amount_of_funcionarios = $Funcionario->getAmountOfFuncionarios();

       // carregar a view funcionarios. com as views nós podemos mostrar os $funcionarios e a $amount_of_funcionarios facilmente
        require APP . 'view/_templates/header.php';
        require APP . 'view/funcionarios/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: add
     * Este método manipula o que acontece quando acessamos http://localhost/projeto/funcionarios/add
     * IMPORTANTE: Isto não é uma página normal, isto é um ACTION. Isto é onde está o form "adicionar um funcionario" em funcionarios/index
     * direciona o usuário após o envio do formulário. Esse método manipula todos os dados POST do formulário e, em seguida, redireciona
     * o usuário de volta para funcionarios/index através da última linha: header(...)
     * Este é um exemplo de como lidar com uma solicitação POST.
     */
    public function add()
    {
        // se tivermos dados POST para criar uma nova entrada do funcionario
        if (isset($_POST["submit_add_funcionario"])) {
            // Instanciar novo Model (Funcionario)
            $Funcionario = new Funcionario();
            // do add() em Model/Model.php
            $Funcionario->add($_POST["nome"], $_POST["cpf"], $_POST["obs"]);
        }

        // onde ir depois que o funcionario foi adicionado
        header('location: ' . URL . 'funcionarios/index');
    }

    /**
     * ACTION: delete
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/funcionarios/delete
     * IMPORTANTE: Esta não é uma página normal, é uma ACTION. Isto é onde o botãoe "excluir um funcionario" em funcionarios/index
     * direciona o usuário após o clique. Este método trata de todos os dados da requisição GET (na URL!) E depois
     * redireciona o usuário de volta para funcionarios/index através da última linha: header(...)
     * Este é um exemplo de como lidar com uma solicitação GET.
     * @param int $funcionario_id Id do funcionario para excluir
     */
    public function delete($funcionario_id)
    {
        // se temos um id de um funcionario que deve ser deletado
        if (isset($funcionario_id)) {
            // Instanciar novo Model (Funcionario)
            $Funcionario = new Funcionario();
            // fazer delete() em Model/Model.php
            $Funcionario->delete($funcionario_id);
        }

        // onde ir depois que o funcionario foi excluído
        header('location: ' . URL . 'funcionarios/index');
    }

     /**
     * ACTION: edit
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/funcionarios/edit
     * @param int $funcionario_id Id do funcionario a editar
     */
    public function edit($funcionario_id)
    {
        // se temos um id de um funcionario que deve ser editado
        if (isset($funcionario_id)) {
            // Instanciar novo Model (Funcionario)
            $Funcionario = new Funcionario();
            // fazer getFuncionario() em Model/Model.php
            $funcionario = $Funcionario->getFuncionario($funcionario_id);

            // Se o funcionario não foi encontrado, então ele teria retornado falso, e precisamos exibir a página de erro
            if ($funcionario === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {
                // carregar a view funcionarios. nas views nós podemos mostrar $funcionario facilmente
                require APP . 'view/_templates/header.php';
                require APP . 'view/funcionarios/edit.php';
                require APP . 'view/_templates/footer.php';
            }
        } else {
            // redirecionar o usuário para a página de índice do funcionario (pois não temos um funcionario_id)
            header('location: ' . URL . 'funcionarios/index');
        }
    }

    /**
     * ACTION: update
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/funcionarios/update
     * IMPORTANTE: Esta não é uma página normal, é uma ACTION. Isto é onde o form "atualizar um funcionario" fica funcionarios/edit
     * direciona o usuário após o envio do formulário. Esse método manipula todos os dados POST do formulário e, em seguida, redireciona
     * o usuário de volta para funcionarios/index através da última linha: header(...)
     * Este é um exemplo de como lidar com uma solicitação POST.
     */
    public function update()
    {
        // se tivermos dados POST para criar uma nova entrada do funcionario
        if (isset($_POST["submit_update_funcionario"])) {
            // Instanciar novo Model (Funcionario)
            $Funcionario = new Funcionario();
            // fazer update() do Model/Model.php
            $Funcionario->update($_POST["nome"], $_POST["cpf"], $_POST["obs"], $_POST['funcionario_id']);
        }

        // onde ir depois que o funcionario foi adicionado
        header('location: ' . URL . 'funcionarios/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentação
     */
    public function ajaxGetStats()
    {
        // Instance new Model (Funcionario)
        $Funcionario = new Funcionario();
        $amount_of_funcionarios = $Funcionario->getAmountOfFuncionarios();

        // simplesmente ecoar alguma coisa. Uma API supersimple seria possível fazendo eco ao JSON aqui
        echo $amount_of_funcionarios;
    }

}
