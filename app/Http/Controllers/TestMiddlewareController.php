<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestMiddlewareController extends Controller
{
    public function __construct()
    {
    }


    public function index()
    {
        echo "<br>test-middleware-controller called index method";
    }
}
