<?php
// Esta versão partiu de uma cópia do original application.php do mini3
namespace Core;

//error_reporting(E_ALL ^ E_DEPRECATED);

class Router
{
  	// Propriedades relativas a url
  	private $urlController = null;
  	private $urlAction = null;
  	private $urlParams = array();
    
	public function __construct(){
		$this->splitUrl();		

	// Caso a url não venha com controller, instancie o controller default com o action index()
    if (!isset($this->urlController)) {
		$default = 'App\\Controllers\\'.ucfirst(DEFAULT_CONTROLLER).'Controller';
        $page = new $default;
        $page->index();
        
    // Caso exista controller na url verifica se o respectivo arquivo existe na pasta App, então crie uma instância do mesmo
    } elseif (file_exists(APP . 'Controllers/' . ucfirst($this->urlController) . 'Controller.php')) {
        $controller = "App\\Controllers\\" . ucfirst($this->urlController) . 'Controller';
        $this->urlController = new $controller();

        $this->urlAction = $this->urlAction ?? 'index';
        // Caso o método/action da url exista e seja chamável
        if (method_exists($this->urlController, $this->urlAction) && is_callable(array($this->urlController, $this->urlAction))) {                

       		// Verifique se o parâmetro é vazio
            if (!empty($this->urlParams)) {

          		// Se não for vazio chame o controller, o action e os paprâmetros
                //call_user_func_array(array($this->urlController, $this->urlAction), $this->urlParams);
                $this->urlController->{$this->urlAction}(...$this->urlParams);

            // Caso os parâmetros sejam vazios, instancie o controller apenas com o action
            } else {
                $this->urlController->{$this->urlAction}();
            }                
        } else {
       		// Caso o action não exista, chame o controller com o action index()
            if (!isset($this->urlAction)) { 
                $this->urlController->index();
                
            // Caso o action não exista na url, dispare o ErrorController com o parâmetro 1 - action
            } else {
                $error = new \Core\ErrorController();
                $error->index();
            }
        }
        
	// Caso exista o controller na url mas não seja válido, dispare o ErrorController com o parâmetro 2 - controller
    } else {
        $error = new \Core\ErrorController();
        $error->index();
    }
  }		
		
  private function splitUrl()
  {
   	  // Verificar se a url foi setada
      if (isset($_GET['url'])) {
          // dividir a URL em partes
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
