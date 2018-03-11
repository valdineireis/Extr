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
        $this->loadView('users/index');
    }
}