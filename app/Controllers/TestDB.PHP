<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class TestDB extends Controller
{
    public function index()
    {
        try {
            // Connect to the default database group
            $db = Database::connect();

            // Check connection by listing tables
            $tables = $db->listTables();

            echo "<h3>Database connected successfully!</h3>";
            echo "<strong>Tables in lms_layan:</strong><br>";
            echo "<pre>";
            print_r($tables);
            echo "</pre>";
        } catch (\Exception $e) {
            echo "<h3>Database connection failed!</h3>";
            echo "Error: " . $e->getMessage();
        }
    }
}
