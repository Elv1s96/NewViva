<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'money_count',
        'currency_from',
        'currency_to',
        'money_count_after_conversion',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
