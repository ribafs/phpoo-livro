<?php
declare(strict_types = 1);

namespace Core;

use Core\Model;

class Controller
{
    public $table = null;
    private $model = '';

    public function __construct($table='clientes'){
      $this->table = $table;
      $this->model = '\\App\\Models\\'.ucfirst($this->table) . 'Model';
    }

    public function index()
    {
        $Obj = new Model($this->table);
        $todos = $Obj->todosRegs(); // Todos os clientes e seus dados
        $soma = $Obj->somaRegs();// Total de clientes, a soma

        // Carregar a view. Com as views nós podemoms mostrar $todos e a soma facilmente
        require_once APP . 'views/templates/header.php';
        require_once APP . 'views/templates/menu.php';                
        require_once APP . 'views/'.$this->table.'/index.php';
        require_once APP . 'views/templates/footer.php';
    }

    public function add()
    {
        $Obj = new Model($this->table);
        $fld = $Obj->fields();
        $fld0 = $fld[0];
        $fld1 = $fld[1];
        $tab = substr($this->table,0,-1);// Remover s final do nome da tabela
        if (isset($_POST['submit_add_'.$tab])) {
          $Obj = new $this->model($this->table);
          $Obj->add($_POST[$fld0], $_POST[$fld1]);
	        header('location: ' . URL . $this->table.'/index');	
        }

        // Carregar views.
        require_once APP . 'views/templates/header.php';
        require_once APP . 'views/templates/menu.php';                                
        require_once APP . 'views/'.$this->table.'/add.php';
        require_once APP . 'views/templates/footer.php';
    }

    public function edit($field_id)
    {
        if (isset($field_id)) {
            $Obj = new $this->model($this->table);//ClientesModel($this->table);
            $Obj2 = new Model($this->table);
            $todos = $Obj2->todosRegs();

            $um = $Obj->umReg($field_id);

            if ($um === false) {
                $page = new \Core\ErrorController();
                $page->index();
            } else {
                require_once APP . 'views/templates/header.php';
				        require_once APP . 'views/templates/menu.php';                        
                require_once APP . 'views/'.$this->table.'/edit.php';
                require_once APP . 'views/templates/footer.php';
            }
        } else {
            header('location: ' . URL . $this->table.'/index');
        }
    }

    public function update()
    {
        
        if($this->table == 'vendedores'){
          $tab = substr($this->table,0,-2);// Remover es final do nome da tabela
        }else{
          $tab = substr($this->table,0,-1);// Remover es final do nome da tabela
        }
        if (isset($_POST['submit_update_'.$tab])) {
          $Obj = new Model($this->table);
          $fld = $Obj->fields();
          $fld0 = $fld[0];
          $fld1 = $fld[1];

            $Obj = new $this->model($this->table);
            $Obj->update($_POST[$fld0], $_POST[$fld1], $_POST['field_id']);
        }

        header('location: ' . URL . $this->table.'/index');
    }

    public function delete($field_id)
    {
        if (isset($field_id)) {
            $Obj = new Model($this->table);
            $Obj->delete($field_id);
        }

        header('location: ' . URL . $this->table.'/index');
    }
}
