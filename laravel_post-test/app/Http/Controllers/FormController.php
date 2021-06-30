<?php
namespace App\Http\Controllers;
use Request;

class NextController extends Controller
{
    public function index()
    {
        $post_text = Request::input('post_text');
        return view('output', compact('post_text'));
    }
}