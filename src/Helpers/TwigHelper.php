<?php 

namespace Extr\Helpers;

use Twig\Loader\FilesystemLoader,
    Twig\Environment,
    Twig\TwigFunction,
    Extr\Helpers\CsrfHelper;

class TwigHelper
{
    private static $instance = null;
    private $twig;

    private function __construct()
    {
        $this->initTwig();
    }

    public static function getInstance()
	{
		if (self::$instance === null) {
			self::$instance = new TwigHelper();
		}
		return self::$instance;
    }

    public function getTwig()
    {
        return $this->twig;
    }
    
    private function initTwig()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Views');

        $this->twig = new Environment($loader, array(
            'cache' => __DIR__ . '/../../cache'
        ));

        $this->addCsrfFunction();
    }

    private function addCsrfFunction()
    {
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
}