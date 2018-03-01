<?php 

namespace Extr\Core;

use Twig\Loader\FilesystemLoader,
    Twig\Environment,
    Twig\TwigFunction,
    Extr\Helpers\CsrfHelper;

class Controller 
{
	private $data = [];
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);
        $this->twig->addFunction(
            new TwigFunction(
                'form_token',
                function($lock_to = null) {
                    if (is_null($lock_to)) {
                        return CsrfHelper::getHiddenInputString();
                    }
                    return CsrfHelper::getHiddenInputString($lock_to);
                },
                ['is_safe' => ['html']]
            )
        );
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