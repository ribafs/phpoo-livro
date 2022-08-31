<?php
declare(strict_types = 1);

namespace App\Controllers;

use Core\Controller;

class ClientsController extends Controller
{

    public function index()
    {
        $Obj = new Controller('clients');      
        $Obj->index();
    }

    public function add(){
      $Obj = new Controller('clients');
      $Obj->add();
    }

    public function delete($field_id){
      $Obj = new Controller('clients');
      $Obj->delete($field_id);
    }

    public function edit($field_id){
      $Obj = new Controller('clients');
      $Obj->edit($field_id);
    }

    public function update(){
      $Obj = new Controller('clients');
      $Obj->update();
    }

}
