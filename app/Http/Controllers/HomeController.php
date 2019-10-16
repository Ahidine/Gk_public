<?php

namespace App\Http\Controllers;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.dashboard'); 
    }
        public function RC()
    {
        return view('Responsable_Commercial.Bienvenu'); 
    }
        public function test()
    {
        return 'test' ; 
    }
}
