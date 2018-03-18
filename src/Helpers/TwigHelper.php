<?php 

namespace Extr\Helpers;

use Twig\Loader\FilesystemLoader,
    Twig\Environment,
    Twig\TwigFunction;

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

    public function getStartedObject()
    {
        return $this->twig;
    }
    
    private function initTwig()
    {
        global $config;

        $loader = new FilesystemLoader(__DIR__ . '/../Views');

        $options = [];

        if ($config['useTwigCache']) {
            $options['cache'] = __DIR__ . '/../../twigCache';
        }

        $this->twig = new Environment($loader, $options);

        $this->addCsrfFunction();
        $this->addFlashMessagesFunction();
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

    private function addFlashMessagesFunction()
    {
        $this->twig->addFunction(
            new TwigFunction(
                'flash_messages',
                function() {
                    return (FlashMessageHelper::getInstance()->getStartedObject())->display();
                },
                ['is_safe' => ['html']]
            )
        );
    }
}