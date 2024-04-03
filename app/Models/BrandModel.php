<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'description',
        'category_id',
        'created_at',
        'updated_at'
    ];
}