<?php

namespace App\Controllers;

class Bootstrap extends BaseController
{
    public function index()
    {
        return view('home');  // loads app/Views/home.php
    }
}
