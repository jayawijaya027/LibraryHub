<?php

// app/Models/Member.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['name', 'email', 'member_code'];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
