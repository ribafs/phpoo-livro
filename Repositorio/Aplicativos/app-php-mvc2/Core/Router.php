<?php
// Esta versão partiu de uma cópia do original application.php do mini3
namespace Core;

error_reporting(E_ALL ^ E_DEPRECATED);

class Router
{
	// Propriedades relativas a url
  private $urlController = null;
  private $urlAction = null;
  private $urlParams = array();
    
	public function __construct(){
		$this->splitUrl();		

		// Caso o controller na url não exista, instancie o controller default com o action index()z
    if (strlen($this->urlController) == 0) {
		$default = 'App\\Controllers\\'.ucfirst(DEFAULT_CONTROLLER).'Controller';
        $page = new $default;
        $page->index();
    // Caso o controller da url exista na pasta App, então crie uma instância do mesmo
    } elseif (file_exists(APP . 'Controllers/' . ucfirst($this->urlController) . 'Controller.php')) {
        $controller = "App\\Controllers\\" . ucfirst($this->urlController) . 'Controller';
        $this->urlController = new $controller();
        // Caso o étodo da url exista e seja chamável
        if (method_exists($this->urlController, $this->urlAction) && is_callable(array($this->urlController, $this->urlAction))) {                
        		// Verifique se o parâmetro é vazio
            if (!empty($this->urlParams)) {
            		// Se não for vazio chame o controller, o action e os paprâmetros
                call_user_func_array(array($this->urlController, $this->urlAction), $this->urlParams);
                // Caso os parâmetros sejam vazios, instancie o controller apenas com o action
            } else {
                $this->urlController->{$this->urlAction}();
            }
        } else {
        		// Caso o action seja de tamanho 0, chame o controller com o action index()
            if (strlen($this->urlAction) == 0) { 
                $this->urlController->index();
                // Caso o actionna url não tenha comprimento zero e não exista, dispare o ErrorController com o parâmetro 1 - action
            } else {
                $return = $this->urlAction;
                $page = new \Core\ErrorController();
                $page->index(1, $return); // 1 - action , 2 - controller
            }
        }
		// Caso o controller na url não exista, dispare o ErrorController com o parâmetro 2 - controller
    } else {
        $return = $this->urlController;
        $page = new \Core\ErrorController();
        $page->index(2, $return);
    }
	}		
		
  private function splitUrl()
  {
  		// Verificar se a url foi setada
      if (isset($_GET['url'])) {
          // split URL
          $url = trim($_GET['url'], '/'); // A origem deste url é o public/.htaccess
          $url = filter_var($url, FILTER_SANITIZE_URL); // Filtrar a url de caracteres estranhos a uma url
          $url = explode('/', $url); // Criar um array com as aprtes da url: controller/action/params

          $this->urlController = isset($url[0]) ? $url[0] : null; // Criando a $this->urlController com $url[0]
          $this->urlAction = isset($url[1]) ? $url[1] : null; // Criando a $this->urlAction com $url[1]

          unset($url[0], $url[1]);// Limpar $url[0] e $url[1]
          $this->urlParams = array_values($url); // Criando a $this->urlParams com array_values($url)
      }
  }
}
