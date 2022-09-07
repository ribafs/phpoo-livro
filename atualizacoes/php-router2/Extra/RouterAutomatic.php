<?php
namespace Core;
//error_reporting(E_ALL ^ E_DEPRECATED);

class Router
{
    // Propriedades relativas a url
    private $urlController = null;
    private $urlAction = null;
    private $urlParams = array();
    
    // Veja que todo o código está dentro do construtor, o que acarreta que no momento de se criar uma instância desta classe todo o seu código já está em ação
    public function __construct(){
        
        // Verificar se a url foi setada
        if (isset($_GET['url'])) {
            // dividir a URL em partes
            $url = trim($_GET['url'], '/'); // A origem deste url é o public/.htaccess
            $url = filter_var($url, FILTER_SANITIZE_URL); // Filtrar a url de caracteres estranhos a uma url
            $url = explode('/', $url); // Criar um array com as partes da url: controller/action/params
            
            $this->urlController = isset($url[0]) ? $url[0] : null; // Criando a $this->urlController com $url[0]
            $this->urlAction = isset($url[1]) ? $url[1] : null; // Criando a $this->urlAction com $url[1]
            
            unset($url[0], $url[1]);// Limpar $url[0] e $url[1]
            $this->urlParams = array_values($url); // Criando a $this->urlParams com array_values($url)
            
        }
        
        // Caso a url não venha com controller, instancie o controller default com o action index()
        if (!isset($this->urlController)) {
            $default = 'App\\Controllers\\' . ucfirst(DEFAULT_CONTROLLER) . 'Controller';
            $ctrl = new $default;
            $ctrl->index();
            
            // Caso exista controller na url verifica se o respectivo arquivo existe na pasta App, então crie uma instância do mesmo
        } elseif (file_exists(APP . 'Controllers/' . ucfirst($this->urlController) . 'Controller.php')) {
            $controller = "App\\Controllers\\" . ucfirst($this->urlController) . 'Controller';
            $this->urlController = new $controller();
            
            // Caso o action seja nulo então que assuma o default, index
            if(!isset($this->urlAction)) $this->urlAction = 'index';
            
            // Caso o action da url exista e seja chamável. is_callable — Verify that a value can be called as a function from the current scope. 
            if (method_exists($this->urlController, $this->urlAction) && is_callable(array($this->urlController, $this->urlAction))) {
                
                // Verifique se o parâmetro é vazio
                if (!empty($this->urlParams)) {
                    
                    // Se não for vazio chame o controller, o action e os parâmetros
                    // call_user_func_array(array($this->urlController, $this->urlAction), $this->urlParams);
                    $this->urlController->{$this->urlAction}(...$this->urlParams);
                    
                    // Caso os parâmetros sejam vazios, instancie o controller apenas com o action
                } else {
                    $this->urlController->{$this->urlAction}();
                }                
            } else {
                // Caso o action não exista, chame o controller com o action default, que é o index()
                if (!isset($this->urlAction)) { 
                    $this->urlController->index();
                    
                    // Caso o action seja indicado na URL mas não exista, dispare o ErrorController
                } else {
                    $error = new \Core\ErrorController();
                    $error->index();
                }
            }
            
            // Caso seja indicado um controller na url mas ele não seja válido, dispare o ErrorController
        } else {
            $error = new \Core\ErrorController();
            $error->index();
        }
    }		   
}
