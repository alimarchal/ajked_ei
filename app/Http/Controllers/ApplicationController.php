<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    //
    public function index()
    {
        // get user object
        $user = \Auth::user();

        return view('applications.index', compact('user'));
    }
}
