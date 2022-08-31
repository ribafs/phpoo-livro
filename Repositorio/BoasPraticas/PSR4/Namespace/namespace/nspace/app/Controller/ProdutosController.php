<?php

require 'app/Model/ProdutosModel.php';
require 'app/View/ProdutosView.php';

class ProdutosController
{
    public function index(){
        $model = new ProdutosModel();
        $view = new ProdutosView();

        print $model->index();
        print $view->index();

        return 'index de produtos em controller<br>';
    }
}
