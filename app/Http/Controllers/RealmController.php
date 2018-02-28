<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RealmController extends Controller
{
    public function index()
    {
        return view('pages.realm');
    }
}
