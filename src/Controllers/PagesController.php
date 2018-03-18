<?php

namespace Extr\Controllers;

use Extr\Core\Controller;

class PagesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->setData([
            'name' => 'Valdinei Reis'
        ]);
        $this->loadView('pages/index');
    }

    public function csrftest()
    {
        echo 'Success! ' . $this->requestPost('name');
    }

    public function about()
    {
        echo 'About';
    }
}