<?php 

namespace Extr\Core;

use Extr\Controllers\ErrorsController,
    Extr\Helpers\CsrfHelper;

/**
 * App Core Class
 * Create URL e loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core 
{
    private const NAMESPACE_CONTROLLERS = '\\Extr\\Controllers\\';
    protected $currentController = self::NAMESPACE_CONTROLLERS . 'PagesController';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        $this->setController($url);
        $this->setMethod($url);
        $this->setParams($url);

        $this->execute();
    }

    private function setController(array &$url)
    {
        $controllerClassName = empty($url) ? 
            $this->currentController
            : self::NAMESPACE_CONTROLLERS . ucwords($url[0]) . 'Controller' ;

        if (class_exists($controllerClassName)) {
            // If exists, set as controller
            $this->currentController = $controllerClassName;
            // Unset 0 Index
            unset($url[0]);
        } else {
            (new ErrorsController())->pageNotFound();
            exit();
        }

        // Instance controller class
        $this->currentController = new $this->currentController();
    }

    private function setMethod(array &$url)
    {
        // Check for second part of url
        if (isset($url[1])) {
            // Check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // Unsert 1 index
                unset($url[1]);
            } else {
                (new ErrorsController())->pageNotFound();
                exit();
            }
        }
    }

    private function setParams(array &$url)
    {
        //Get params
        $this->params = $url ? array_values($url) : [];
    }

    /**
     * Run Application
     */
    private function execute()
    {
        try {
            $this->verifyParams();
            $this->verifyRequest();
            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        } catch (\Exception $e) {
            (new ErrorsController())->argumentCountError();
            exit();
        }
    }

    /**
     * Checks the number of method parameters
     */
    private function verifyParams()
    {
        if ( !is_callable([$this->currentController, $this->currentMethod]) ) {
            throw new \Exception("Nonexistent method");
        }

        $refl = new \ReflectionMethod($this->currentController, $this->currentMethod);
        $totalParams = count($this->params);
        $isNotCorrectNumberOfParams = 
            $totalParams != $refl->getNumberOfParameters() && 
            $totalParams != $refl->getNumberOfRequiredParameters();

        if ( $isNotCorrectNumberOfParams ) {
            throw new \Exception("Invalid number of parameters.");
        }
    }

    private function verifyRequest()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $isValidRequest = CsrfHelper::validate($_POST);
                break;
            default:
                $isValidRequest = true;
                break;
        }

        if (!$isValidRequest) {
            throw new \Exception("Invalid CSRF Token.");
        }
    }

    public function getUrl()
    {
        $url = explode('index.php', $_SERVER['PHP_SELF']);
        $url = end($url);

        if (isset($url)) {
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            array_shift($url);
            return $url;
        }
    }
}