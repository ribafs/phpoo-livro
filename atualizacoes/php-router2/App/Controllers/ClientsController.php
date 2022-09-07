<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Models\ClientsModel;

class ClientsController
{
    public function index()
    {
        $Client = new ClientsModel('clients');
        $allRegs = $Client->allRegs();

        // Carregar a view. Com as views nós podemoms mostrar $todos e a soma facilmente
        require_once APP . 'views/templates/header.php';
        require_once APP . 'views/templates/menu.php';                
        require_once APP . 'views/clients/index.php';
        require_once APP . 'views/templates/footer.php';
    }

    public function add()
    {
        $Client = new ClientsModel('clients');
        if (isset($_POST['submit_add_client'])) {
            $Client->add($_POST['name'], $_POST['email']);
	        header('location: ' . URL . 'clients/index');	
        }

        // Carregar views.
        require_once APP . 'views/templates/header.php';
        require_once APP . 'views/templates/menu.php';                                
        require_once APP . 'views/clients/add.php';
        require_once APP . 'views/templates/footer.php';
    }

    public function edit($field_id)
    {
        if (isset($field_id)) {
            $Client = new ClientsModel('clients');
            $allRegs = $Client->allRegs();

            $oneReg = $Client->oneReg($field_id);

            if ($oneReg === false) {
                $error = new \Core\ErrorController();
                $error->index();
            } else {
                require_once APP . 'views/templates/header.php';
			    require_once APP . 'views/templates/menu.php';                        
                require_once APP . 'views/clients/edit.php';
                require_once APP . 'views/templates/footer.php';
            }
        } else {
            header('location: ' . URL . 'clients/index');
        }
    }

    public function update()
    {
        if (isset($_POST['submit_update_client'])) {
          $Client = new ClientsModel('clients');
          $Client->update($_POST['name'], $_POST['email'], $_POST['field_id']);
        }

        header('location: ' . URL . 'clients/index');
    }

    public function delete($field_id)
    {
        if (isset($field_id)) {
            $Client = new ClientsModel('clients');
            $Client->delete($field_id);
        }

        header('location: ' . URL . 'clients/index');
    }
}
