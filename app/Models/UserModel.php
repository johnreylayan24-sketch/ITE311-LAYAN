<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';   // name ng table
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email', 'password', 'role'];

    protected $useTimestamps = true; // para automatic sa created_at, updated_at
}
