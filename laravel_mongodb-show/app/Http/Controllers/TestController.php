<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class TestController extends Controller
{
    static function index() {
        $posts = Post::orderBy('_id', 'desc')->get();
        return view('Test', ['posts' => $posts]);
    }
}
