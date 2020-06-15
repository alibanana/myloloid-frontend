<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
{
        $this->middleware('auth');
    }

    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Http::get('http://myloloid-backend.test/api/categories')['data'];

        return view('client/dashboard', compact('categories'));
    }

    public function show()
    {
        $categories = Http::get('http://myloloid-backend.test/api/categories')['data'];

        $user_id =  auth()->user()->id;
        $transactions = Http::get('http://myloloid-backend.test/api/users/'.$user_id.'/transactions');

        if (!$transactions['success']){
            $title = $transactions['message']['title'];
            $message = [
                'heading' => $transactions['message']['heading'],
                'message' => $transactions['message']['message']
            ];
    
            return view('client/error', compact('categories', 'title', 'message'));    
        }

        $transactions = $transactions['data'];

        return view('client/dashboard_orders', compact('categories', 'transactions'));
    }
}
