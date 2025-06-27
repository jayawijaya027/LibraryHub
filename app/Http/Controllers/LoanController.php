<?php

// app/Http/Controllers/LoanController.php
namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;
use App\Models\Book;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['member', 'book'])->get();
        return view('loans.index', compact('loans'));
    }

    public function create(Request $request)
    {
        $members = Member::all();
        $books = Book::all();
        $selectedBookId = $request->query('book_id');
        return view('loans.create', compact('members', 'books', 'selectedBookId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date',
            'returned' => 'required|boolean'
        ]);

        Loan::create($request->all());
        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dicatat');
    }

    public function edit(Loan $loan)
    {
        $members = Member::all();
        $books = Book::all();
        return view('loans.edit', compact('loan', 'members', 'books'));
    }

    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date',
            'returned' => 'required|boolean'
        ]);

        $loan->update($request->all());
        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil diperbarui');
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Data peminjaman dihapus');
    }

    // Method untuk halaman peminjaman buku dari user
    public function userCreate(Request $request)
    {
        $books = Book::all();
        $selectedBookId = $request->query('book_id');
        $selectedBook = null;
        
        if ($selectedBookId) {
            $selectedBook = Book::find($selectedBookId);
        }
        
        return view('loans.user_create', compact('books', 'selectedBook'));
    }
    
    // Method untuk menyimpan peminjaman buku dari user
    public function userStore(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
        ]);
        
        // Menggunakan data user yang login sebagai anggota peminjam
        $member = Member::where('email', auth()->user()->email)->first();
        
        // Jika user belum memiliki data anggota, buat data anggota baru
        if (!$member) {
            $member = Member::create([
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'member_code' => 'M' . time() . rand(10, 99), // Generate kode anggota
            ]);
        }
        
        // Buat peminjaman
        Loan::create([
            'member_id' => $member->id,
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'returned' => false
        ]);
        
        return redirect()->route('user.loans.index')->with('success', 'Buku berhasil dipinjam');
    }

    // Method untuk menampilkan daftar peminjaman user
    public function userIndex()
    {
        // Cari member berdasarkan email user yang login
        $member = Member::where('email', auth()->user()->email)->first();
        
        if ($member) {
            // Ambil data peminjaman dari member tersebut
            $loans = Loan::with(['book', 'book.category'])
                ->where('member_id', $member->id)
                ->orderBy('loan_date', 'desc')
                ->get();
        } else {
            // Jika belum ada data member, tampilkan array kosong
            $loans = collect([]);
        }
        
        return view('loans.user_index', compact('loans'));
    }

    // Membatalkan peminjaman oleh user
    public function userCancel(Loan $loan)
    {
        $member = \App\Models\Member::where('email', auth()->user()->email)->first();
        if (!$member || $loan->member_id !== $member->id) {
            return redirect()->route('user.loans.index')->with('error', 'Anda tidak berhak membatalkan peminjaman ini.');
        }
        if ($loan->returned) {
            return redirect()->route('user.loans.index')->with('error', 'Peminjaman sudah dikembalikan, tidak bisa dibatalkan.');
        }
        $loan->delete();
        return redirect()->route('user.loans.index')->with('success', 'Peminjaman berhasil dibatalkan.');
    }
}
