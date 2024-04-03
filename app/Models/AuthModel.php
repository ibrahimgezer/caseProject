<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'auths';
    protected $allowedFields = [
        'user_id',
        'modules',
        'authorizing_user	'
    ];
}