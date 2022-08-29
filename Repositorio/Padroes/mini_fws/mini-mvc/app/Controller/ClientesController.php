<?php

/**
 * Classe ClientesController
 *
 */

namespace Mini\Controller;

use Mini\Model\Cliente;

class ClientesController
{
    /**
     * Action: index
     * Este método manipula o que acontece quando acessa http://localhost/projeto/clientes/index
     */
    public function index()
    {
        // Instanciar novo Model (Cliente)
        $Cliente = new Cliente();
        // receber todos os clientes e a quantidade de clientes
        $clientes = $Cliente->getAllClientes();// Esta propriedade é recebida na view: view/clientes/index.php em forma de array
        $amount_of_clientes = $Cliente->getAmountOfClientes(); // Esta propriedade também é recebida na view: view/clientes/index.php

       // Carregar a view clientes. Com as views nós podemos mostrar os $clientes e a $amount_of_clientes facilmente
        require APP . 'view/_templates/header.php';
        require APP . 'view/clientes/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: add
     * Este método manipula o que acontece quando acessamos http://localhost/projeto/clientes/add
     * IMPORTANTE: Isto não é uma página normal, isto é um ACTION. Isto é onde está o form "adicionar um cliente" em clientes/index
     * direciona o usuário após o envio do formulário. Esse método manipula todos os dados POST do formulário e, em seguida, redireciona
     * o usuário de volta para clientes/index através da última linha: header(...)
     * Este é um exemplo de como lidar com uma solicitação POST.
     */
    public function add()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_add_cliente"])) {
            // Instanciar novo Model (Cliente)
            $Cliente = new Cliente();
            // do add() em Model/Model.php
            $Cliente->add($_POST["nome"], $_POST["email"],  $_POST["data_nasc"], $_POST["cpf"]);
        }

        // onde ir depois que o cliente foi adicionado
        header('location: ' . URL . 'clientes/index');
    }

    /**
     * ACTION: delete
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/clientes/delete
     * IMPORTANTE: Esta não é uma página normal, é uma ACTION. Isto é onde o botãoe "excluir um cliente" em clientes/index
     * direciona o usuário após o clique. Este método trata de todos os dados da requisição GET (na URL!) E depois
     * redireciona o usuário de volta para clientes/index através da última linha: header(...)
     * Este é um exemplo de como lidar com uma solicitação GET.
     * @param int $cliente_id Id do cliente para excluir
     */
    public function delete($cliente_id)
    {
        // se temos um id de um cliente que deve ser deletado
        if (isset($cliente_id)) {
            // Instanciar novo Model (Cliente)
            $Cliente = new Cliente();
            // fazer delete() em Model/Model.php
            $Cliente->delete($cliente_id);
        }

        // onde ir depois que o cliente foi excluído
        header('location: ' . URL . 'clientes/index');
    }

     /**
     * ACTION: edit
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/clientes/edit
     * @param int $cliente_id Id do cliente a editar
     */
    public function edit($cliente_id)
    {
        // se temos um id de um cliente que deve ser editado
        if (isset($cliente_id)) {
            // Instanciar novo Model (Cliente)
            $Cliente = new Cliente();
            // fazer getCliente() em Model/Model.php
            $cliente = $Cliente->getCliente($cliente_id);

            // Se o cliente não foi encontrado, então ele teria retornado falso, e precisamos exibir a página de erro
            if ($cliente === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {
                // carregar a view clientes. nas views nós podemos mostrar $cliente facilmente
                require APP . 'view/_templates/header.php';
                require APP . 'view/clientes/edit.php';
                require APP . 'view/_templates/footer.php';
            }
        } else {
            // redirecionar o usuário para a página de índice do cliente (pois não temos um client_id)
            header('location: ' . URL . 'clientes/index');
        }
    }

    /**
     * ACTION: update
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/clientes/update
     * IMPORTANTE: Esta não é uma página normal, é uma ACTION. Isto é onde o form "atualizar um cliente" fica clientes/edit
     * direciona o usuário após o envio do formulário. Esse método manipula todos os dados POST do formulário e, em seguida, redireciona
     * o usuário de volta para clientes/index através da última linha: header(...)
     * Este é um exemplo de como lidar com uma solicitação POST.
     */
    public function update()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_update_cliente"])) {
            // Instanciar novo Model (Cliente)
            $Cliente = new Cliente();
            // fazer update() do Model/Model.php
            $Cliente->update($_POST["nome"], $_POST["email"],  $_POST["data_nasc"], $_POST["cpf"], $_POST['cliente_id']);
        }

        // onde ir depois que o cliente foi adicionado
        header('location: ' . URL . 'clientes/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentação
     */
    public function ajaxGetStats()
    {
        // Instance new Model (Cliente)
        $Cliente = new Cliente();
        $amount_of_clientes = $Cliente->getAmountOfClientes();

        // simplesmente ecoar alguma coisa. Uma API supersimple seria possível fazendo eco ao JSON aqui
        echo $amount_of_clientes;
    }

}
