<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class FrontendController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->take(8)->get();
        // dd($rooms);
        return view('frontend.index', compact('rooms'));
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function accomodation()
    {
        return view('frontend.accomodation');
    }
    public function blogsingle()
    {
        return view('frontend.blog_single');
    }
    public function blog()
    {
        return view('frontend.blog');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function elements()
    {
        return view('frontend.elements');
    }
    public function gallery()
    {
        return view('frontend.gallery');
    }
}
