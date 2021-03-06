<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __construct()
    {

    }

    public function index() {
        return view('welcome');
    }
}
