<?php 

namespace Extr\Core;

use Extr\Helpers\CsrfHelper,
    Extr\Helpers\TwigHelper,
    Extr\Helpers\FlashMessageHelper;

abstract class Controller 
{
	private $data = [];
    protected $twig;
    protected $msg;

    public function __construct()
    {
        $this->twig = TwigHelper::getInstance()->getStartedObject();
        $this->msg = FlashMessageHelper::getInstance()->getStartedObject();
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