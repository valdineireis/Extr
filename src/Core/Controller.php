<?php 

namespace Extr\Core;

use Extr\Helpers\CsrfHelper,
    Extr\Helpers\TwigHelper;

abstract class Controller 
{
	private $data = [];
    protected $twig;

    public function __construct()
    {
        $this->initTwig();
    }

    private function initTwig()
    {
        $this->twig = TwigHelper::getInstance()->getTwig();
    }

    protected function setData(array $data)
    {
        $this->data = array_merge($this->data, $data);
    }

    protected function getData() : array
    {
        return $this->data;
    }

    public function loadView($viewName) 
    {
        echo $this->twig->render($viewName . '.html.twig', $this->getData());
    }
}