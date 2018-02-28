<?php 

namespace Extr\Core;

use Twig\Loader\FilesystemLoader,
    Twig\Environment;

class Controller 
{
	protected $data = [];
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);
    }

    public function loadView($viewName, $viewData = array()) 
    {
        echo $this->twig->render($viewName . '.html.twig', $viewData);
    }
}