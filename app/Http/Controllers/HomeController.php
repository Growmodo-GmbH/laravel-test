<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the User Records Table.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showRecords()
    {
        return view('records');
    }

    /**
     * Show the Unsubscribe page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function unsub()
    {
        return view('unsubscribe');
    }
}
