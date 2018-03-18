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

    protected function loadView($viewName) 
    {
        echo $this->twig->render($viewName . '.html.twig', $this->getData());
    }

    #region Methods Helper

    /**
     * $name - Parameter name
     * $filter options:
     *   For GENERAL values (default) - FILTER_SANITIZE_STRING
     *   For HTML values use          - FILTER_SANITIZE_SPECIAL_CHARS
     */
    protected function requestPost($name, $filter=FILTER_SANITIZE_STRING)
    {
        return filter_input(INPUT_POST, $name, $filter);
    }

    /**
     * $name - Parameter name
     * $filter options:
     *   For GENERAL values (default) - FILTER_SANITIZE_STRING
     *   For HTML values use          - FILTER_SANITIZE_SPECIAL_CHARS
     */
    protected function requestGet($name, $filter=FILTER_SANITIZE_STRING)
    {
        return filter_input(INPUT_GET, $name, $filter);
    }

    protected function redirectTo($url)
    {
        if ($url) {
            header('Location: ' . $url);
            exit();
        }
    }

    #endregion
}