<?php 

namespace Extr\Helpers;

use \Plasticbrain\FlashMessages\FlashMessages;

class FlashMessageHelper
{
    private static $instance = null;
    protected $msg;

    private function __construct()
    {
        $this->msg = new FlashMessages();
    }

    public static function getInstance()
	{
		if (self::$instance === null) {
			self::$instance = new FlashMessageHelper();
		}
		return self::$instance;
    }

    public function getStartedObject()
    {
        return $this->msg;
    }
}