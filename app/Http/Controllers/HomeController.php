<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function news()
    {
        return view('pages.news');
    }
    public function about()
    {
        return view('pages.about');
    }
    public function projects()
    {
        return view('pages.projects');
    }
    public function contact()
    {
        return view('pages.contact');
    }
    public function join()
    {
        return view('pages.join');
    }
}
