<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PagesController extends Controller
{
  public function index(){
    
    return view('pages.welcome');
  }
  public function users(){
    return view('pages.Users');
  }
  public function create(){
    return view('pages.create-user');
  }
  public function editUser(){
    return view('pages.edit-user');
  }
}
