<?php

namespace App\Controllers;

class Bootstrap extends BaseController
{
    public function index()
    {
        return view('home');  // This loads the view file app/Views/home.php
    }
}
