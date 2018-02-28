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
        $this->loadView('pages/index', array('name' => 'Valdinei Reis'));
    }

    public function about()
    {
        echo 'About';
    }
}