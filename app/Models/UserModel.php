<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name_surname',
        'email',
        'password',
        'type',
        'auths',
        'created_at',
        'updated_at',
    ];

}