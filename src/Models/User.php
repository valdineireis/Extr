<?php

namespace Extr\Models;

use Extr\Core\PDO\Model;

class User extends Model 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tableName() : string
    {
        return 'users';
    }
}
