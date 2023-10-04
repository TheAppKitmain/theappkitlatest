<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Buildapp;

class BuildappController extends Controller
{
    public function index()
    {
        return view("appkit.build_app");
    }
}
