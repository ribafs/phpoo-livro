<?php

/**
 * Class Error
 *
 */

namespace Mini\Controller;

class ErrorController
{
    /**
     * PAGE: index
     * Este método manipula a página de erro que será mostrada quando uma página não for encontrada
     */
    public function index()
    {
        // Carregar a view error
        require APP . 'view/_templates/header.php';
        require APP . 'view/error/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
