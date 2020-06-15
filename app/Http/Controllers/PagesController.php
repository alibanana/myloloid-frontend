<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagesController extends Controller
{
    public function home()
    {
        $categories = Http::get('http://myloloid-backend.test/api/categories')['data'];

        return view('client/index', compact('categories'));
    }
}
