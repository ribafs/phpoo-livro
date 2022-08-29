<?php
// https://elias.praciano.com/2014/08/php-mvc-e-hello-world/
class Model {
	public $text;
	
	public function __construct() {
		$this->text = 'Olá Mundo do MVC com PHP!';
	}		
}

class View {
	private $model;
	private $controller;
	
	public function __construct(Controller $controller, Model $model) {
		$this->controller = $controller;
		$this->model = $model;
	}
	
	public function output() {
		return '<a href="mvc.php?action=textclicked">' . $this->model->text . '</a>';
	}
	
}

class Controller {
	private $model;

	public function __construct(Model $model) {
		$this->model = $model;
	}

	public function textClicked() {
		$this->model->text = 'Texto Atualizado';
	}
}


$model = new Model();
//It is important that the controller and the view share the model
$controller = new Controller($model);
$view = new View($controller, $model);
if (isset($_GET['action'])) $controller->{$_GET['action']}();
echo $view->output();
?>
