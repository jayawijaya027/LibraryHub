<?php

// app/Http/Controllers/BookController.php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use PDF;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                ->orWhere('author', 'like', "%$search%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $books = $query->get();
        $categories = Category::all();

        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/books'), $imageName);
            $data['image'] = 'uploads/books/' . $imageName;
        }

        Book::create($data);
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($book->image && file_exists(public_path($book->image))) {
                unlink(public_path($book->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/books'), $imageName);
            $data['image'] = 'uploads/books/' . $imageName;
        }

        $book->update($data);
        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        // Delete image if exists
        if ($book->image && file_exists(public_path($book->image))) {
            unlink(public_path($book->image));
        }
        
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }

    public function print()
    {
        $books = Book::with('category')->get();
        $pdf = PDF::loadView('books.pdf', compact('books'));
        return $pdf->download('laporan_buku.pdf');
    }
}
