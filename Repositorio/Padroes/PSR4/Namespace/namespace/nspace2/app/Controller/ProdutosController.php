<?php

namespace Nspace\Controller;
use Nspace\Model\ProdutosModel;
use Nspace\View\ProdutosView;

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
