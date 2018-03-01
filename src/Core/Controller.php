<?php 

namespace Extr\Core;

use Twig\Loader\FilesystemLoader,
    Twig\Environment,
    Extr\Helpers\CsrfHelper;

class Controller 
{
	private $data = [];
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);

        $this->setData(['csrf_token' => CsrfHelper::getHiddenInputString()]);
    }

    protected function setData(array $data)
    {
        $this->data = array_merge($this->data, $data);
    }

    protected function getData() : array
    {
        return $this->data;
    }

    public function loadView($viewName, $viewData = array()) 
    {
        echo $this->twig->render($viewName . '.html.twig', $viewData);
    }
}