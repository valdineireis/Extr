<?php

namespace Extr\Controllers;

use Extr\Core\Controller;

class ErrorsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    } 

    public function index()
    {
        $this->loadView('404');
    }

    /**
     * Page not found
     */
    public function pageNotFound()
    {
        $this->loadView('404');
    }

    /**
     * Serve error
     */
    public function serveError()
    {
        $this->setData([
            'code' => 500,
            'title' => 'Erro no servidor',
            'message' => 'Ocorreu um erro no servidor!'
        ]);

        $this->loadView('500');
    }

    /**
     * Serve error
     */
    public function argumentCountError()
    {
        $this->setData([
            'code' => 500,
            'title' => 'Erro no servidor',
            'message' => 'Os parâmetros da URL estão incorretos!'
        ]);

        $this->loadView('500');
    }
}