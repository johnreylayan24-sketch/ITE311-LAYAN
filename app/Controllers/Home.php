<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
    {
<<<<<<< HEAD
        return view('index');
=======
        helper('url'); 
>>>>>>> 9bc49831b38c627ac5b7e400f2b51d63a4e97daf
    }

    public function index(): string
    {
<<<<<<< HEAD
        return view('about');
=======
        return view('index');
>>>>>>> 9bc49831b38c627ac5b7e400f2b51d63a4e97daf
    }

    public function about(): string
    {
<<<<<<< HEAD
=======
        return view('about');
    }

    public function contact(): string
    {
>>>>>>> 9bc49831b38c627ac5b7e400f2b51d63a4e97daf
        return view('contact');
    }
}
