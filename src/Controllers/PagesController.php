<?php

namespace Extr\Controllers;

use Extr\Core\Controller,
    Extr\Helpers\CsrfHelper;

class PagesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    } 

    public function index()
    {
        $this->setData(['name' => 'Valdinei Reis']);
        $this->loadView('pages/index', $this->getData());
    }

    public function csrftest()
    {
        if (CsrfHelper::validate($_POST)) {
            echo 'Validate request. Success!';
        } else {
            echo 'Invalid request!';
        }
    }

    public function about()
    {
        echo 'About';
    }
}