<?php
// Versão semi manual da classe Router
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
            
            // controller, action e parameters
            $this->urlController = isset($url[0]) ? $url[0] : null; // Criando a $this->urlController com $url[0]
            $this->urlAction = isset($url[1]) ? $url[1] : null; // Criando a $this->urlAction com $url[1]            
            unset($url[0], $url[1]);// Limpar $url[0] e $url[1]
            $this->urlParams = array_values($url); // Criando a $this->urlParams com array_values($url)            
        }

		// Vejamos o controller passado pela URL
        switch ($this->urlController) {
			// Caso não seja passado o controller pela URL, então será assumido como default o controller clients, com o action index
 			case (!isset($this->urlController)) :
	            $ctrl = new \App\Controllers\ClientsController;
	            $ctrl->index();
	            
			case 'clients':                  				                    
				// Vejamos se não foi passada nenhuma action ou se index foi passara, assumir index
	            if(!isset($this->urlAction) || $this->urlAction == 'index'){
		            $ctrl = new \App\Controllers\ClientsController;
		            $ctrl->index();
		            // Se for passada a action add
				}elseif ($this->urlAction == 'add'){	
		            $ctrl = new \App\Controllers\ClientsController;
		            $ctrl->add();
		            // Se for passada a action edit, delete ou update		            
				}elseif ($this->urlAction == 'edit' || $this->urlAction == 'delete' || $this->urlAction == 'update'){	
		            $controller = new \App\Controllers\ClientsController;
		            $this->urlController = new $controller();				
					$this->urlController->{$this->urlAction}(...$this->urlParams);
					// Caso não seja passada nenhuma das acima mostrar o erro ao user
				}else{
		            $error = new \Core\ErrorController();
		            $error->index();				
				}
	            break;
	            
	        default:
	            $error = new \Core\ErrorController();
	            $error->index();				
				break;	        
 		}
	}		   
}
