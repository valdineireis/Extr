<?php

namespace Extr\Controllers;

use Extr\Core\Controller;

class PagesController extends Controller
{
    public function __construct()
    {} 

    public function index()
    {
        echo 'Index';
        /*
        if (isLoggedIn()) {
            redirect('posts');
        }

        $data = [
            'title' => 'Title',
            'description' => 'Description'
        ];       

        $this->loadTemplate("Usuarios/listagem", $this->data;
        */
    }

    public function about()
    {
        echo 'About';
    }
}