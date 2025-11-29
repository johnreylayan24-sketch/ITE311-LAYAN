<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Your DB table name
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'role']; // Fields you want to insert/update
    protected $useTimestamps = true; // optional
}
