<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.1`1
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function adminHome()
    {
        return view('adminHome');
    }
    public function clearCache()
    {
        // Clear the application cache
        Artisan::call('cache:clear');

        // Optionally, you can also clear the configuration cache
        Artisan::call('config:clear');

        // Optionally, clear the route cache
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('optimize');

        // You can add more cache clearing commands as needed

         return redirect()->back();


    }
}
