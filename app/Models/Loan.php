<?php

// app/Models/Loan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['member_id', 'book_id', 'loan_date', 'return_date', 'returned'];

    protected $casts = [
        'loan_date' => 'date',
        'return_date' => 'date',
        'returned' => 'boolean'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
