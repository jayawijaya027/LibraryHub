<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Redirect ke route yang sesuai jika akses langsung ke /
        $requestPath = request()->path();
        if ($requestPath === '/' || $requestPath === '') {
            if (auth()->user()->role === 'user') {
                return redirect()->route('user.dashboard');
            }
        }

        if (auth()->user()->role === 'user') {
            $query = \App\Models\Book::with('category')->latest();
            
            // Filter berdasarkan pencarian
            if (request()->filled('search')) {
                $search = request()->search;
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%");
                });
            }
            
            // Filter berdasarkan kategori
            if (request()->filled('category')) {
                $query->where('category_id', request()->category);
            }
            
            $books = $query->take(12)->get();
            return view('dashboard.user', compact('books'));
        }

        $bookCount = Book::count();
        $memberCount = Member::count();
        $loanCount = Loan::count();
        $notReturned = Loan::where('returned', false)->count();

        // Ambil 5 peminjaman terbaru
        $recentLoans = Loan::with(['member', 'book'])
            ->latest()
            ->take(5)
            ->get();

        // Ambil 5 buku terpopuler berdasarkan jumlah peminjaman
        $popularBooks = Book::withCount('loans')
            ->orderByDesc('loans_count')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'bookCount', 
            'memberCount', 
            'loanCount', 
            'notReturned',
            'recentLoans',
            'popularBooks'
        ));
    }

    public function profile()
    {
        return view('dashboard.profile');
    }

    public function editProfile()
    {
        return view('dashboard.edit_profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui');
    }

    public function showChangePassword()
    {
        return view('dashboard.change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new \App\Rules\CurrentPassword],
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password berhasil diubah');
    }
}
