<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SinglePageApplicationController extends Controller
{
    public function vue() {
        return view('app');
    }
}
