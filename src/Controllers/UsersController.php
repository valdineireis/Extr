<?php

namespace Extr\Controllers;

use Extr\Core\Controller,
    Extr\Models\User as UserModel;

class UsersController extends Controller
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel;
    } 

    public function index()
    {
        $this->setData([
            'users' => $this->userModel->getAll()
        ]);
        
        #region Exemplos de mensagems
        $this->msg->info('This is an info message');
        $this->msg->success('This is a success message');
        $this->msg->warning('This is a warning message');
        $this->msg->error('This is an error message');
        //$this->msg->error('This is an error message', BASE . 'pages/');
        #endregion

        $this->loadView('users/index');
    }
}