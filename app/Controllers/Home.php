<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('template');   // Loads template.php inside app/Views/
    }

    public function about()
    {
        return view('about');   // Loads about.php inside app/Views/
    }

    public function contact()
    {
        return view('contact'); // Loads contact.php inside app/Views/
    }
}
