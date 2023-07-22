<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageController extends Controller
{
    // get manger page
    public function index()
    {
        $currentPage = 'manage';
        $isStaff = Auth::user()->isStaff;
        return view('manage', compact('currentPage', 'isStaff'));
    }
}