<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['payer', 'payee', 'value'];


    public function userPayer()
    {
        return $this->belongsTo(User::class, 'payer');
    }

    public function userPayee()
    {
        return $this->belongsTo(User::class, 'payee');
    }
}
