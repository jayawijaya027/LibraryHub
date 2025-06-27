<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class PageController extends Controller
{
    public function home()
    {
        $books = Book::with('category')->latest()->take(6)->get();
        $categories = Category::all();
        return view('welcome', compact('books', 'categories'));
    }

    public function about()
    {
        return view('pages.about');
    }
} 