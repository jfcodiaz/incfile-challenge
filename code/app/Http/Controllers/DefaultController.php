<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function random()
    {
        $status = rand(0, 2000) % 2 ? 200 : 404;
        return response($status, $status);
    }
}
