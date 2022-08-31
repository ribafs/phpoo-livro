<?php
declare(strict_types = 1);

namespace App\Controllers;

use Core\Controller;

class ProductsController extends Controller
{

    public function index()
    {
        $Obj = new Controller('products');      
        $Obj->index();
    }

    public function add(){
      $Obj = new Controller('products');
      $Obj->add();
    }

    public function delete($field_id){
      $Obj = new Controller('products');
      $Obj->delete($field_id);
    }

    public function edit($field_id){
      $Obj = new Controller('products');
      $Obj->edit($field_id);
    }

    public function update(){
      $Obj = new Controller('products');
      $Obj->update();
    }

}
