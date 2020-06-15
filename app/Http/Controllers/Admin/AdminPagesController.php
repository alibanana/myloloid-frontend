<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin/dashboard');
    }

    public function transactions()
    {
        return view('admin/transactions');
    }

    public function sales()
    {
        return view('admin/sales');
    }

    public function reports()
    {
        return view('admin/reports');
    }

    public function users()
    {
        return view('admin/users');
    }

    public function profile()
    {
        return view('admin/profile');
    }
}
