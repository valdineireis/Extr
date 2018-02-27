<?php 

namespace Extr\Core;

class Controller 
{
	protected $data = [];

    public function loadView($viewName, $viewData = array()) 
    {
        extract($viewData);
        include __DIR__ . '/../Views/' . $viewName . '.php';
    }

    public function loadTemplate($viewName, $viewData = array()) 
    {
        include __DIR__ . '/../Views/template.php';
    }

    public function loadViewInTemplate($viewName, $viewData = array()) 
    {
        extract($viewData);
        include __DIR__ . '/../Views/' . $viewName . '.php';
    }
}